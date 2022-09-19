import React, { useContext, useState } from "react";
import { Link } from "react-router-dom";
import { makeStyles } from "@material-ui/core/styles";
import AppBar from "@material-ui/core/AppBar";
import Toolbar from "@material-ui/core/Toolbar";
import Typography from "@material-ui/core/Typography";
import Button from "@material-ui/core/Button";
import IconButton from "@material-ui/core/IconButton";
import Avatar from "@material-ui/core/Avatar";
import MenuIcon from "@material-ui/icons/Menu";
import { About } from "../pages/About";
import Contact from "../pages/Contact";
import Grid from "@material-ui/core/Grid";
import Menu from "@material-ui/core/Menu";
import MenuItem from "@material-ui/core/MenuItem";
import { withStyles } from "@material-ui/core/styles";
import ListItemIcon from "@material-ui/core/ListItemIcon";
import ListItemText from "@material-ui/core/ListItemText";
import { UserContext } from "../context/UserContext";
import HomeIcon from "@material-ui/icons/Home";
import HomeTwoToneIcon from "@material-ui/icons/HomeTwoTone";
import { useAsyncEffect } from "use-async-effect";
import { useRootStore } from "../context/RootContext";
import { Box, Divider } from "@material-ui/core";
import { delay } from "../../utils/delay";
import CircularProgress from "@material-ui/core/CircularProgress";
import { MegaMenu } from "./MegaMenu";
import ExpandMoreIcon from "@material-ui/icons/ExpandMore";
import LocalMallIcon from "@material-ui/icons/LocalMall";
import SettingsApplicationsIcon from "@material-ui/icons/SettingsApplications";
import ListAltIcon from "@material-ui/icons/ListAlt";
import ExitToAppIcon from "@material-ui/icons/ExitToApp";
import BookIcon from "@material-ui/icons/Book";
import CardMembershipIcon from "@material-ui/icons/CardMembership";
import LiveHelpIcon from "@material-ui/icons/LiveHelp";
import HomeWorkIcon from "@material-ui/icons/HomeWork";
import SwapHorizontalCircleIcon from "@material-ui/icons/SwapHorizontalCircle";
import { useHistory } from "react-router-dom";

const useStyles = makeStyles(theme => ({
    root: {
        flexGrow: 1,
        marginBottom: 63
    },
    // menuButton: {
    //     marginRight: theme.spacing(2)
    // },
    navLink: {
        textDecoration: "none",
        color: "#000000"
    },
    title: {
        marginRight: 20,
        marginTop: 5,
        fontSize: 14
    },
    logo: {
        flexGrow: 1
    },
    navDesktop: {
        [theme.breakpoints.down("xs")]: {
            display: "none"
        }
    },
    navMobile: {
        [theme.breakpoints.up("md")]: {
            display: "none"
        }
    },
    listItemText: {
        fontSize: "0.9em" //Insert your required size
    }
}));

const StyledMenu = withStyles({
    paper: {
        border: "1px solid #d3d4d5"
    }
})(props => (
    <Menu
        elevation={0}
        getContentAnchorEl={null}
        anchorOrigin={{
            vertical: "bottom",
            horizontal: "center"
        }}
        transformOrigin={{
            vertical: "top",
            horizontal: "center"
        }}
        {...props}
    />
));

const StyledMenuItem = withStyles(theme => ({
    root: {
        // "&:focus": {
        //     backgroundColor: theme.palette.primary.main,
        //     "& .MuiListItemIcon-root, & .MuiListItemText-primary": {
        //         color: theme.palette.common.white
        //     }
        // }
    }
}))(MenuItem);

export const Header = () => {
    const { user, setUser } = useContext(UserContext);
    const [home, setHome] = useState("fixed");
    const [logoutstate, setLogoutstate] = useState(false);
    const classes = useStyles();
    const [anchorEl, setAnchorEl] = useState(null);
    const store = useRootStore();
    const { setLogInState, key, isVendor, setHomescroll } = store;
    const [switchLoader, setSwitchLoader] = React.useState(false);
    const test = window.location.origin;
    // React.useEffect(() => {
    //     if (window.location.href == window.location) {
    //         setHome("fixed");
    //     } else {
    //         console.log("static");
    //     }
    // }, [home]);
    const history = useHistory();
    const handleHomeClick = () => {
        console.log(window.location);
        if (window.location.pathname == "/") {
            window.location.href = `${window.location.origin}`;
        } else {
            history.push("/");
        }
    };
    const handleClick = event => {
        setAnchorEl(event.currentTarget);
    };

    const handleClose = () => {
        setAnchorEl(null);
    };

    const [anchorElHelp, setAnchorElHelp] = React.useState(null);

    const handleClickHelp = event => {
        setAnchorElHelp(event.currentTarget);
    };

    const handleCloseHelp = () => {
        setAnchorElHelp(null);
    };
    const logout = async () => {
        setLogoutstate(true);
        await delay(500);
        setLogoutstate(false);
        setUser({
            token: undefined,
            user: undefined,
            isAuthenticate: false
        });
        setLogInState(false);
        localStorage.setItem("auth-token", "");
    };
    const logoutFast = () => {
        setUser({
            token: undefined,
            user: undefined,
            isAuthenticate: false
        });
        localStorage.setItem("auth-token", "");
    };

    const beaVendor = () => {
        setSwitchLoader(true);
        axios
            .post(window.location.origin + `/beeee-a-vendor`, {
                mobile_number: user.user.mobile_number,
                password: key
            })
            .then(
                response => {
                    logoutFast();
                    setSwitchLoader(false);
                    window.location.href = `${window.location.origin}/vendor/dashboard`;
                },
                error => {
                    setSwitchLoader(false);
                    alert("Something went wrong.Try again later");
                    console.log(error);
                }
            );
    };
    const switchToVendor = () => {
        setSwitchLoader(true);
        axios
            .post(window.location.origin + `/switch-to-vendor`, {
                mobile_number: user.user.mobile_number,
                password: key
            })
            .then(
                response => {
                    logoutFast();
                    setSwitchLoader(false);
                    window.location.href = `${window.location.origin}/vendor/dashboard`;
                },
                error => {
                    setSwitchLoader(false);
                    alert("Something went wrong.Try again later");
                    console.log(error);
                }
            );
    };
    return (
        <div>
            <div>
                <div className={classes.root}>
                    {user.user ? (
                        <>
                            <AppBar
                                position={home}
                                elevation={0}
                                style={{ backgroundColor: "#ffffff" }}
                            >
                                <Toolbar>
                                    <Grid
                                        container
                                        justify="flex-end"
                                        alignItems="center"
                                    >
                                        <Box
                                            className={classes.logo}
                                            edge="start"
                                            onClick={handleHomeClick}
                                            style={{ cursor: "pointer" }}
                                        >
                                            <img
                                                src={
                                                    window.location.origin +
                                                    "/frontend/img/home/logo_small.png"
                                                }
                                                alt=""
                                                width="150px"
                                            />
                                        </Box>
                                        <Typography
                                            className={classes.title}
                                            color="primary"
                                        >
                                            Hi,{user.user.name}
                                        </Typography>

                                        <Typography
                                            className={classes.title}
                                            onClick={handleHomeClick}
                                            style={{ cursor: "pointer" }}
                                        >
                                            <HomeTwoToneIcon
                                                color="primary"
                                                fontSize="large"
                                            />
                                        </Typography>

                                        <IconButton
                                            edge="start"
                                            color="primary"
                                            aria-label="menu"
                                            aria-controls="simple-menu-2"
                                            aria-haspopup="true"
                                            component="div"
                                            onClick={handleClick}
                                        >
                                            {logoutstate ? (
                                                <Button
                                                    color="primary"
                                                    size="small"
                                                    className={classes.button}
                                                    startIcon={
                                                        <CircularProgress
                                                            size={20}
                                                        />
                                                    }
                                                >
                                                    Logging Out
                                                </Button>
                                            ) : (
                                                <Avatar
                                                    alt="user"
                                                    src={
                                                        window.location.origin +
                                                        "/uploads/profile/" +
                                                        user.user.image
                                                    }
                                                />
                                            )}
                                        </IconButton>
                                        <Menu
                                            id="simple-menu-2"
                                            anchorEl={anchorEl}
                                            anchorOrigin={{
                                                vertical: "bottom",
                                                horizontal: "center"
                                            }}
                                            transformOrigin={{
                                                vertical: "top",
                                                horizontal: "center"
                                            }}
                                            keepMounted
                                            open={Boolean(anchorEl)}
                                            onClose={handleClose}
                                        >
                                            <Link
                                                to="/user/request"
                                                className={classes.navLink}
                                            >
                                                <MenuItem onClick={handleClose}>
                                                    <Button
                                                        startIcon={
                                                            <LocalMallIcon />
                                                        }
                                                    >
                                                        Requested Order
                                                    </Button>
                                                </MenuItem>
                                            </Link>

                                            <Link
                                                to="/services/explore"
                                                className={classes.navLink}
                                            >
                                                <MenuItem onClick={handleClose}>
                                                    <Button
                                                        startIcon={
                                                            <ListAltIcon />
                                                        }
                                                    >
                                                        Book a Service
                                                    </Button>
                                                </MenuItem>
                                            </Link>
                                            <Link
                                                to="/user/settings"
                                                className={classes.navLink}
                                            >
                                                <MenuItem onClick={handleClose}>
                                                    <Button
                                                        startIcon={
                                                            <SettingsApplicationsIcon />
                                                        }
                                                    >
                                                        My Profile
                                                    </Button>
                                                </MenuItem>
                                            </Link>
                                            <Link
                                                to="/blog"
                                                className={classes.navLink}
                                            >
                                                <MenuItem onClick={handleClose}>
                                                    <Button
                                                        startIcon={<BookIcon />}
                                                    >
                                                        Blog
                                                    </Button>
                                                </MenuItem>
                                            </Link>
                                            <Link
                                                to="/career/job"
                                                className={classes.navLink}
                                            >
                                                <MenuItem onClick={handleClose}>
                                                    <Button
                                                        startIcon={
                                                            <CardMembershipIcon />
                                                        }
                                                    >
                                                        Carrer
                                                    </Button>
                                                </MenuItem>
                                            </Link>
                                            <Link
                                                to="/help/center"
                                                className={classes.navLink}
                                            >
                                                <MenuItem onClick={handleClose}>
                                                    <Button
                                                        startIcon={
                                                            <LiveHelpIcon />
                                                        }
                                                    >
                                                        Help
                                                    </Button>
                                                </MenuItem>
                                            </Link>
                                            <Box mb={1}>
                                                <Divider />
                                            </Box>

                                            {switchLoader ? (
                                                <MenuItem onClick={handleClose}>
                                                    <Button
                                                        color="primary"
                                                        size="small"
                                                        variant="contained"
                                                        fullWidth={true}
                                                        startIcon={
                                                            <CircularProgress size="1" />
                                                        }
                                                    >
                                                        Switching...
                                                    </Button>
                                                </MenuItem>
                                            ) : isVendor ? (
                                                <MenuItem onClick={handleClose}>
                                                    <Button
                                                        color="primary"
                                                        size="small"
                                                        variant="contained"
                                                        fullWidth={true}
                                                        onClick={switchToVendor}
                                                        startIcon={
                                                            <SwapHorizontalCircleIcon />
                                                        }
                                                    >
                                                        Switch To Vendor
                                                    </Button>
                                                </MenuItem>
                                            ) : (
                                                <MenuItem onClick={handleClose}>
                                                    <Button
                                                        color="primary"
                                                        size="small"
                                                        variant="contained"
                                                        fullWidth={true}
                                                        onClick={beaVendor}
                                                        startIcon={
                                                            <HomeWorkIcon />
                                                        }
                                                    >
                                                        Be a vendor
                                                    </Button>
                                                </MenuItem>
                                            )}
                                            <MenuItem onClick={handleClose}>
                                                <Button
                                                    color="primary"
                                                    size="small"
                                                    variant="contained"
                                                    fullWidth={true}
                                                    onClick={logout}
                                                    startIcon={
                                                        <ExitToAppIcon />
                                                    }
                                                >
                                                    Log Out
                                                </Button>
                                            </MenuItem>
                                        </Menu>
                                    </Grid>
                                </Toolbar>
                            </AppBar>
                        </>
                    ) : (
                        <>
                            <AppBar
                                position={home}
                                elevation={0}
                                style={{ backgroundColor: "#ffffff" }}
                            >
                                <Toolbar>
                                    <IconButton
                                        edge="end"
                                        className={classes.navMobile}
                                        color="primary"
                                        aria-label="menu"
                                        aria-controls="simple-menu"
                                        aria-haspopup="true"
                                        onClick={handleClick}
                                    >
                                        <MenuIcon />
                                    </IconButton>

                                    <Menu
                                        id="simple-menu"
                                        anchorEl={anchorEl}
                                        keepMounted
                                        open={Boolean(anchorEl)}
                                        onClose={handleClose}
                                    >
                                        <MenuItem onClick={handleClose}>
                                            <Link
                                                to="/"
                                                className={classes.navLink}
                                                onClick={handleClose}
                                            >
                                                Home
                                            </Link>
                                        </MenuItem>
                                        <MenuItem onClick={handleClose}>
                                            <Link
                                                to="/signup"
                                                className={classes.navLink}
                                                onClick={handleClose}
                                            >
                                                Be Our Vendor
                                            </Link>
                                        </MenuItem>
                                        <MenuItem onClick={handleClose}>
                                            <Link
                                                to="/services/explore"
                                                className={classes.navLink}
                                                onClick={handleClose}
                                            >
                                                Book a Service
                                            </Link>
                                        </MenuItem>
                                        <MenuItem onClick={handleClose}>
                                            <Link
                                                to="/blog"
                                                className={classes.navLink}
                                                onClick={handleClose}
                                            >
                                                Blog
                                            </Link>
                                        </MenuItem>
                                        <MenuItem onClick={handleClose}>
                                            <Link
                                                to="/career/job"
                                                className={classes.navLink}
                                                onClick={handleClose}
                                            >
                                                Career
                                            </Link>
                                        </MenuItem>
                                        <MenuItem onClick={handleClose}>
                                            <Link
                                                to="/"
                                                className={classes.navLink}
                                                onClick={handleClose}
                                            >
                                                Help
                                            </Link>
                                        </MenuItem>

                                        <MenuItem>
                                            <Link
                                                to="/signin"
                                                className={classes.navLink}
                                                onClick={handleClose}
                                            >
                                                Sign In
                                            </Link>
                                        </MenuItem>
                                    </Menu>
                                    <Grid
                                        container
                                        justify="flex-end"
                                        className={classes.navDesktop}
                                        alignItems="center"
                                    >
                                        <Box
                                            className={classes.logo}
                                            edge="start"
                                        >
                                            <Link
                                                to="/"
                                                className={classes.navLink}
                                            >
                                                <img
                                                    src={
                                                        window.location.origin +
                                                        "/frontend/img/home/logo_small.png"
                                                    }
                                                    alt=""
                                                    width="150px"
                                                />
                                            </Link>
                                        </Box>

                                        <Typography
                                            className={classes.title}
                                            onClick={handleHomeClick}
                                            style={{
                                                cursor: "pointer",
                                                color: "black"
                                            }}
                                        >
                                            Home
                                        </Typography>

                                        <Typography className={classes.title}>
                                            <Link
                                                to="/signup"
                                                className={classes.navLink}
                                                onClick={handleClose}
                                            >
                                                Be Our Vendor
                                            </Link>
                                        </Typography>

                                        <Typography className={classes.title}>
                                            <Link
                                                to="/services/explore"
                                                className={classes.navLink}
                                                onClick={handleClose}
                                            >
                                                Book a Service
                                            </Link>
                                        </Typography>
                                        <Typography className={classes.title}>
                                            <Link
                                                to="/blog"
                                                className={classes.navLink}
                                                onClick={handleClose}
                                            >
                                                Blog
                                            </Link>
                                        </Typography>
                                        <Typography className={classes.title}>
                                            <Link
                                                to="/career/job"
                                                className={classes.navLink}
                                                onClick={handleClose}
                                            >
                                                Career
                                            </Link>
                                        </Typography>
                                        <Typography className={classes.title}>
                                            <Button
                                                aria-controls="customized-menu"
                                                aria-haspopup="true"
                                                size="small"
                                                endIcon={
                                                    <ExpandMoreIcon>
                                                        send
                                                    </ExpandMoreIcon>
                                                }
                                                onClick={handleClickHelp}
                                                style={{
                                                    textTransform: "capitalize"
                                                }}
                                            >
                                                Help
                                            </Button>
                                            <StyledMenu
                                                id="customized-menu"
                                                anchorEl={anchorElHelp}
                                                keepMounted
                                                open={Boolean(anchorElHelp)}
                                                onClose={handleCloseHelp}
                                            >
                                                <Link
                                                    to="/help/center"
                                                    style={{
                                                        color: "#000000",
                                                        textDecoration: "none"
                                                    }}
                                                >
                                                    <StyledMenuItem
                                                        onClick={
                                                            handleCloseHelp
                                                        }
                                                    >
                                                        <ListItemText
                                                            primary="Customer Help Center"
                                                            classes={{
                                                                primary:
                                                                    classes.listItemText
                                                            }}
                                                        />
                                                    </StyledMenuItem>
                                                </Link>

                                                <Link
                                                    to="/payment/process"
                                                    style={{
                                                        color: "#000000",
                                                        textDecoration: "none"
                                                    }}
                                                >
                                                    <StyledMenuItem
                                                        onClick={
                                                            handleCloseHelp
                                                        }
                                                    >
                                                        <ListItemText
                                                            primary="Online Payment"
                                                            classes={{
                                                                primary:
                                                                    classes.listItemText
                                                            }}
                                                        />
                                                    </StyledMenuItem>
                                                </Link>
                                                <Link
                                                    to="/help/center"
                                                    style={{
                                                        color: "#000000",
                                                        textDecoration: "none"
                                                    }}
                                                >
                                                    <StyledMenuItem
                                                        onClick={
                                                            handleCloseHelp
                                                        }
                                                    >
                                                        <ListItemText
                                                            primary="Service Provider Help Center"
                                                            classes={{
                                                                primary:
                                                                    classes.listItemText
                                                            }}
                                                        />
                                                    </StyledMenuItem>
                                                </Link>
                                            </StyledMenu>
                                            {/* <Link
                                                to="/"
                                                className={classes.navLink}
                                                onClick={handleClose}
                                            >
                                                Help
                                            </Link> */}
                                        </Typography>
                                        <Link
                                            to="/signin"
                                            className={classes.navLink}
                                        >
                                            <Button
                                                color="primary"
                                                size="small"
                                                variant="contained"
                                            >
                                                SIGN IN
                                            </Button>
                                        </Link>
                                    </Grid>
                                </Toolbar>
                            </AppBar>
                        </>
                    )}
                </div>
            </div>
        </div>
    );
};
