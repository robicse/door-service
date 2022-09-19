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
import QuestionAnswerIcon from "@material-ui/icons/QuestionAnswer";
import { Link } from "react-router-dom";
import { useHistory } from "react-router-dom";
import { useRootStore } from "../../context/RootContext";

export const QuotedVendor = props => {
    //console.log(props);
    const [vendorstatus, setVendorStatus] = useState(false);
    const [vendor, setVendor] = useState([]);
    const history = useHistory();
    const store = useRootStore();
    const { set_current_order_vendor_id } = store;

    useAsyncEffect(
        async isMounted => {
            if (!isMounted()) return;

            if (!props.vendor) {
                return setVendorStatus(false);
            }
            setVendorStatus(true);
            setVendor(props.vendor);
        },
        [props.vendor]
    );
    const vendorChat = id => {
        //console.log(id);
        set_current_order_vendor_id(id);
        history.push("/user/request/vendor/book/" + id);
    };
    return (
        <motion.div
            initial={{ opacity: 0 }}
            animate={{ opacity: 1 }}
            exit={{ opacity: 0 }}
        >
            <Container maxWidth="lg" style={{ marginTop: 20 }}>
                <Grid container spacing={2}>
                    {vendorstatus ? (
                        vendor.map(ven => (
                            <Grid item md={4} key={ven.id}>
                                <Paper elevation={3}>
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
                                                        ven.image
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
                                                    {ven.name}
                                                </Typography>
                                                {/* <Typography variant="caption">
                                                    268 rating
                                                </Typography> */}
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
                                                    {
                                                        props.order
                                                            .shipping_address
                                                            .service_date
                                                    }
                                                </Typography>
                                            </Box>
                                        </Grid>
                                        <Grid
                                            item
                                            container
                                            direction="row"
                                            justify="flex-end"
                                        >
                                            <Box
                                                px={3}
                                                pb={2}
                                                onClick={() =>
                                                    vendorChat(
                                                        ven.order_vendor_id
                                                    )
                                                }
                                            >
                                                <Button
                                                    variant="contained"
                                                    color="primary"
                                                    startIcon={
                                                        <QuestionAnswerIcon />
                                                    }
                                                >
                                                    Start Chat
                                                </Button>
                                            </Box>
                                        </Grid>
                                    </Grid>
                                </Paper>
                            </Grid>
                        ))
                    ) : (
                        <Grid item md={12}>
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
                        </Grid>
                    )}
                </Grid>
            </Container>
        </motion.div>
    );
};
