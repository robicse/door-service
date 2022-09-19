import { Box, Container, Grid, Typography, Button } from "@material-ui/core";
import moment from "moment";
import React, { useContext, useState } from "react";
import { makeStyles } from "@material-ui/core/styles";
import { HomeService } from "../home/HomeService";
import Axios from "axios";
import { useAsyncEffect } from "use-async-effect";
import { UserContext } from "../context/UserContext";
import { useRootStore } from "../context/RootContext";
import Card from "@material-ui/core/Card";
import CardActions from "@material-ui/core/CardActions";
import CardContent from "@material-ui/core/CardContent";
import ScheduleIcon from "@material-ui/icons/Schedule";
import PersonPinIcon from "@material-ui/icons/PersonPin";
import FaceIcon from "@material-ui/icons/Face";
import TimerIcon from "@material-ui/icons/Timer";
import CheckCircleOutlineIcon from "@material-ui/icons/CheckCircleOutline";
import ArrowForwardTwoToneIcon from "@material-ui/icons/ArrowForwardTwoTone";
import { Link } from "react-router-dom";
import DoneAllIcon from "@material-ui/icons/DoneAll";
import PeopleIcon from "@material-ui/icons/People";
import PersonIcon from "@material-ui/icons/Person";
import { motion } from "framer-motion";
import LinearProgress from "@material-ui/core/LinearProgress";
import { Helmet } from "react-helmet";

const useStyles = makeStyles(theme => ({
    root: {
        minWidth: 275
    },

    title: {
        fontSize: 14
    },
    pos: {
        marginBottom: 2
    }
}));
export const Request = () => {
    const classes = useStyles();
    const store = useRootStore();
    const {
        service_title,
        getQuestionAnswerSet,
        service_location,
        getServiceDate,
        getTotalPrice
    } = store;
    const [request, setRequest] = useState([]);
    const [loaded, setLoaded] = useState(false);
    const [find, setFind] = useState(false);
    const { user, setUser } = useContext(UserContext);
    const [shippingAddress, setShippingAddress] = useState({});
    const [orders, setOrders] = useState([]);
    const [fetchrequest, setFetchrequest] = useState(true);
    //console.log(user);

    useAsyncEffect(async isMounted => {
        try {
            const request = await axios.get(
                window.location.origin + "/api/user/order/request/get/all",
                {
                    headers: { Authorization: "Bearer " + user.token }
                }
            );
            if (!isMounted()) return;
            setFetchrequest(false);
            if (request.data.response.length != 0) {
                console.log(request.data.response);
                setOrders(request.data.response);
                setFind(true);
            } else {
                setFind(false);
            }
            setLoaded(true);
        } catch (error) {
            setFetchrequest(false);
            console.log("Error fetching User Service Request from the server.");
            setFind(false);
            setLoaded(true);
        }
    }, []);

    return (
        <motion.div
            initial={{ opacity: 0 }}
            animate={{ opacity: 1 }}
            exit={{ opacity: 0 }}
        >
            <Helmet>
                <title>My Request | Doorservice</title>
            </Helmet>
            <Container maxWidth="lg">
                {fetchrequest && <LinearProgress />}
                {loaded && (
                    <Grid
                        container
                        spacing={2}
                        direction="row"
                        justify="center"
                        alignItems="center"
                    >
                        {find ? (
                            orders.map(order => (
                                <Grid item md={4} key={order.id}>
                                    <Card className={classes.root}>
                                        <CardContent>
                                            <Typography
                                                className={classes.title}
                                                color="textSecondary"
                                                gutterBottom
                                                component="span"
                                                color="primary"
                                            >
                                                <Box
                                                    style={{
                                                        display: "inline-flex"
                                                    }}
                                                >
                                                    <PeopleIcon />
                                                    <Box ml={1}>
                                                        {order.shipping_address
                                                            .service_type ==
                                                        "Fixed"
                                                            ? "Direct"
                                                            : "Compare"}
                                                    </Box>
                                                </Box>
                                            </Typography>
                                            <Typography
                                                variant="h5"
                                                component="h2"
                                                style={{ marginBottom: 15 }}
                                            >
                                                {
                                                    order.shipping_address
                                                        .service_name
                                                }
                                            </Typography>
                                            <Typography
                                                className={classes.pos}
                                                color="textSecondary"
                                            >
                                                <Box
                                                    style={{
                                                        display: "inline-flex"
                                                    }}
                                                    component="span"
                                                    mb={1}
                                                >
                                                    <ScheduleIcon />
                                                    <Box
                                                        ml={1}
                                                        component="span"
                                                    >
                                                        {moment(
                                                            order
                                                                ?.shipping_address
                                                                ?.service_date
                                                        ).format(
                                                            "MMMM Do YYYY, h:mm:ss a"
                                                        )}
                                                    </Box>
                                                </Box>
                                            </Typography>
                                            <Typography
                                                className={classes.pos}
                                                color="textSecondary"
                                            >
                                                <Box
                                                    style={{
                                                        display: "inline-flex"
                                                    }}
                                                    component="span"
                                                    mb={1}
                                                >
                                                    <PersonPinIcon />
                                                    <Box
                                                        ml={1}
                                                        component="span"
                                                    >
                                                        {
                                                            order
                                                                .shipping_address
                                                                .address
                                                        }
                                                    </Box>
                                                </Box>
                                            </Typography>
                                            <Typography
                                                className={classes.pos}
                                                color="textSecondary"
                                            >
                                                <Box
                                                    style={{
                                                        display: "inline-flex"
                                                    }}
                                                    component="span"
                                                    mb={1}
                                                >
                                                    <FaceIcon />
                                                    <Box
                                                        ml={1}
                                                        component="span"
                                                    >
                                                        {
                                                            order
                                                                .shipping_address
                                                                .name
                                                        }
                                                    </Box>
                                                </Box>
                                            </Typography>
                                        </CardContent>
                                        <CardActions>
                                            <Grid
                                                container
                                                direction="row"
                                                justify="space-between"
                                                alignItems="center"
                                            >
                                                <Typography
                                                    className={classes.title}
                                                    color="textSecondary"
                                                    gutterBottom
                                                    component="span"
                                                    color="primary"
                                                >
                                                    <Box
                                                        style={{
                                                            display:
                                                                "inline-flex"
                                                        }}
                                                    >
                                                        {order.vendor_id ==
                                                        null ? (
                                                            <TimerIcon />
                                                        ) : (
                                                            <DoneAllIcon />
                                                        )}
                                                        <Box ml={1}>
                                                            {order.vendor_id ==
                                                            null
                                                                ? "Pending"
                                                                : "Accepted"}
                                                        </Box>
                                                    </Box>
                                                </Typography>
                                                <Link
                                                    to={`/user/request/${order.invoice_code}/quotes`}
                                                >
                                                    <Button
                                                        size="small"
                                                        fullWidth={true}
                                                        endIcon={
                                                            <ArrowForwardTwoToneIcon />
                                                        }
                                                        variant="outlined"
                                                        color="primary"
                                                    >
                                                        Details
                                                    </Button>
                                                </Link>
                                            </Grid>
                                        </CardActions>
                                    </Card>
                                </Grid>
                            ))
                        ) : (
                            <>
                                <Box>
                                    <Grid
                                        container
                                        direction="column"
                                        justify="center"
                                        alignItems="center"
                                    >
                                        <Box p={1}>
                                            <img
                                                src={
                                                    window.location.origin +
                                                    "/frontend/img/all_request.png"
                                                }
                                                alt=""
                                                width="100%"
                                                height="100%"
                                            />
                                        </Box>
                                        <Typography variant="h6">
                                            Opps, Currently you don't have any
                                            request!!
                                        </Typography>
                                        <Typography
                                            variant="body1"
                                            color="primary"
                                        >
                                            Why not try to request one now.
                                        </Typography>
                                    </Grid>
                                </Box>
                            </>
                        )}
                    </Grid>
                )}

                <Grid
                    container
                    spacing={2}
                    direction="row"
                    justify="flex-start"
                    alignItems="center"
                    style={{ marginTop: 80 }}
                >
                    <Box mb={1}>
                        <Typography variant="h6">
                            Recommended Service
                        </Typography>
                    </Box>
                    <Grid container>
                        <HomeService />
                    </Grid>
                </Grid>
            </Container>
        </motion.div>
    );
};
