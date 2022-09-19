import {Box, Container, Grid, Paper, Typography, Button, Snackbar, LinearProgress, makeStyles, CssBaseline } from "@material-ui/core";
import moment from "moment";
import Divider from "@material-ui/core/Divider";
import React from "react";
import { useAsyncEffect } from "use-async-effect";
import { useContext, useState } from "react";
import DoneAllIcon from "@material-ui/icons/DoneAll";
import { motion } from "framer-motion";


import QuestionAnswerIcon from "@material-ui/icons/QuestionAnswer";
import { Link } from "react-router-dom";
import { useHistory } from "react-router-dom";
import { useRootStore } from "../../context/RootContext";
import Timeline from "@material-ui/lab/Timeline";
import TimelineItem from "@material-ui/lab/TimelineItem";
import TimelineSeparator from "@material-ui/lab/TimelineSeparator";
import TimelineConnector from "@material-ui/lab/TimelineConnector";
import TimelineContent from "@material-ui/lab/TimelineContent";
import TimelineDot from "@material-ui/lab/TimelineDot";
import { TextField } from "@material-ui/core";
import { UserContext } from "../../context/UserContext";
import Axios from "axios";
import { Formik, Form, Field } from "formik";
import Alert from "@material-ui/lab/Alert";
import Rating from '@material-ui/lab/Rating';
import TextareaAutosize from '@material-ui/core/TextareaAutosize';

const useStyles = makeStyles(theme => ({
    root: {
        flexGrow: 1,
        marginBottom: 100
    },
    paper: {
        marginTop: theme.spacing(8),
        display: "flex",
        flexDirection: "column",
        alignItems: "center"
    },
    avatar: {
        margin: theme.spacing(1),
        backgroundColor: theme.palette.primary.main
    },
    form: {
        width: "100%" // Fix IE 11 issue.
        // marginTop: theme.spacing(1)
    },
    submit: {
        margin: theme.spacing(3, 0, 2)
    }
}));


export const VendorInfo = props => {
    // console.log(props.order.id);
    // console.log(props.vendor.order);
    const [vendorstatus, setVendorStatus] = useState(false);
    const [vendor, setVendor] = useState();
    const [ordervendor, setOrdervendor] = useState(0);
    const history = useHistory();
    const store = useRootStore();
    const { set_current_vendor_id } = store;
    const classes = useStyles();
    const [alert, setAlert] = useState({});
    const { user, setUser } = useContext(UserContext);
    const [rating, setRating] = useState(2);
    const [hover, setHover] = useState(-1);
    const [comment, setComment]= useState("")
    const [averageRating, setAverageRating] = useState(0);
    const [paymentStatus, setPaymentStatus] = useState(0);
    useAsyncEffect(
        async isMounted => {
            if (!isMounted()) return;

            if (!props.vendor) {
                return setVendorStatus(false);
            }
            //console.log(props);
            // console.log(props.vendor[0].vendor_company_name);
            //console.log(props);
            setVendorStatus(true);
            setVendor(props.vendor[0]);

            setPaymentStatus(props.order.payment_status);

            //console.log(props.vendor[0].user_id)
            Axios.post(
                window.location.origin + "/api/user/vendor/average/rating",
                {
                    vendor_id: props.vendor[0].user_id,
                },
                {
                    headers: { Authorization: "Bearer " + user.token }
                }
            )
                .then(res => {
                    //console.log(res);
                    setAverageRating(res.data.vendor_average_rating)
                })
                .catch(function(error) {
                    //console.log(error);
                });


                // vendor request count
                Axios.post(window.location.origin + `/api/user/order/all/vendor/request/count`, {
                    order_id: props.order.id
                })
                .then(res => {
                    setOrdervendor(res.data.response);
                    //window.location.href = res.data;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        [props.vendor]
    );

    

    const againRequest = () => {
        console.log('againRequest');
        Axios.post(window.location.origin + `/api/user/order/again/request/submit`, {
            order_id: props.order.id
        })
        .then(res => {
            console.log(res.data);
            //window.location.href = res.data;
        })
        .catch(function(error) {
            console.log(error);
        });
    };


    const vendorChat = id => {
        //console.log(id);
        set_current_vendor_id(id);
        history.push("/user/request/vendor/book/" + vendor.id);
    };

    const handleClose = (event, reason) => {
        if (reason === "clickaway") {
            return;
        }
        setAlert({
            open: false,
            severity: "info",
            massage: "Loading"
        });
    };

    const handleSubmit=()=>{
        const data={
            rating: rating,
            comment:comment
        }
        // console.log(data)

        setTimeout(() => {
            console.log('submit')

            Axios.post(
                window.location.origin + `/api/user/order/review`,
                {
                    // comment: values.comment,
                    // order_id: values.order_id,
                    // rating: values.rating
                    comment: data.comment,
                    order_id: props.order.id,
                    rating: data.rating
                },
                {
                    headers: { Authorization: "Bearer " + user.token }
                }
            )
                .then(res => {
                    // const persons = res.data;
                    // setUser({
                    //     token: persons.response.token,
                    //     user: persons.response.user,
                    //     isAuthenticate: true
                    // });
                    //
                    // localStorage.setItem(
                    //     "auth-token",
                    //     persons.response.token
                    // );
                    console.log(res);
                    setAlert({
                        open: true,
                        severity: "success",
                        massage: "Save Succesfully"
                    });
                })
                .catch(function(error) {
                    let response = error.response.data.response;
                    //console.log(error.response.data.response);
                    setAlert({
                        open: true,
                        severity: "error",
                        massage: error.response.data.response
                    });
                });
        }, 500);
    }

    return (
        <motion.div
            initial={{ opacity: 0 }}
            animate={{ opacity: 1 }}
            exit={{ opacity: 0 }}
        >
            <Container maxWidth="md" style={{ marginTop: 20 }}>
                <Grid container>
                    {vendorstatus ? (
                        <Grid
                            item
                            md={12}
                            container
                            direction="row"
                            spacing={2}
                        >
                            <Grid item md={6}>
                                <Paper elevation={1}>
                                    <Grid
                                        container
                                        direction="row"
                                        alignItems="center"
                                        justify="center"
                                    >
                                        <Grid
                                            item
                                            xs={12}
                                            md={4}
                                            container
                                            alignItems="center"
                                            justify="center"
                                        >
                                            <Box p={1}>
                                                <img
                                                    src={
                                                        window.location.origin +
                                                        "/uploads/profile/" +
                                                        vendor.image
                                                    }
                                                    alt=""
                                                    width="60px"
                                                    height="60px"
                                                />
                                            </Box>
                                        </Grid>
                                        <Grid item xs={12} md={8}>
                                            <Box px={3}>
                                                <Typography variant="h6">
                                                    {vendor.vendor_company_name}
                                                </Typography>
                                                <Typography variant="caption">
                                                    {averageRating} rating
                                                </Typography>
                                            </Box>
                                        </Grid>
                                    </Grid>
                                    <Divider variant="middle" />
                                    <Grid
                                        container
                                        direction="row"
                                        alignItems="center"
                                        justify="space-between"
                                    >
                                        <Grid item>
                                            <Box p={3} py={3}>
                                                <Typography variant="subtitle2">
                                                    Price
                                                </Typography>
                                            </Box>
                                        </Grid>
                                        <Grid item>
                                            <Box px={3} py={3}>
                                                <Typography variant="subtitle2">
                                                    TK{props.total}
                                                </Typography>
                                            </Box>
                                        </Grid>
                                    </Grid>
                                    <Divider variant="middle" />
                                    <Grid
                                        container
                                        direction="row"
                                        alignItems="center"
                                        justify="space-between"
                                    >
                                        <Grid item>
                                            <Box px={3} py={3}>
                                                <Typography variant="caption">
                                                    Service Date
                                                </Typography>
                                                <Typography variant="subtitle2">
                                                    {/* {
                                                        props.order
                                                            .shipping_address
                                                            .service_date
                                                    } */}
                                                    {moment(
                                                            props.order
                                                                ?.shipping_address
                                                                ?.service_date
                                                        ).format(
                                                            "MMMM Do YYYY, h:mm:ss a"
                                                        )}
                                                </Typography>
                                            </Box>
                                        </Grid>

                                        {
                                            paymentStatus == 1 ?
                                            <Grid item>
                                                <Box mt={2} ml={3}>
                                                    <Typography variant="h6" color="primary">
                                                        Review
                                                    </Typography>
                                                </Box>
                                                <Box px={3} py={3}>
                                                    {/* <TextField disabled={true}  id="standard-required" fullWidth label="Required" defaultValue='6' /> */}
                                                    <Rating
                                                        name="hover-feedback"
                                                        value={rating}
                                                        precision={0.5}
                                                        onChange={(event, newValue) => {
                                                            setRating(newValue);
                                                        }}
                                                        onChangeActive={(event, newHover) => {
                                                            setHover(newHover);
                                                        }}
                                                    />
                                                    {/* <TextField  id="standard-required" fullWidth label="Comment" value={comment} onChange={(e)=>setComment(e.target.value)}  /> */}
                                                </Box>
                                                <Box px={3} py={1}>
                                                    <TextareaAutosize
                                                        value={comment}
                                                        label="Comment"
                                                        onChange={(e)=>setComment(e.target.value)}
                                                        aria-label="minimum height"
                                                        placeholder="Your comments"
                                                        style={{ width: 200, height: 100 }}
                                                    />
                                                </Box>

                                                <Button
                                                    fullWidth
                                                    variant="contained"
                                                    color="primary"
                                                    className={classes.submit}
                                                    onClick={handleSubmit}
                                                >
                                                    Submit
                                                </Button>
                                            </Grid> : ''
                                        }

                                        {/* <Grid
                                            item
                                            container
                                            direction="row"
                                            justify="space-between"
                                        >
                                            <Box px={3} pb={2}>
                                                <Typography
                                                    variant="h6"
                                                    color="primary"
                                                >
                                                    Accepted
                                                </Typography>
                                            </Box>
                                        </Grid> */}
                                    </Grid>
                                </Paper>
                            </Grid>
                            <Grid item md={6}>
                                <Timeline>
                                    {props.status.map(stat => (
                                        <TimelineItem>
                                            <TimelineSeparator>
                                                <TimelineDot color="primary" />
                                                <TimelineConnector />
                                            </TimelineSeparator>
                                            <TimelineContent>
                                                <Typography
                                                    variant="subtitle2"
                                                    component="p"
                                                >
                                                    {stat.name}
                                                </Typography>
                                                <Typography variant="caption">
                                                    {stat.created_at}
                                                </Typography>
                                            </TimelineContent>
                                        </TimelineItem>
                                    ))}
                                </Timeline>
                            </Grid>
                        </Grid>
                    ) : (
                        <Grid item md={12}>
                            <Container maxWidth="xs">
                                <Box p={1}>
                                    <img
                                        src={
                                            window.location.origin +
                                            "/frontend/img/vendor/vendorSearch.png"
                                        }
                                        alt=""
                                        width="100%"
                                        height="300px"
                                    />
                                </Box>
                                <Typography
                                    variant="h6"
                                    color="primary"
                                    style={{ marginTop: 20 }}
                                    align="center"
                                >
                                    Waiting for Vendors
                                </Typography>
                                <Typography
                                    variant="body2"
                                    color="initial"
                                    style={{ marginTop: 20 }}
                                    align="center"
                                >
                                    We are evaluating best service provider for
                                    this service.
                                </Typography>
                                {
                                    ordervendor < 9 ?
                                    <Button 
                                        fullWidth
                                        variant="contained"
                                        color="primary"
                                        //disabled={ordervendor >= 2 ? true : false}
                                        onClick={againRequest}
                                    >
                                        Again Request
                                    </Button>
                                    : ''
                                }
                                
                            </Container>
                        </Grid>
                    )}
                </Grid>
            </Container>
            <Snackbar
                        open={alert.open}
                        autoHideDuration={2000}
                        onClose={handleClose}
                    >
                        <Alert
                            onClose={handleClose}
                            severity={alert.severity}
                            variant="filled"
                        >
                            {alert.massage}
                        </Alert>
                    </Snackbar>
        </motion.div>
    );
};
