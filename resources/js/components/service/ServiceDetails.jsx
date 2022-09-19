import React from "react";
import { useAsyncEffect } from "use-async-effect";
import { makeStyles } from "@material-ui/core/styles";
import { useState } from "react";
import { Link } from "react-router-dom";
import {
    Typography,
    Grid,
    Button,
    Container,
    Paper,
    Box
} from "@material-ui/core";
import Skeleton from "@material-ui/lab/Skeleton";
import List from "@material-ui/core/List";
import ListItem from "@material-ui/core/ListItem";
import ListItemAvatar from "@material-ui/core/ListItemAvatar";
import ListItemIcon from "@material-ui/core/ListItemIcon";
import ListItemSecondaryAction from "@material-ui/core/ListItemSecondaryAction";
import ListItemText from "@material-ui/core/ListItemText";
import { observer } from "mobx-react-lite";
import { useRootStore } from "../context/RootContext";
import { motion } from "framer-motion";
import { Testimonals } from "../home/Testimonals";

const useStyles = makeStyles(theme => ({
    root: {
        flexGrow: 1,
        marginTop: 70,
        marginBottom: 30
    },
    leftGrid: {
        backgroundColor: "#fafafa",
        borderRadius: 6,
        borderTop: "3px solid #f16044",
        marginTop: 30
    },
    rightGrid: {
        backgroundColor: "#fafafa",
        borderRadius: 6,
        marginTop: 30
    }
}));

export const ServiceDetails = observer(match => {
    const classes = useStyles();
    const [lat, setLat] = useState(null);
    const [lng, setLng] = useState(null);
    const [details, setDetails] = useState(false);
    const [location, setLocation] = useState(null);
    const store = useRootStore();
    const {
        service_title,
        updateWindowsLocation,
        service_type,
        service_slug
    } = store;

    useAsyncEffect(async isMounted => {
        const urlParams = new URLSearchParams(match.location.search);
        const latitude = urlParams.get("latitude");
        setLat(latitude);
        const longitude = urlParams.get("longitude");
        setLng(longitude);
        updateWindowsLocation("windows.location");

        fetch(
            "https://barikoi.xyz/v1/api/search/reverse/MTg5ODpJUTVHV0RWVFZP/geocode?longitude=" +
                longitude +
                "&latitude=" +
                latitude +
                "&district=flase&post_code=false&country=false&sub_district=false&union=false&pauroshova=false&location_type=true"
        )
            .then(response => response.json())
            .catch(error => console.error("Error:", error))
            .then(response => setLocation(response.place.address));
    }, []);

    return (
        <motion.div
            initial={{ opacity: 0 }}
            animate={{ opacity: 1 }}
            exit={{ opacity: 0 }}
        >
            <Container maxWidth="lg" className={classes.root}>
                <Grid container alignItems="flex-start">
                    <Grid
                        item
                        xs={12}
                        md={7}
                        className={classes.leftGrid}
                        container
                        direction="column"
                        justify="center"
                        alignItems="center"
                    >
                        <Box mb={2} mt={2}>
                            <Typography variant="h5">
                                {service_title}
                            </Typography>
                        </Box>

                        <Box mb={2}>
                            <Typography
                                variant="body2"
                                style={{
                                    border: "1px solid #ced5d0",
                                    borderRadius: 20,
                                    padding: 10
                                }}
                            >
                                {location}
                            </Typography>
                        </Box>
                        <Grid container direction="column" justify="flex-start">
                            <Box px={10}>
                                <Box>
                                    <img
                                        src="https://www.pngitem.com/pimgs/m/243-2434459_transparent-happy-customer-png-illustration-png-download.png"
                                        alt=""
                                        width="100%"
                                    />
                                </Box>
                                <Box>
                                    <Box mb={1}>
                                        <Typography variant="h6">
                                            Great Value
                                        </Typography>
                                    </Box>
                                    <Box mb={2}>
                                        <Typography variant="body2">
                                            Our prices are one of the lowest in
                                            the market
                                        </Typography>
                                    </Box>
                                </Box>
                                <Box>
                                    <Box mb={1}>
                                        <Typography variant="h6">
                                            Peace of Mind
                                        </Typography>
                                    </Box>
                                    <Box mb={2}>
                                        <Typography variant="body2">
                                            We are here to assist you every step
                                            of the way
                                        </Typography>
                                    </Box>
                                </Box>
                            </Box>
                            <Box px={10}>
                                <Box>
                                    <Box mb={1}>
                                        <Typography variant="h6">
                                            WHAT IS INCLUDED
                                        </Typography>
                                    </Box>
                                    <Box mb={2}>
                                        <ul>
                                            <li>
                                                Sweeping/vacuuming and mopping
                                                of floors
                                            </li>
                                            <li>Throwing away of rubbish</li>
                                            <li>Wiping of all surfaces</li>
                                            <li>
                                                Washing, drying and putting away
                                                of dishes
                                            </li>
                                            <li>
                                                1 cleaner / 4 hours or 2
                                                cleaners / 2 hours
                                            </li>
                                        </ul>
                                    </Box>
                                </Box>
                                <Box>
                                    <Box mb={1}>
                                        <Typography variant="h6">
                                            FINE PRINT
                                        </Typography>
                                    </Box>

                                    <Box mb={2}>
                                        <ul>
                                            <li>
                                                Additional RM45 per cleaner, per
                                                hour if more time is required
                                                for cleaning (subject to
                                                availability)
                                            </li>
                                            <li>
                                                Minimum 2 hours notice is needed
                                                for extension of cleaning hours
                                            </li>
                                        </ul>
                                    </Box>
                                </Box>
                            </Box>
                        </Grid>
                    </Grid>
                    <Grid item xs={12} md={1}></Grid>
                    <Grid
                        item
                        xs={12}
                        md={4}
                        className={classes.rightGrid}
                        container
                        direction="column"
                        justify="flex-start"
                        alignItems="center"
                        style={{ padding: 25 }}
                    >
                        {service_type == "Fixed" ? (
                            <div>
                                <Box mb={1}>
                                    <Typography variant="h6">
                                        Direct Request
                                    </Typography>
                                </Box>
                                <Box mb={2}>
                                    <Typography variant="body2">
                                        A vendor will be assigned to you
                                        automatically at a fixed price. No price
                                        comparison needed.
                                    </Typography>
                                </Box>
                                <Box>
                                    <Typography variant="h6">
                                        How it works
                                    </Typography>
                                </Box>
                                <Box mb={1}>
                                    <List dense={true}>
                                        <ListItem>
                                            <ListItemIcon>
                                                <Typography>1</Typography>
                                            </ListItemIcon>
                                            <ListItemText primary="Submit your request by answering some questions." />
                                        </ListItem>
                                        <ListItem>
                                            <ListItemIcon>
                                                <Typography>2</Typography>
                                            </ListItemIcon>
                                            <ListItemText primary="A verified vendor will reach out to you to schedule an appointment." />
                                        </ListItem>
                                        <ListItem>
                                            <ListItemIcon>
                                                <Typography>3</Typography>
                                            </ListItemIcon>
                                            <ListItemText primary="Once the job is completed, pay directly via sslcommerz." />
                                        </ListItem>
                                    </List>
                                </Box>
                            </div>
                        ) : (
                            <div>
                                <Box mb={1}>
                                    <Typography variant="h6">
                                        Compare Request
                                    </Typography>
                                </Box>
                                <Box mb={2}>
                                    <Typography variant="body2">
                                        Receive up to 3 quotations from our
                                        vendors. Choose & book your preferred
                                        vendor for the job.
                                    </Typography>
                                </Box>
                                <Box>
                                    <Typography variant="h6">
                                        How it works
                                    </Typography>
                                </Box>
                                <Box mb={1}>
                                    <List dense={true}>
                                        <ListItem>
                                            <ListItemIcon>
                                                <Typography>1</Typography>
                                            </ListItemIcon>
                                            <ListItemText primary="Submit your request by answering some questions." />
                                        </ListItem>
                                        <ListItem>
                                            <ListItemIcon>
                                                <Typography>2</Typography>
                                            </ListItemIcon>
                                            <ListItemText primary="You will receive up to 3 quotations from our verified vendors." />
                                        </ListItem>
                                        <ListItem>
                                            <ListItemIcon>
                                                <Typography>3</Typography>
                                            </ListItemIcon>
                                            <ListItemText primary="Choose your preferred vendor and schedule an appointment for the job." />
                                        </ListItem>
                                        <ListItem>
                                            <ListItemIcon>
                                                <Typography>4</Typography>
                                            </ListItemIcon>
                                            <ListItemText primary="Once the job is completed, pay directly via sslcommerz." />
                                        </ListItem>
                                    </List>
                                </Box>
                            </div>
                        )}

                        <Box>
                            <Link
                                to={`/service/question-set/${service_slug}
                                    `}
                                style={{
                                    textDecoration: "none",
                                    color: "#101311"
                                }}
                            >
                                <Button
                                    fullWidth
                                    variant="contained"
                                    color="primary"
                                >
                                    Let's get started
                                </Button>
                            </Link>
                        </Box>
                    </Grid>
                </Grid>
                {/* <Testimonals /> */}
            </Container>
        </motion.div>
    );
});
