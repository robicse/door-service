import React, { useState } from "react";
import Grid from "@material-ui/core/Grid";
import Box from "@material-ui/core/Box";
import Typography from "@material-ui/core/Typography";
import { makeStyles } from "@material-ui/core/styles";
import Container from "@material-ui/core/Container";
import { useHistory } from "react-router-dom";
import { motion } from "framer-motion";
import Avatar from "@material-ui/core/Avatar";
import CallIcon from "@material-ui/icons/Call";
import PropTypes from "prop-types";
import AppBar from "@material-ui/core/AppBar";
import Tabs from "@material-ui/core/Tabs";
import Tab from "@material-ui/core/Tab";
import { CustomerHelpCenter } from "./CustomerHelpCenter";
import { ProviderHelpCenter } from "./ProviderHelpCenter";

const useStyles = makeStyles(theme => ({
    root: {
        flexGrow: 1,
        marginBottom: 100
    },
    appbarroot: {
        flexGrow: 1,
        backgroundColor: theme.palette.background.paper
    },
    paper: {
        marginTop: theme.spacing(8),
        display: "flex",
        flexDirection: "column",
        alignItems: "center"
    },
    avatar: {
        margin: theme.spacing(1),
        width: theme.spacing(10),
        height: theme.spacing(10),
        backgroundColor: theme.palette.primary.main
    },
    form: {
        width: "100%", // Fix IE 11 issue.
        marginTop: theme.spacing(1)
    },
    submit: {
        margin: theme.spacing(3, 0, 2)
    },
    background: {
        backgroundImage:
            "url(" + window.location.origin + "/frontend/img/help/payment.png)",
        paddingTop: 120,
        paddingBottom: 120,
        backgroundSize: "cover",
        backgroundPosition: "center"
    }
}));

export const OnlinePayment = () => {
    const classes = useStyles();
    const history = useHistory();
    const [open, setOpen] = useState(false);
    const [value, setValue] = React.useState(0);

    const handleChange = (event, newValue) => {
        setValue(newValue);
    };

    const handleClose = (event, reason) => {
        if (reason === "clickaway") {
            return;
        }
        setOpen(false);
    };

    return (
        <motion.div
            initial={{ opacity: 0 }}
            animate={{ opacity: 1 }}
            exit={{ opacity: 0 }}
        >
            <Container maxWidth="xl" disableGutters={true}>
                <Grid
                    container
                    direction="column"
                    justify="center"
                    alignItems="center"
                    className={classes.background}
                >
                    <Box mb={2}>
                        <Typography
                            variant="h2"
                            align="center"
                            style={{ color: "#ffffff" }}
                        >
                            Online Payment
                        </Typography>
                    </Box>
                </Grid>
                <Container maxWidth="md" disableGutters={true} sty>
                    <Grid
                        container
                        direction="column"
                        justify="center"
                        alignItems="center"
                        style={{ marginTop: 100 }}
                    >
                        <Grid item container direction="row">
                            <Grid
                                item
                                md={5}
                                container
                                justify="center"
                                alignItems="center"
                            >
                                <img
                                    src={
                                        window.location.origin +
                                        "/frontend/img/help/app.png"
                                    }
                                />
                            </Grid>
                            <Grid
                                item
                                md={7}
                                container
                                direction="column"
                                justify="center"
                                alignItems="flex-start"
                            >
                                <Box mb={2}>
                                    <Typography variant="h5">
                                        <span
                                            style={{
                                                fontWeight: "bold",
                                                color: "#ff5b3e"
                                            }}
                                        >
                                            Step-01 :
                                        </span>{" "}
                                        Pay Your Payment
                                    </Typography>
                                </Box>

                                <Box fontSize={17} lineHeight={1.6}>
                                    Lorem ipsum dolor sit amet, consectetuer
                                    adipiscing elit, sed diam nonummy nibh
                                    euismod tincidunt ut laoreet dolore magna
                                    aliquam erat volutpat. Ut wisi enim ad minim
                                    veniam, quis nostrud exerci tation
                                    ullamcorper suscipit lobortis nisl ut
                                    aliquip ex ea commodo consequat. Duis autem
                                    vel eum iriure dolor in hendrerit in
                                    vulputate velit esse molestie consequat, vel
                                    illum dolore eu feugiat nulla facilisis at
                                    vero eros et accumsan et iusto odio
                                    dignissim qui blandit praesent luptatum
                                    zzril delenit augue Lorem ipsum dolor sit
                                    amet, cons ectetuer adipiscing elit, sed
                                    diam nonummy nibh euismod tincidunt ut
                                    laoreet dolore magna
                                </Box>
                            </Grid>
                        </Grid>
                    </Grid>
                    <Grid
                        container
                        direction="column"
                        justify="center"
                        alignItems="center"
                        style={{ marginTop: 100 }}
                    >
                        <Grid item container direction="row">
                            <Grid
                                item
                                md={7}
                                container
                                direction="column"
                                justify="center"
                                alignItems="flex-start"
                            >
                                <Box mb={2}>
                                    <Typography variant="h5">
                                        <span
                                            style={{
                                                fontWeight: "bold",
                                                color: "#ff5b3e"
                                            }}
                                        >
                                            Step-02 :
                                        </span>{" "}
                                        Payment Method
                                    </Typography>
                                </Box>

                                <Box fontSize={17} lineHeight={1.6}>
                                    Lorem ipsum dolor sit amet, consectetuer
                                    adipiscing elit, sed diam nonummy nibh
                                    euismod tincidunt ut laoreet dolore magna
                                    aliquam erat volutpat. Ut wisi enim ad minim
                                    veniam, quis nostrud exerci tation
                                    ullamcorper suscipit lobortis nisl ut
                                    aliquip ex ea commodo consequat. Duis autem
                                    vel eum iriure dolor in hendrerit in
                                    vulputate velit esse molestie consequat, vel
                                    illum dolore eu feugiat nulla facilisis at
                                    vero eros et accumsan et iusto odio
                                    dignissim qui blandit praesent luptatum
                                    zzril delenit augue Lorem ipsum dolor sit
                                    amet, cons ectetuer adipiscing elit, sed
                                    diam nonummy nibh euismod tincidunt ut
                                    laoreet dolore magna
                                </Box>
                            </Grid>
                            <Grid
                                item
                                md={5}
                                container
                                justify="center"
                                alignItems="center"
                            >
                                <img
                                    src={
                                        window.location.origin +
                                        "/frontend/img/help/app.png"
                                    }
                                />
                            </Grid>
                        </Grid>
                    </Grid>
                    <Grid
                        container
                        direction="column"
                        justify="center"
                        alignItems="center"
                        style={{ marginTop: 100, marginBottom: 100 }}
                    >
                        <Grid item container direction="row">
                            <Grid
                                item
                                md={5}
                                container
                                justify="center"
                                alignItems="center"
                            >
                                <img
                                    src={
                                        window.location.origin +
                                        "/frontend/img/help/app.png"
                                    }
                                />
                            </Grid>
                            <Grid
                                item
                                md={7}
                                container
                                direction="column"
                                justify="center"
                                alignItems="flex-start"
                            >
                                <Box mb={2}>
                                    <Typography variant="h5">
                                        <span
                                            style={{
                                                fontWeight: "bold",
                                                color: "#ff5b3e"
                                            }}
                                        >
                                            Step-03 :
                                        </span>{" "}
                                        Put Your Amount
                                    </Typography>
                                </Box>

                                <Box fontSize={17} lineHeight={1.6}>
                                    Lorem ipsum dolor sit amet, consectetuer
                                    adipiscing elit, sed diam nonummy nibh
                                    euismod tincidunt ut laoreet dolore magna
                                    aliquam erat volutpat. Ut wisi enim ad minim
                                    veniam, quis nostrud exerci tation
                                    ullamcorper suscipit lobortis nisl ut
                                    aliquip ex ea commodo consequat. Duis autem
                                    vel eum iriure dolor in hendrerit in
                                    vulputate velit esse molestie consequat, vel
                                    illum dolore eu feugiat nulla facilisis at
                                    vero eros et accumsan et iusto odio
                                    dignissim qui blandit praesent luptatum
                                    zzril delenit augue Lorem ipsum dolor sit
                                    amet, cons ectetuer adipiscing elit, sed
                                    diam nonummy nibh euismod tincidunt ut
                                    laoreet dolore magna
                                </Box>
                            </Grid>
                        </Grid>
                    </Grid>
                </Container>
            </Container>
        </motion.div>
    );
};
