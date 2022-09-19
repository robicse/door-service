import React, { useContext } from "react";
import { UserContext } from "../context/UserContext";
import clsx from "clsx";
import { makeStyles, useTheme } from "@material-ui/core/styles";
import Drawer from "@material-ui/core/Drawer";
import List from "@material-ui/core/List";
import CssBaseline from "@material-ui/core/CssBaseline";
import Typography from "@material-ui/core/Typography";
import Divider from "@material-ui/core/Divider";
import IconButton from "@material-ui/core/IconButton";
import ChevronLeftIcon from "@material-ui/icons/ChevronLeft";
import ChevronRightIcon from "@material-ui/icons/ChevronRight";
import ListItem from "@material-ui/core/ListItem";
import ListItemIcon from "@material-ui/core/ListItemIcon";
import ListItemText from "@material-ui/core/ListItemText";
import SettingsIcon from "@material-ui/icons/Settings";
import LibraryBooksIcon from "@material-ui/icons/LibraryBooks";
import HomeWorkIcon from "@material-ui/icons/HomeWork";
import SwapHorizontalCircleIcon from "@material-ui/icons/SwapHorizontalCircle";
import { useRootStore } from "../context/RootContext";

import {
    BrowserRouter as Router,
    Switch,
    Route,
    Link,
    Redirect
} from "react-router-dom";
import { Navigate } from "./Navigate";
import { CircularProgress } from "@material-ui/core";

const drawerWidth = 240;

const useStyles = makeStyles(theme => ({
    root: {
        display: "flex",
        zIndex:-10
    },
    appBar: {
        // zIndex: theme.zIndex.drawer + 1,
        transition: theme.transitions.create(["width", "margin"], {
            easing: theme.transitions.easing.sharp,
            duration: theme.transitions.duration.leavingScreen
        })
    },
    appBarShift: {
        marginLeft: drawerWidth,
        width: `calc(100% - ${drawerWidth}px)`,
        transition: theme.transitions.create(["width", "margin"], {
            easing: theme.transitions.easing.sharp,
            duration: theme.transitions.duration.enteringScreen
        })
    },
    menuButton: {
        marginRight: 36
    },
    hide: {
        display: "none"
    },
    drawer: {
        width: drawerWidth,
        flexShrink: 0,
        whiteSpace: "nowrap"
    },
    drawerOpen: {
        width: drawerWidth,
        transition: theme.transitions.create("width", {
            easing: theme.transitions.easing.sharp,
            duration: theme.transitions.duration.enteringScreen
        })
    },
    drawerClose: {
        transition: theme.transitions.create("width", {
            easing: theme.transitions.easing.sharp,
            duration: theme.transitions.duration.leavingScreen
        }),
        overflowX: "hidden",
        width: theme.spacing(7) + 1,
        [theme.breakpoints.up("sm")]: {
            width: theme.spacing(9) + 1
        }
    },
    toolbar: {
        display: "flex",
        alignItems: "center",
        justifyContent: "flex-end",
        padding: theme.spacing(0, 1),
        // necessary for content to be below app bar
        ...theme.mixins.toolbar
    },
    content: {
        flexGrow: 1,
        padding: theme.spacing(3)
    },
    active: {
        backgroundColor: "#fe5f3f"
    }
}));

export const Sidebar = props => {
    const { user, setUser } = useContext(UserContext);
    const classes = useStyles();
    const theme = useTheme();
    const store = useRootStore();
    const { key, isVendor } = store;
    const [open, setOpen] = React.useState(true);
    const [switchLoader, setSwitchLoader] = React.useState(false);
    console.log(window.location.pathname);
    const handleDrawerOpen = () => {
        setOpen(true);
    };

    const handleDrawerClose = () => {
        setOpen(false);
    };

    // const beaVendor = () => {
    //     setSwitchLoader(true);
    //     axios
    //         .post(window.location.origin + `/beeee-a-vendor`, {
    //             mobile_number: user.user.mobile_number,
    //             password: key
    //         })
    //         .then(
    //             response => {
    //                 logout();
    //                 setSwitchLoader(false);
    //                 window.location.href = `${window.location.origin}/vendor/dashboard`;
    //             },
    //             error => {
    //                 setSwitchLoader(false);
    //                 alert("Something went wrong.Try again later");
    //                 console.log(error);
    //             }
    //         );
    // };
    // const switchToVendor = () => {
    //     setSwitchLoader(true);
    //     axios
    //         .post(window.location.origin + `/switch-to-vendor`, {
    //             mobile_number: user.user.mobile_number,
    //             password: key
    //         })
    //         .then(
    //             response => {
    //                 logout();
    //                 setSwitchLoader(false);
    //                 window.location.href = `${window.location.origin}/vendor/dashboard`;
    //             },
    //             error => {
    //                 setSwitchLoader(false);
    //                 alert("Something went wrong.Try again later");
    //                 console.log(error);
    //             }
    //         );
    // };

    // const logout = () => {
    //     setUser({
    //         token: undefined,
    //         user: undefined,
    //         isAuthenticate: false
    //     });
    //     localStorage.setItem("auth-token", "");
    // };
    //console.log(key)
    return (
        <div className={classes.root}>
            <CssBaseline />

            <Drawer
                variant="permanent"
                className={clsx(classes.drawer, {
                    [classes.drawerOpen]: open,
                    [classes.drawerClose]: !open
                })}
                classes={{
                    paper: clsx({
                        [classes.drawerOpen]: open,
                        [classes.drawerClose]: !open
                    })
                }}
            >
                <div className={classes.toolbar}>
                    <Link to="/">
                        <img
                            src={
                                window.location.origin +
                                "/frontend/img/home/logo_small.png"
                            }
                            alt=""
                            width="150px"
                        />
                    </Link>
                    <IconButton onClick={handleDrawerClose}>
                        {theme.direction === "rtl" ? (
                            <ChevronRightIcon color="primary" />
                        ) : (
                            <ChevronLeftIcon color="primary" />
                        )}
                    </IconButton>
                    <IconButton
                        onClick={handleDrawerOpen}
                        className={clsx(classes.menuButton, {
                            [classes.hide]: open
                        })}
                        style={{ marginRight: 0 }}
                    >
                        <ChevronRightIcon color="primary" />
                    </IconButton>
                </div>
                <Divider />
                <List>
                    <Link
                        to="/user/request"
                        style={{
                            textDecoration: "none",
                            color: "#565656"
                        }}
                    >
                        <ListItem
                            button
                            className={
                                window.location.pathname == "/user/request"
                                    ? classes.active
                                    : ""
                            }
                        >
                            <ListItemIcon>
                                <LibraryBooksIcon />
                            </ListItemIcon>
                            <ListItemText primary="Request" />
                        </ListItem>
                    </Link>
                    <Link
                        to="/user/settings"
                        style={{
                            textDecoration: "none",
                            color: "#565656"
                        }}
                    >
                        <ListItem
                            button
                            className={
                                window.location.pathname == "/user/settings"
                                    ? classes.active
                                    : ""
                            }
                        >
                            <ListItemIcon>
                                <SettingsIcon />
                            </ListItemIcon>
                            <ListItemText primary="Settings" />
                        </ListItem>
                    </Link>
                    {/* {switchLoader ? (
                        <ListItem title="Switching to Vendor">
                            <ListItemIcon>
                                <CircularProgress />
                            </ListItemIcon>
                            <ListItemText primary="Switching to Vendor" />
                        </ListItem>
                    ) : isVendor ? (
                        <ListItem
                            onClick={switchToVendor}
                            button
                            title="Switch To User"
                        >
                            <ListItemIcon>
                                <SwapHorizontalCircleIcon />
                            </ListItemIcon>
                            <ListItemText primary="Switch To Vendor" />
                        </ListItem>
                    ) : (
                        <ListItem
                            onClick={beaVendor}
                            button
                            title="Be a vendor"
                        >
                            <ListItemIcon>
                                <HomeWorkIcon />
                            </ListItemIcon>
                            <ListItemText primary="Be a vendor" />
                        </ListItem>
                    )} */}
                </List>
            </Drawer>
            <main className={classes.content}>
                <Navigate comp={props.comp} invoice={props.invoice} />
            </main>
        </div>
    );
};
