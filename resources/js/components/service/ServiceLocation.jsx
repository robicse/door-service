import fetch from "cross-fetch";
import React, { useState, useCallback, useRef, useEffect } from "react";
import TextField from "@material-ui/core/TextField";
import CircularProgress from "@material-ui/core/CircularProgress";
import debounce from "lodash.debounce";
import List from "@material-ui/core/List";
import ListItem from "@material-ui/core/ListItem";
import ListItemIcon from "@material-ui/core/ListItemIcon";
import ListItemText from "@material-ui/core/ListItemText";
import LocationOnIcon from "@material-ui/icons/LocationOn";
import Button from "@material-ui/core/Button";
import { makeStyles } from "@material-ui/core/styles";
import { Container, Grid, Paper, Typography } from "@material-ui/core";
import InputAdornment from "@material-ui/core/InputAdornment";
import Snackbar from "@material-ui/core/Snackbar";
import Alert from "@material-ui/lab/Alert";
import Axios from "axios";
import { Link } from "react-router-dom";
import { FilterNone } from "@material-ui/icons";
import { LinearProgress } from "@material-ui/core";
import { observer } from "mobx-react-lite";
import { useRootStore } from "../context/RootContext";
import { Map } from "./Map";
import MyLocationIcon from "@material-ui/icons/MyLocation";
import Dialog from "@material-ui/core/Dialog";
import DialogActions from "@material-ui/core/DialogActions";
import DialogContent from "@material-ui/core/DialogContent";
import DialogContentText from "@material-ui/core/DialogContentText";
import DialogTitle from "@material-ui/core/DialogTitle";
import Slide from "@material-ui/core/Slide";
import { motion } from "framer-motion";

const Transition = React.forwardRef(function Transition(props, ref) {
    return <Slide direction="up" ref={ref} {...props} />;
});

const useStyles = makeStyles(theme => ({
    root: {
        flexGrow: 1,
        marginBottom: 100,
        marginTop: 100
    },
    mrginbottom: {
        marginBottom: 10
    }
}));

export const ServiceLocation = observer(({ match }) => {
    const classes = useStyles();
    const [provider, setProvider] = React.useState(false);
    const [servicelocation, setServiceLocation] = React.useState("");
    const [options, setOptions] = React.useState([]);
    const [dbValue, saveToDb] = useState("");
    const [open, setOpen] = useState(false);
    const [finding, setFinding] = useState(false);
    const [lat, setLat] = useState(null);
    const [lng, setLng] = useState(null);
    const debouncedValue = useDeboounce(dbValue, 800);
    const {
        updateLocation,
        setServiceLat,
        setServiceLng,
        service_type,
        service_id
    } = useRootStore();
    const [modalopen, setModalOpen] = React.useState(false);
    const [vendors, setVendors] = React.useState([]);

    //console.log(service_type);

    const handleModalClickOpen = () => {
        setModalOpen(true);
    };
    // setTitle("ssh");

    const handleModalClose = () => {
        setModalOpen(false);
    };

    const handleChange = event => {
        setProvider(false);
        saveToDb(event.target.value);
        setServiceLocation(event.target.value);
    };

    React.useEffect(() => {
        window.scrollTo(0, 0);
        (async () => {
            if (dbValue.length == 0) {
                setOptions([]);
            } else {
                try {
                    const response = await fetch(
                        `https://barikoi.xyz/v1/api/search/autocomplete/MTg5ODpJUTVHV0RWVFZP/place?q=${dbValue}`
                    );
                    const locations = await response.json();

                    if (locations.places === undefined) {
                        setOptions([]);
                    } else {
                        setOptions(locations.places);
                    }
                } catch (error) {
                    console.log(
                        "Error fetching Location from the server.",
                        error
                    );
                    setOptions([]);
                }
            }
        })();
    }, [debouncedValue]);

    // React.useEffect(() => {
    //     if (!open) {
    //         setOptions([]);
    //     }
    // }, [open]);

    const handleClose = (event, reason) => {
        if (reason === "clickaway") {
            return;
        }
        setOpen(false);
    };

    function currentlocation() {
        navigator.geolocation.getCurrentPosition(position => {
            setOptions([]);
            fetch(
                `https://barikoi.xyz/v1/api/search/reverse/MTg5ODpJUTVHV0RWVFZP/geocode?longitude=${position.coords.longitude}&latitude=${position.coords.latitude}&district=true&post_code=true&country=true&sub_district=true&union=false&pauroshova=false&location_type=true`
            )
                .then(response => response.json())
                .catch(error => console.error("reverse geo error:", error))
                .then(response =>
                    checkProvider({
                        latitude: position.coords.latitude.toString(),
                        longitude: position.coords.longitude.toString(),
                        area: response.place.area,
                        address: response.place.address
                    })
                );
        });
    }

    function checkProvider(location) {
        setFinding(true);
        //console.log(typeof service_id);
        Axios.post(window.location.origin + `/api/vendor-location-checker`, {
            services_area: location.area,
            user_lat: location.latitude,
            user_lng: location.longitude,
            service_id: service_id
        })
            .then(res => {
                const vendor = res.data;
                //console.log(vendor.success);
                if (vendor.success.services_area) {
                    //console.log(vendor.success);
                    setProvider(true);
                    setServiceLocation(location.address);
                    setFinding(false);
                    updateLocation(location.address);
                    setServiceLat(location.latitude);
                    setServiceLng(location.longitude);
                    setLat(location.latitude);
                    setLng(location.longitude);
                    setVendors(vendor.success.vendors);
                } else {
                    setProvider(false);
                    setOpen(true);
                    setFinding(false);
                }
            })
            .catch(function(error) {
                console.log(error);
                setProvider(false);
                setOpen(true);
                setFinding(false);
            });
    }

    return (
        <motion.div
            initial={{ opacity: 0 }}
            animate={{ opacity: 1 }}
            exit={{ opacity: 0 }}
        >
            <Container maxWidth="md" className={classes.root}>
                <Paper variant="outlined">
                    <Container
                        maxWidth="sm"
                        style={{ marginTop: 30, marginBottom: 30 }}
                    >
                        <Grid
                            container
                            direction="column"
                            justify="center"
                            alignItems="center"
                        >
                            <Typography
                                variant="h5"
                                className={classes.mrginbottom}
                            >
                                Where do you need the service?
                            </Typography>
                            <TextField
                                id="outlined-basic"
                                variant="outlined"
                                fullWidth={true}
                                placeholder="Search For Your Location"
                                onChange={handleChange}
                                className={classes.mrginbottom}
                                value={servicelocation}
                                InputProps={{
                                    endAdornment: (
                                        <InputAdornment position="end">
                                            {finding ? (
                                                <CircularProgress color="primary" />
                                            ) : (
                                                <Button
                                                    onClick={currentlocation}
                                                    color="primary"
                                                    variant="contained"
                                                >
                                                    <MyLocationIcon />
                                                </Button>
                                            )}
                                        </InputAdornment>
                                    )
                                }}
                            />

                            <Button
                                variant="contained"
                                color="primary"
                                disabled={!provider}
                                fullWidth={true}
                                className={classes.mrginbottom}
                            >
                                <Link
                                    to={`/service/service_requests/service_details/${match.params.service}?latitude=${lat}&longitude=${lng}`}
                                    style={{
                                        textDecoration: "none",
                                        color: "#101311",
                                        width: "100%"
                                    }}
                                >
                                    Proceed to next step
                                </Link>
                            </Button>

                            <List>
                                {options.map(location => (
                                    <React.Fragment key={location.id}>
                                        <ListItem
                                            button
                                            disableGutters={true}
                                            divider={true}
                                        >
                                            <ListItemIcon>
                                                <LocationOnIcon />
                                            </ListItemIcon>
                                            <ListItemText
                                                primary={location.address}
                                                onClick={() =>
                                                    checkProvider(location)
                                                }
                                            />
                                        </ListItem>
                                    </React.Fragment>
                                ))}
                            </List>
                        </Grid>
                    </Container>
                </Paper>
            </Container>
            <Snackbar open={open} autoHideDuration={900} onClose={handleClose}>
                <Alert onClose={handleClose} severity="error">
                    Sorry, we are not available in this area yet.
                </Alert>
            </Snackbar>
        </motion.div>
    );
});
const useDeboounce = (value, delay) => {
    const [debouncedValue, setDebouncedValue] = useState(value);

    useEffect(() => {
        const handler = setTimeout(() => {
            setDebouncedValue(value);
        }, delay);

        return () => {
            clearTimeout(handler);
        };
    }, [value, delay]);

    return debouncedValue;
};
