import React, { useRef, useEffect } from "react";
import { makeStyles } from "@material-ui/core/styles";
import {
    Typography,
    Input,
    Grid,
    InputLabel,
    InputAdornment,
    FormControl,
    Button,
    TextField,
    Box
} from "@material-ui/core";
import SearchIcon from "@material-ui/icons/Search";
import Autocomplete from "@material-ui/lab/Autocomplete";
import Axios from "axios";
import { useState } from "react";
import { SearchLocation } from "./SearchLocation";
import { observer } from "mobx-react-lite";
import { useRootStore } from "../context/RootContext";
import { Link } from "react-router-dom";
import LocationOnIcon from "@material-ui/icons/LocationOn";
import ClickAwayListener from "@material-ui/core/ClickAwayListener";
import Grow from "@material-ui/core/Grow";
import Paper from "@material-ui/core/Paper";
import Popper from "@material-ui/core/Popper";

const useStyles = makeStyles(theme => ({
    root: {
        flexGrow: 1,
        "& .MuiInputLabel-shrink": {
            display: "none" // or black
        }
    },
    parentgrid: {
        boxShadow: "0px 4px 11px 0px rgba(36,36,36,0.10)",
        backgroundColor: "#ffffff",
        borderRadius: "10px"
    }
}));

export const SearchBar = () => {
    const classes = useStyles();
    const [services, setServices] = useState([]);
    const [ser, setSer] = useState(false);
    const [provider, setProvider] = React.useState(false);
    const [lat, setLat] = useState(null);
    const [lng, setLng] = useState(null);
    const {
        setServiceInfo,
        service_slug,
        service_location_lat,
        service_location_lng,
        getUserLoginState
    } = useRootStore();
    const setServiceList = () => {
        console.log("in search fetch service");
        if (services.length == 0) {
            Axios.get(window.location.origin + `/api/search/all/services`)
                .then(res => {
                    console.log(res.data.success);
                    setServices(res.data.success);
                })
                .catch(function(error) {
                    console.log(error);
                });
        }
    };
    //menu popover
    const [open, setOpen] = React.useState(false);
    const anchorRef = React.useRef(null);

    const handleToggle = () => {
        setOpen(prevOpen => !prevOpen);
    };

    const handleClose = event => {
        if (anchorRef.current && anchorRef.current.contains(event.target)) {
            return;
        }

        setOpen(false);
    };

    function handleListKeyDown(event) {
        if (event.key === "Tab") {
            event.preventDefault();
            setOpen(false);
        }
    }

    // return focus to the button when we transitioned from !open -> open
    const prevOpen = React.useRef(open);
    React.useEffect(() => {
        if (prevOpen.current === true && open === false) {
            anchorRef.current.focus();
        }

        prevOpen.current = open;
    }, [open]);
    return (
        <div className={classes.root}>
            <Grid
                container
                direction="row"
                justify="center"
                alignItems="center"
            >
                <Grid item xs={false} md={12}>
                    <Typography
                        variant="h4"
                        align="center"
                        style={{ color: "#ffffff", fontWeight: 700 }}
                    >
                        Welcome to Door Service
                    </Typography>
                    <Box mt={1} mb={3}>
                        <Typography
                            variant="h6"
                            align="center"
                            color="primary"
                            // style={{ color: "#ffffff" }}
                        >
                            Largest Open Workplace in Bangladesh
                        </Typography>
                    </Box>
                </Grid>
            </Grid>
            <Grid container>
                <Grid item xs={false} md={3}></Grid>
                <Grid
                    container
                    item
                    xs={12}
                    md={6}
                    direction="row"
                    justify="center"
                    alignItems="center"
                    className={classes.parentgrid}
                >
                    <Grid item xs={9} md={8}>
                        <Box py={2} px={3}>
                            <Grid
                                container
                                spacing={1}
                                direction="row"
                                justify="space-between"
                            >
                                {/* <Grid item>
                                    <Typography variant="h6" color="primary">
                                        Service
                                    </Typography>
                                </Grid> */}
                            </Grid>
                            <Autocomplete
                                onChange={(event, newValue) => {
                                    if (newValue != null) {
                                        setServiceInfo(newValue);
                                    }
                                }}
                                onInputChange={(event, newInputValue) => {
                                    console.log(newInputValue);
                                    if (newInputValue == "") {
                                        setSer(false);
                                    } else {
                                        setSer(true);
                                    }
                                }}
                                id="combo-box-demo"
                                options={services}
                                getOptionLabel={option => option.service_name}
                                fullWidth={true}
                                renderInput={params => (
                                    <TextField
                                        {...params}
                                        label="What Service do You Need?"
                                        // style={{ marginTop: "-20px" }}
                                        margin="dense"
                                        onClick={setServiceList}
                                        variant="outlined"
                                    />
                                )}
                            />
                        </Box>
                    </Grid>
                    {/* <Grid item xs={false} md={1}></Grid> */}
                    <Grid item xs={3} md={2}>
                        <Box py={2} px={3}>
                            <div>
                                {/* <Grid
                                        container
                                        spacing={1}
                                        direction="row"
                                        justify="space-between"
                                        alignItems="center"
                                    >
                                        <Grid item>
                                            <Typography
                                                variant="h6"
                                                color="primary"
                                            >
                                                Location
                                            </Typography>
                                        </Grid>
                                    </Grid> */}

                                <div>
                                    <Button
                                        ref={anchorRef}
                                        aria-controls={
                                            open ? "menu-list-grow" : undefined
                                        }
                                        aria-haspopup="true"
                                        onClick={handleToggle}
                                        variant="contained"
                                        color="primary"
                                        disabled={ser ? false : true}
                                    >
                                        <LocationOnIcon />
                                    </Button>
                                    <Popper
                                        open={open}
                                        anchorEl={anchorRef.current}
                                        role={undefined}
                                        transition
                                        disablePortal
                                        style={{ width: 400, zIndex: 20000 }}
                                    >
                                        {({ TransitionProps, placement }) => (
                                            <Grow
                                                {...TransitionProps}
                                                style={{
                                                    transformOrigin:
                                                        placement === "bottom"
                                                            ? "center top"
                                                            : "center bottom"
                                                }}
                                            >
                                                <Paper>
                                                    <ClickAwayListener
                                                        onClickAway={
                                                            handleClose
                                                        }
                                                    >
                                                        <SearchLocation
                                                            setProvider={
                                                                setProvider
                                                            }
                                                            setLat={setLat}
                                                            setLng={setLng}
                                                            handleClose={
                                                                handleClose
                                                            }
                                                        />
                                                        {/* {ser ? (
                                                            <SearchLocation
                                                                setProvider={
                                                                    setProvider
                                                                }
                                                                setLat={setLat}
                                                                setLng={setLng}
                                                            />
                                                        ) : (
                                                            <Autocomplete
                                                                id="combo-box-demo"
                                                                options={[]}
                                                                fullWidth={true}
                                                                renderInput={params => (
                                                                    <TextField
                                                                        {...params}
                                                                        label="Where Do You Need It?"
                                                                    />
                                                                )}
                                                            />
                                                        )} */}
                                                    </ClickAwayListener>
                                                </Paper>
                                            </Grow>
                                        )}
                                    </Popper>
                                </div>
                            </div>
                        </Box>
                    </Grid>
                    {/* <Grid item xs={false} md={1}></Grid> */}
                    <Grid
                        container
                        item
                        xs={12}
                        md={2}
                        justify="center"
                        py={2}
                        px={4}
                    >
                        <Button
                            color="primary"
                            size="medium"
                            variant="contained"
                            disabled={!provider}
                        >
                            <Link
                                to={`/service/service_requests/service_details/${service_slug}?latitude=${service_location_lat}&longitude=${service_location_lng}`}
                                style={{
                                    textDecoration: "none",
                                    color: "#101311",
                                    width: "100%"
                                }}
                            >
                                FIND
                            </Link>
                        </Button>
                    </Grid>
                </Grid>
                <Grid item xs={false} md={3}></Grid>
            </Grid>
            {!getUserLoginState && (
                <Grid
                    container
                    direction="row"
                    justify="center"
                    alignItems="center"
                >
                    <Box mt={2}>
                        <Link to="/signup" style={{ textDecoration: "none" }}>
                            <Button
                                variant="contained"
                                color="primary"
                                size="large"
                            >
                                Register Now
                            </Button>
                        </Link>
                    </Box>
                </Grid>
            )}
        </div>
    );
};
