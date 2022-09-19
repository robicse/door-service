import {
    Box,
    Button,
    Container,
    Grid,
    Paper,
    Typography
} from "@material-ui/core";
import Divider from "@material-ui/core/Divider";
import React from "react";
import { useAsyncEffect } from "use-async-effect";
import { useState } from "react";
import DoneAllIcon from "@material-ui/icons/DoneAll";
import { motion } from "framer-motion";
import { Coupon } from "../../service/Coupon";
import Axios from "axios";
import { DesktopWindows } from "@material-ui/icons";

export const Payment = props => {
    const [paystatus, setPaysataus] = React.useState();
    const [couponOpen, setCouponOpen] = React.useState(false);

    useAsyncEffect(async isMounted => {
        if (!isMounted()) return;
        //console.log(props.order)
        
        // if (props.order.payment_status == 1) {
        //     return setPaysataus(true);
        // }
        // setPaysataus(false);


        if (props.order.payment_status == 0 && props.order.payment_process == 'authorized') {
            return setPaysataus(false);
        }
        setPaysataus(true);
    }, []);

    const paymentProcess = () => {
        Axios.post(window.location.origin + `/api/checkout/ssl/pay`, {
            order_id: props.order.id,
            total: props.total,
            discount: props.discount
        })
            .then(res => {
                // setConfirmMasage("Request Confirmed");
                // handleCloseConfirmationDialog();
                // history.push("/user/request");
                console.log(res.data);
                window.location.href = res.data;
            })
            .catch(function(error) {
                console.log(error);
                // handleCloseConfirmationDialog();
            });
    };
    const handleCoupon = () => {
        setCouponOpen(true);
    };

    return (
        <motion.div
            initial={{ opacity: 0 }}
            animate={{ opacity: 1 }}
            exit={{ opacity: 0 }}
        >
            {couponOpen && (
                <Coupon
                    total={props.total}
                    coupon={couponOpen}
                    setCoupon={setCouponOpen}
                    setDiscount={props.setDiscount}
                />
            )}
            <Container maxWidth="xs" style={{ marginTop: 20 }}>
                <Grid container>
                    <Grid item md={12}>
                        {true ? (
                            <Paper elevation={3}>
                                <Grid
                                    container
                                    direction="row"
                                    alignItems="center"
                                    justify="center"
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
                                                width="110px"
                                                height="90px"
                                            />
                                        </Box>
                                    </Grid>
                                    <Grid item xs={8} md={8}>
                                        <Button
                                            fullWidth={true}
                                            disabled={!props.couponstatus}
                                            onClick={handleCoupon}
                                        >
                                            <Box px={1}>
                                                <Typography
                                                    variant="body1"
                                                    align="left"
                                                >
                                                    Have a Promo Code?
                                                </Typography>
                                                <Typography
                                                    variant="body2"
                                                    color="primary"
                                                    align="left"
                                                >
                                                    Apply here to get a discount
                                                </Typography>
                                            </Box>
                                        </Button>
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
                                        <Box p={3} py={1}>
                                            <Typography variant="subtitle2">
                                                Discount
                                            </Typography>
                                        </Box>
                                    </Grid>
                                    <Grid item>
                                        <Box px={3} py={2}>
                                            <Typography variant="subtitle2">
                                                TK{props.discount}
                                            </Typography>
                                        </Box>
                                    </Grid>
                                </Grid>
                                <Grid
                                    container
                                    direction="row"
                                    alignItems="center"
                                    justify="space-between"
                                >
                                    <Grid item>
                                        <Box p={3} pt={0} pb={1}>
                                            <Typography variant="subtitle2">
                                                Total
                                            </Typography>
                                        </Box>
                                    </Grid>
                                    <Grid item>
                                        <Box px={3} pt={0} pb={1}>
                                            <Typography variant="subtitle2">
                                                TK
                                                {props.couponstatus
                                                    ? props.total -
                                                      props.discount
                                                    : props.total}
                                            </Typography>
                                        </Box>
                                    </Grid>
                                </Grid>
                                <Divider variant="middle" />
                                <Grid
                                    container
                                    direction="row"
                                    alignItems="center"
                                    justify="center"
                                >
                                    <Button
                                        fullWidth
                                        variant="contained"
                                        color="primary"
                                        disabled={paystatus}
                                        onClick={paymentProcess}
                                    >
                                        {paystatus ? "PAID" : "PAY"}
                                    </Button>
                                </Grid>
                            </Paper>
                        ) : (
                            <Box>
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
                                    Searching for Vendors
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
                            </Box>
                        )}
                    </Grid>
                </Grid>
            </Container>
        </motion.div>
    );
};
