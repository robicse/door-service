import React from "react";
import PropTypes from "prop-types";
import SwipeableViews from "react-swipeable-views";
import { makeStyles, useTheme } from "@material-ui/core/styles";
import AppBar from "@material-ui/core/AppBar";
import Tabs from "@material-ui/core/Tabs";
import Tab from "@material-ui/core/Tab";
import Typography from "@material-ui/core/Typography";
import Box from "@material-ui/core/Box";
import Paper from "@material-ui/core/Paper";
import HomeIcon from "@material-ui/icons/Home";
import AccountBalanceWalletIcon from "@material-ui/icons/AccountBalanceWallet";
import PlaylistAddCheckIcon from "@material-ui/icons/PlaylistAddCheck";
import { Details } from "./requestdetails/Details";
import { Payment } from "./requestdetails/Payment";
import { VendorInfo } from "./requestdetails/VendorInfo";
import { Container, Grid, Button } from "@material-ui/core";
import ArrowBackIcon from "@material-ui/icons/ArrowBack";
import { Link } from "react-router-dom";
import { useAsyncEffect } from "use-async-effect";
import { UserContext } from "../context/UserContext";
import { useContext, useState } from "react";
import { useHistory } from "react-router-dom";
import CircularProgress from "@material-ui/core/CircularProgress";
import LibraryBooksIcon from "@material-ui/icons/LibraryBooks";
import { QuotedVendor } from "./requestdetails/QuotedVendor";
import { Helmet } from "react-helmet";

function TabPanel(props) {
    const { children, value, index, ...other } = props;

    return (
        <div
            role="tabpanel"
            hidden={value !== index}
            id={`full-width-tabpanel-${index}`}
            aria-labelledby={`full-width-tab-${index}`}
            {...other}
        >
            {value === index && <Box p={1}>{children}</Box>}
        </div>
    );
}

TabPanel.propTypes = {
    children: PropTypes.node,
    index: PropTypes.any.isRequired,
    value: PropTypes.any.isRequired
};
const useStyles = makeStyles(theme => ({
    root: {
        backgroundColor: theme.palette.background.paper
    }
}));

function a11yProps(index) {
    return {
        id: `full-width-tab-${index}`,
        "aria-controls": `full-width-tabpanel-${index}`
    };
}

export const RequestDetails = ({ invoice_id }) => {
    const classes = useStyles();
    const theme = useTheme();
    const [value, setValue] = React.useState(0);
    const [loaded, setLoaded] = React.useState(false);
    const [questionAnswer, setQuestionAnswer] = React.useState([]);
    const [vendor, setVendor] = React.useState();
    const [order, setOrder] = React.useState([]);
    const [orderStatus, setOrderStatus] = React.useState([]);
    const { user, setUser } = useContext(UserContext);
    const [total, setTotal] = React.useState();
    const [discount, setDiscount] = React.useState();
    const [couponstatus, setCouponstaus] = React.useState(false);
    const [completeFetch, setCompleteFetch] = React.useState(false);
    const [quotedVendor, setQuotedVendor] = React.useState([]);

    const history = useHistory();

    if (user.isAuthenticate == false) {
        history.push("/signin");
    }
    useAsyncEffect(async isMounted => {
        setCompleteFetch(true);
        try {
            const request_details = await axios.post(
                window.location.origin + "/api/user/order/request/get/details",
                {
                    order_invoice_id: invoice_id
                },
                {
                    headers: { Authorization: "Bearer " + user.token }
                }
            );
            if (!isMounted()) return;

            if (request_details.data.response.lenght != 0) {
                console.log(request_details.data);
                setQuotedVendor(request_details.data.response[3]);
                setQuestionAnswer(request_details.data.response[0]);
                setVendor(request_details.data.response[1]);
                setOrder(request_details.data.response[2]);
                setTotal(request_details.data.response[2].grand_total);
                setOrderStatus(request_details.data.response[4]);
                setDiscount(request_details.data.response[2].coupon_discount);
                if (request_details.data.response[2].coupon_discount == 0) {
                    setCouponstaus(true);
                }
                setLoaded(true);
            } else {
                console.log("No Data");
                setLoaded(false);
            }
        } catch (error) {
            console.log(error);
            setLoaded(false);
        }
        setCompleteFetch(false);
    }, []);

    const handleChange = (event, newValue) => {
        setValue(newValue);
    };

    const handleChangeIndex = index => {
        setValue(index);
    };

    return (
        <div className={classes.root}>
            <Helmet>
                <title>Request {invoice_id} | Doorservice</title>
            </Helmet>
            <Container maxWidth="lg">
                <Grid container spacing={2}>
                    <Grid
                        item
                        md={12}
                        container
                        direction="row"
                        justify="space-between"
                        alignItems="center"
                    >
                        <Link
                            to="/user/request"
                            style={{ textDecoration: "none", color: "#f97459" }}
                        >
                            <ArrowBackIcon />
                        </Link>
                        <Typography variant="h6">
                            {loaded && order.shipping_address.service_name}
                        </Typography>
                    </Grid>
                    <Grid item md={12}>
                        <Paper variant="outlined">
                            <Tabs
                                value={value}
                                onChange={handleChange}
                                indicatorColor="primary"
                                textColor="primary"
                                centered
                            >
                                <Tab
                                    label="Booked Vendor"
                                    icon={<HomeIcon />}
                                    {...a11yProps(0)}
                                />
                                <Tab
                                    label="Payment"
                                    icon={<AccountBalanceWalletIcon />}
                                    {...a11yProps(1)}
                                />
                                <Tab
                                    label="Details"
                                    icon={<PlaylistAddCheckIcon />}
                                    {...a11yProps(2)}
                                />
                                {quotedVendor.length != 0 && (
                                    <Tab
                                        label="Quoted Vendor"
                                        icon={<LibraryBooksIcon />}
                                        {...a11yProps(3)}
                                    />
                                )}
                            </Tabs>
                        </Paper>
                        <SwipeableViews
                            axis={theme.direction === "rtl" ? "x-reverse" : "x"}
                            index={value}
                            onChangeIndex={handleChangeIndex}
                        >
                            <TabPanel
                                value={value}
                                index={0}
                                dir={theme.direction}
                            >
                                {completeFetch ? (
                                    <Grid
                                        container
                                        align="center"
                                        justify="center"
                                    >
                                        <Box mt={3}>
                                            {true && (
                                                <CircularProgress
                                                    size={70}
                                                    thickness={2.5}
                                                />
                                            )}
                                        </Box>
                                    </Grid>
                                ) : (
                                    <VendorInfo
                                        vendor={vendor}
                                        total={total}
                                        order={order}
                                        status={orderStatus}
                                        type={questionAnswer.service_type}
                                    />
                                )}
                            </TabPanel>
                            <TabPanel
                                value={value}
                                index={1}
                                dir={theme.direction}
                            >
                                {completeFetch ? (
                                    <Grid
                                        container
                                        align="center"
                                        justify="center"
                                    >
                                        <Box mt={3}>
                                            {true && (
                                                <CircularProgress
                                                    size={70}
                                                    thickness={2.5}
                                                />
                                            )}
                                        </Box>
                                    </Grid>
                                ) : (
                                    <Payment
                                        order={order}
                                        total={total}
                                        setTotal={setTotal}
                                        discount={discount}
                                        setDiscount={setDiscount}
                                        couponstatus={couponstatus}
                                    />
                                )}
                            </TabPanel>
                            <TabPanel
                                value={value}
                                index={2}
                                dir={theme.direction}
                            >
                                {completeFetch ? (
                                    <Grid
                                        container
                                        align="center"
                                        justify="center"
                                    >
                                        <Box mt={3}>
                                            {true && (
                                                <CircularProgress
                                                    size={70}
                                                    thickness={2.5}
                                                />
                                            )}
                                        </Box>
                                    </Grid>
                                ) : (
                                    <Details
                                        details={questionAnswer}
                                        order={order}
                                    />
                                )}
                            </TabPanel>

                            <TabPanel
                                value={value}
                                index={3}
                                dir={theme.direction}
                            >
                                {completeFetch ? (
                                    <Grid
                                        container
                                        align="center"
                                        justify="center"
                                    >
                                        <Box mt={3}>
                                            {true && (
                                                <CircularProgress
                                                    size={70}
                                                    thickness={2.5}
                                                />
                                            )}
                                        </Box>
                                    </Grid>
                                ) : (
                                    // <VendorInfo
                                    //     vendor={vendor}
                                    //     total={total}
                                    //     order={order}
                                    //     type={questionAnswer.service_type}
                                    // />
                                    <QuotedVendor
                                        vendor={quotedVendor}
                                        total={total}
                                        order={order}
                                    />
                                )}
                            </TabPanel>
                        </SwipeableViews>
                    </Grid>
                </Grid>
            </Container>
        </div>
    );
};
