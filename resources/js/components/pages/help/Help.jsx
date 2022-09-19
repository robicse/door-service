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
            "url(" + window.location.origin + "/frontend/img/help/help.png)",
        paddingTop: 120,
        paddingBottom: 120,
        backgroundSize: "cover",
        backgroundPosition: "center"
    }
}));

function TabPanel(props) {
    const { children, value, index, ...other } = props;

    return (
        <div
            role="tabpanel"
            hidden={value !== index}
            id={`simple-tabpanel-${index}`}
            aria-labelledby={`simple-tab-${index}`}
            {...other}
        >
            {value === index && (
                <Box p={3}>
                    <Typography>{children}</Typography>
                </Box>
            )}
        </div>
    );
}

TabPanel.propTypes = {
    children: PropTypes.node,
    index: PropTypes.any.isRequired,
    value: PropTypes.any.isRequired
};

function a11yProps(index) {
    return {
        id: `simple-tab-${index}`,
        "aria-controls": `simple-tabpanel-${index}`
    };
}

export const Help = () => {
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
                            Customer Help Center
                        </Typography>
                    </Box>
                </Grid>
                <Grid
                    container
                    direction="column"
                    justify="center"
                    alignItems="center"
                >
                    <Box mb={5}>
                        <div className={classes.appbarroot}>
                            <AppBar position="static">
                                <Tabs
                                    value={value}
                                    onChange={handleChange}
                                    aria-label="simple tabs example"
                                    variant="fullWidth"
                                >
                                    <Tab label="Service" {...a11yProps(0)} />
                                    <Tab label="Account" {...a11yProps(1)} />
                                    <Tab label="Pricing" {...a11yProps(2)} />
                                    <Tab label="Payment" {...a11yProps(3)} />
                                </Tabs>
                            </AppBar>
                            <TabPanel value={value} index={0}>
                                <ProviderHelpCenter />
                            </TabPanel>
                            <TabPanel value={value} index={1}>
                                <CustomerHelpCenter />
                            </TabPanel>
                            <TabPanel value={value} index={2}>
                                Pricing Ralated Question will be here
                            </TabPanel>
                            <TabPanel value={value} index={3}>
                                Payment Ralated Question will be here
                            </TabPanel>
                        </div>
                    </Box>
                </Grid>
                <Grid
                    container
                    direction="column"
                    justify="center"
                    alignItems="center"
                >
                    <Box mb={3}>
                        <Typography variant="h3" align="center">
                            Need Emergency Help
                        </Typography>
                    </Box>
                    <Box mb={1}>
                        <Typography variant="h2" align="center" color="primary">
                            Call Us
                        </Typography>
                    </Box>
                    <Box mb={1}>
                        <Avatar
                            className={classes.avatar}
                            align="center"
                            color="primary"
                        >
                            <CallIcon fontSize="large" />
                        </Avatar>
                    </Box>
                    <Box mb={5}>
                        <Typography variant="h2" align="center" color="primary">
                            01313-740740
                        </Typography>
                    </Box>
                </Grid>
            </Container>
        </motion.div>
    );
};
