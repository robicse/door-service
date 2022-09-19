import React from "react";
import PropTypes from "prop-types";
import { makeStyles } from "@material-ui/core/styles";
import Tabs from "@material-ui/core/Tabs";
import Tab from "@material-ui/core/Tab";
import Typography from "@material-ui/core/Typography";
import Box from "@material-ui/core/Box";
import { ChildCategory } from "./ChildCategory";
import { useAsyncEffect } from "use-async-effect";
import Backdrop from "@material-ui/core/Backdrop";
import CircularProgress from "@material-ui/core/CircularProgress";
import { motion } from "framer-motion";
import { Helmet } from "react-helmet";

function TabPanel(props) {
    const { children, value, index, ...other } = props;

    return (
        <div
            role="tabpanel"
            hidden={value !== index}
            id={`vertical-tabpanel-${index}`}
            aria-labelledby={`vertical-tab-${index}`}
            {...other}
        >
            {value === index && (
                <Box p={3}>
                    <Box>{children}</Box>
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
        id: `vertical-tab-${index}`,
        "aria-controls": `vertical-tabpanel-${index}`
    };
}

const useStyles = makeStyles(theme => ({
    root: {
        flexGrow: 1,
        backgroundColor: theme.palette.background.paper,
        display: "flex",
        height: 600
    },
    tabs: {
        borderRight: `1px solid ${theme.palette.divider}`
    },
    backdrop: {
        zIndex: theme.zIndex.drawer + 1,
        color: "#fff"
    }
}));

export const Category = () => {
    const classes = useStyles();
    const [value, setValue] = React.useState(0);
    const [services, setServices] = React.useState();
    const [loaded, setLoaded] = React.useState();
    const [backdrop, setBackdrop] = React.useState(false);
    const handleCloseBD = () => {
        setBackdrop(false);
    };
    const handleToggleBD = () => {
        setBackdrop(!backdrop);
    };
    useAsyncEffect(async isMounted => {
        window.scrollTo(0, 0);
        try {
            const ser = await axios.get(
                window.location.origin + "/api/category/subcategory/service/all"
            );
            if (!isMounted()) return;
            console.log(ser);
            if (ser.data.success.lenght != 0) {
                setServices(ser.data.success);
                setLoaded(true);
            } else {
                console.log("No Data");
                setLoaded(false);
            }
        } catch (error) {
            console.log(error);
            setLoaded(false);
        }
    }, []);

    const handleChange = (event, newValue) => {
        setValue(newValue);
    };
    console.log(typeof services);
    return (
        <motion.div
            initial={{ opacity: 0 }}
            animate={{ opacity: 1 }}
            exit={{ opacity: 0 }}
            className={classes.root}
        >
            <Helmet>
                <title>Service | Doorservice</title>
            </Helmet>
            {loaded && (
                <>
                    <Tabs
                        orientation="vertical"
                        variant="scrollable"
                        indicatorColor="primary"
                        value={value}
                        onChange={handleChange}
                        aria-label="Vertical tabs"
                        className={classes.tabs}
                    >
                        {services.map((service, index) => (
                            <Tab
                                label={service.category}
                                {...a11yProps(index)}
                                key={index}
                            />
                        ))}
                    </Tabs>
                    {services.map((service, index) => (
                        <TabPanel value={value} index={index} key={index}>
                            {service.subcategories.length > 0 ? (
                                <ChildCategory
                                    subcategory={service.subcategories}
                                />
                            ) : (
                                <Typography variant="h5" color="primary">
                                    Nothing Found
                                </Typography>
                            )}
                        </TabPanel>
                    ))}
                </>
            )}

            <Backdrop className={classes.backdrop} open={!loaded}>
                <CircularProgress color="inherit" />
            </Backdrop>
        </motion.div>
    );
};
