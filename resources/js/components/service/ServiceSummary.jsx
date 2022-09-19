import React from "react";
import { useAsyncEffect } from "use-async-effect";
import { makeStyles } from "@material-ui/core/styles";
import { useState, useContext } from "react";
import { Link } from "react-router-dom";
import { Typography, Grid, Button, Container, Box } from "@material-ui/core";
import Skeleton from "@material-ui/lab/Skeleton";
import List from "@material-ui/core/List";
import ListItem from "@material-ui/core/ListItem";
import ListItemIcon from "@material-ui/core/ListItemIcon";
import ListItemText from "@material-ui/core/ListItemText";
import { observer } from "mobx-react-lite";
import { useRootStore } from "../context/RootContext";
import { useHistory } from "react-router-dom";
import Axios from "axios";
import { UserContext } from "../context/UserContext";
import { LoginModal } from "../auth/LoginModal";
import { motion } from "framer-motion";
import useMediaQuery from "@material-ui/core/useMediaQuery";
import { useTheme } from "@material-ui/core/styles";
import Dialog from "@material-ui/core/Dialog";
import DialogActions from "@material-ui/core/DialogActions";
import DialogContent from "@material-ui/core/DialogContent";
import DialogTitle from "@material-ui/core/DialogTitle";
import Lottie from "react-lottie";
import animationData from "../../src/lottie/request_confirmation.json";
import { delay } from "../../utils/delay";
import { Coupon } from "./Coupon";

const useStyles = makeStyles(theme => ({
    root: {
        flexGrow: 1,
        marginTop: 70,
        marginBottom: 30
    },
    leftGrid: {
        backgroundColor: "#F5F5F5",
        borderRadius: 6,
        borderTop: "3px solid #f16044",
        marginTop: 30
    },
    rightGrid: {
        backgroundColor: "#F5F5F5",
        borderRadius: 6,
        marginTop: 30
    },
    inline: {
        display: "inline"
    }
}));

export const ServiceSummary = observer(match => {
    const classes = useStyles();
    const store = useRootStore();
    const history = useHistory();
    const [open, setOpen] = useState(false);
    const [discount, setDiscount] = useState(0);
    const [coupon, setCoupon] = useState(false);
    const { user, setUser } = useContext(UserContext);
    const {
        service_title,
        getQuestionAnswerSet,
        service_location,
        service_location_lat,
        service_location_lng,
        getServiceDate,
        getTotalPrice,
        getUserLoginState,
        service_type,
        service_id,
        clearStore
    } = store;
    const [...set] = getQuestionAnswerSet;
    const question = [...set[0]];
    const answer = [...set[1]];
    const [confirmMasage, setConfirmMasage] = useState("Confirming Request");
    const [openConfirmationDialog, setConfirmationDialog] = React.useState(
        false
    );
    const theme = useTheme();
    const fullScreen = useMediaQuery(theme.breakpoints.down("sm"));

    const handleClickOpenConfirmationDialog = () => {
        setConfirmationDialog(true);
    };

    const handleCloseConfirmationDialog = () => {
        setConfirmationDialog(false);
    };
    const handleCouponVisibility = () => {
        setCoupon(true);
    };
    console.log("sta");
    console.log(getUserLoginState);
    const submitRequest = async () => {
        handleClickOpenConfirmationDialog();
        await delay(3000);
        setConfirmMasage("Request Confirmed");
        handleCloseConfirmationDialog();
        Axios.post(
            window.location.origin + `/api/user/order/request/submit`,
            {
                question: question,
                answer: answer,
                service_price: getTotalPrice,
                discount: discount,
                service_date: getServiceDate,
                service_address: service_location,
                service_lat: service_location_lat,
                service_lng: service_location_lng,
                service_name: service_title,
                service_type: service_type,
                name: user.user.name,
                phone: user.user.mobile_number,
                service_id: service_id
            },
            {
                headers: { Authorization: "Bearer " + user.token }
            }
        )
            .then(res => {
                clearStore();
                history.push("/user/request");
            })
            .catch(function(error) {
                console.log(error);
                handleCloseConfirmationDialog();
            });
    };

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
                            <Typography variant="subtitle2">
                                Request Summary
                            </Typography>
                        </Box>

                        <Grid container style={{ padding: "5px 30px" }}>
                            <Grid item md={3}>
                                <Typography
                                    variant="body1"
                                    style={{ fontWeight: "bold" }}
                                >
                                    Service Name :
                                </Typography>
                            </Grid>
                            <Grid item md={9}>
                                <Typography variant="body1">
                                    {service_title}.
                                </Typography>
                            </Grid>
                        </Grid>
                        <Grid container style={{ padding: "5px 30px" }}>
                            <Grid item md={3}>
                                <Typography
                                    variant="body1"
                                    style={{ fontWeight: "bold" }}
                                >
                                    Service Date :
                                </Typography>
                            </Grid>
                            <Grid item md={9}>
                                <Typography variant="body1">
                                    {getServiceDate}.
                                </Typography>
                            </Grid>
                        </Grid>
                        <Grid container style={{ padding: "5px 30px" }}>
                            <Grid item md={3}>
                                <Typography
                                    variant="body1"
                                    style={{ fontWeight: "bold" }}
                                >
                                    Service Location :
                                </Typography>
                            </Grid>
                            <Grid item md={9}>
                                <Typography variant="body1">
                                    {service_location}.
                                </Typography>
                            </Grid>
                        </Grid>
                        <Grid container direction="column" justify="flex-start">
                            <Box mt={5} ml={3}>
                                <Typography variant="subtitle2">
                                    Request Details
                                </Typography>
                            </Box>
                            <Box mt={1} ml={1}>
                                <List dense={true}>
                                    {answer.map((value, index) => (
                                        <ListItem key={index}>
                                            <ListItemIcon>
                                                <Typography>
                                                    {index + 1}
                                                </Typography>
                                            </ListItemIcon>
                                            <ListItemText
                                                primary={question[index]}
                                                secondary={
                                                    <React.Fragment>
                                                        {answer[index].map(
                                                            ans => ans
                                                        )}
                                                    </React.Fragment>
                                                }
                                            />
                                        </ListItem>
                                    ))}
                                </List>
                            </Box>
                        </Grid>
                    </Grid>
                    <Grid item xs={12} md={1}></Grid>
                    <Grid item xs={12} md={4}>
                        <Grid
                            container
                            direction="row"
                            alignItems="center"
                            justify="center"
                            className={classes.rightGrid}
                            style={{
                                padding: 10,
                                marginBottom: 30,
                                cursor: "pointer"
                            }}
                            onClick={handleCouponVisibility}
                        >
                            <Grid
                                item
                                xs={4}
                                md={4}
                                container
                                alignItems="center"
                                justify="center"
                            >
                                <Box p={1}>
                                    <img
                                        src={
                                            window.location.origin +
                                            "/frontend/img/discount.png"
                                        }
                                        alt=""
                                        width="70px"
                                        height="58px"
                                    />
                                </Box>
                            </Grid>
                            <Grid item xs={8} md={8}>
                                <Box px={1}>
                                    <Typography variant="body1">
                                        Have a Promo Code?
                                    </Typography>
                                    <Typography variant="body2" color="primary">
                                        Apply here to get a discount
                                    </Typography>
                                </Box>
                            </Grid>
                        </Grid>

                        {coupon && (
                            <Coupon
                                total={getTotalPrice}
                                coupon={coupon}
                                setCoupon={setCoupon}
                                setDiscount={setDiscount}
                            />
                        )}
                        <Grid
                            container
                            direction="row"
                            justify="flex-start"
                            style={{ marginBottom: 17 }}
                        >
                            <Typography variant="h6">
                                Payment Details
                            </Typography>
                        </Grid>

                        <Grid
                            container
                            direction="row"
                            justify="space-between"
                            style={{ marginBottom: 4 }}
                        >
                            <Typography variant="body1">
                                Estimated amount
                            </Typography>
                            <Typography variant="subtitle2">
                                TK{getTotalPrice}
                            </Typography>
                        </Grid>

                        <Grid
                            container
                            direction="row"
                            justify="space-between"
                            style={{ marginBottom: 17 }}
                        >
                            <Typography variant="body1">
                                Promo discount
                            </Typography>
                            <Typography variant="subtitle2">
                                TK{discount}
                            </Typography>
                        </Grid>

                        <Grid
                            container
                            direction="row"
                            justify="space-between"
                            style={{ marginBottom: 17 }}
                        >
                            <Typography variant="h6">Total</Typography>
                            <Typography variant="h6">
                                TK{getTotalPrice - discount}
                            </Typography>
                        </Grid>

                        <Box>
                            {getUserLoginState && user.user != undefined ? (
                                <Button
                                    fullWidth={true}
                                    variant="contained"
                                    color="primary"
                                    onClick={submitRequest}
                                >
                                    Submit Requestd
                                </Button>
                            ) : (
                                <LoginModal
                                    fullWidth="true"
                                    content="Submit Request"
                                    variant="contained"
                                    color="primary"
                                />
                            )}
                        </Box>

                        <Box mt={2}>
                            <Typography variant="caption">
                                By submitting your request, you agree to our
                                Terms of Use and Privacy Policy.
                            </Typography>
                        </Box>
                    </Grid>
                </Grid>
            </Container>

            <Dialog
                fullScreen={false}
                open={openConfirmationDialog}
                onClose={handleCloseConfirmationDialog}
                aria-labelledby="responsive-dialog-title"
                disableBackdropClick={true}
                disableEscapeKeyDown={true}
                maxWidth="xs"
            >
                {/* <DialogTitle id="responsive-dialog-title">
                    <Typography variant="h6" align="center" color="primary">
                        {confirmMasage}
                    </Typography>
                </DialogTitle> */}
                <DialogContent>
                    <Grid
                        container
                        direction="column"
                        justify="center"
                        alignItems="center"
                    >
                        <Lottie
                            options={{
                                loop: false,
                                autoplay: true,
                                animationData: animationData,
                                speed: 1,
                                rendererSettings: {
                                    preserveAspectRatio: "xMidYMid slice"
                                }
                            }}
                        />
                    </Grid>
                </DialogContent>
            </Dialog>
        </motion.div>
    );
});
