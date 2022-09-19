import React from "react";
import CssBaseline from "@material-ui/core/CssBaseline";
import { makeStyles } from "@material-ui/core/styles";
import Container from "@material-ui/core/Container";
// import Link from "@material-ui/core/Link";
import PlayArrowIcon from "@material-ui/icons/PlayArrow";
import AppleIcon from "@material-ui/icons/Apple";
import FacebookIcon from "@material-ui/icons/Facebook";
import InstagramIcon from "@material-ui/icons/Instagram";
import TwitterIcon from "@material-ui/icons/Twitter";
import YouTubeIcon from "@material-ui/icons/YouTube";
import Google from "../home/new/icons/google.png";
import { Link } from "react-router-dom";
import {
    Grid,
    Typography,
    Button,
    List,
    ListItem,
    ListItemIcon,
    ListItemText,
    Box
} from "@material-ui/core";
import { useAsyncEffect } from "use-async-effect";

// function Copyright() {
//     return (
//         <Typography variant="body2" color="textprimary">
//             {"Copyright © "}
//             <Link color="inherit" href="#hi">
//                 Your Website
//             </Link>{" "}
//             {new Date().getFullYear()}
//             {"."}
//         </Typography>
//     );
// }

const useStyles = makeStyles(theme => ({
    root: {
        zIndex: 10,
        display: "flex",
        flexDirection: "column",
        minHeight: "30vh",
        background:
            "radial-gradient(circle, rgba(0,0,31,1) 0%, rgba(0,0,38,1) 35%)"
    },
    main: {
        marginTop: theme.spacing(3),
        marginBottom: theme.spacing(2)
    },
    footer: {
        padding: theme.spacing(2, 2),
        marginTop: "auto",
        backgroundColor: "#fe5b0c",
        color: "#ffffff",
        marginTop: 15
    }
}));

export default function Footer() {
    const classes = useStyles();
    // const [loaded, setLoaded] = React.useState(false);
    // const [servicesFirst, setServicesFirst] = React.useState(null);
    // const [servicesSecond, setServicesSecond] = React.useState(null);
    // const [servicesThird, setServicesThird] = React.useState(null);
    // useAsyncEffect(async isMounted => {
    //     try {
    //         const service = await axios.get(
    //             window.location.origin + "/api/get/twelve/service"
    //         );
    //         if (!isMounted()) return;
    //         //console.log(service.data.success.services.slice(7, 13));
    //         if (service.data.success.services != 0) {
    //             setServicesFirst(service.data.success.services.slice(0, 4));
    //             setServicesSecond(service.data.success.services.slice(4, 8));
    //             setServicesThird(service.data.success.services.slice(8, 13));
    //             setLoaded(true);
    //         } else {
    //             console.log("No Data in footer");
    //             setLoaded(false);
    //         }
    //     } catch (error) {
    //         console.log(error);
    //         setLoaded(false);
    //     }
    // }, []);
    return (
        <div className={classes.root}>
            <CssBaseline />
            <Container component="main" className={classes.main} maxWidth="lg">
                <Grid container>
                    <Grid
                        item
                        md={3}
                        container
                        direction="column"
                        alignItems="center"
                    >
                        <img
                            src={
                                window.location.origin +
                                "/frontend/img/home/logo_large.png"
                            }
                            alt=""
                            width="120px"
                        />
                        <Typography
                            variant="body2"
                            style={{ color: "#ffffff", marginBottom: "5px" }}
                        >
                            “Door Service” is the Largest Workplace where you
                            can find verified and experienced service providers
                            at your doorstep.
                        </Typography>
                    </Grid>
                    <Grid
                        item
                        md={2}
                        container
                        justify="center"
                        alignItems="center"
                    >
                        <List dense={true}>
                            <Link to="/" style={{ textDecoration: "none" }}>
                                <ListItem
                                    style={{ color: "#ffffff" }}
                                    alignItems="center"
                                    button={true}
                                >
                                    <ListItemText primary="Home" />
                                </ListItem>
                            </Link>
                            <Link
                                to="/signup"
                                style={{ textDecoration: "none" }}
                            >
                                <ListItem
                                    style={{ color: "#ffffff" }}
                                    alignItems="center"
                                    button={true}
                                >
                                    <ListItemText primary="Be Our Vendor" />
                                </ListItem>
                            </Link>
                            <Link
                                to="/services/explore"
                                style={{ textDecoration: "none" }}
                            >
                                <ListItem
                                    style={{ color: "#ffffff" }}
                                    alignItems="center"
                                    button={true}
                                >
                                    <ListItemText primary="Book a Service" />
                                </ListItem>
                            </Link>
                            <Link to="/blog" style={{ textDecoration: "none" }}>
                                <ListItem
                                    style={{ color: "#ffffff" }}
                                    alignItems="center"
                                    button={true}
                                >
                                    <ListItemText primary="Blog" />
                                </ListItem>
                            </Link>
                            <Link
                                to="/help/center"
                                style={{ textDecoration: "none" }}
                            >
                                <ListItem
                                    style={{ color: "#ffffff" }}
                                    alignItems="center"
                                    button={true}
                                >
                                    <ListItemText primary="Help" />
                                </ListItem>
                            </Link>
                        </List>
                    </Grid>
                    <Grid
                        item
                        md={2}
                        container
                        direction="column"
                        justify="center"
                        alignItems="center"
                    >
                        <List dense={true}>
                            <Link
                                to="/about-us"
                                style={{ textDecoration: "none" }}
                            >
                                <ListItem
                                    style={{ color: "#ffffff" }}
                                    alignItems="center"
                                    button={true}
                                >
                                    <ListItemText primary="About Us" />
                                </ListItem>
                            </Link>
                            <Link
                                to="/contact-us"
                                style={{ textDecoration: "none" }}
                            >
                                <ListItem
                                    style={{ color: "#ffffff" }}
                                    alignItems="center"
                                    button={true}
                                >
                                    <ListItemText primary="Contact Us" />
                                </ListItem>
                            </Link>
                            <Link
                                to="/privacy-policy"
                                style={{ textDecoration: "none" }}
                            >
                                <ListItem
                                    style={{ color: "#ffffff" }}
                                    alignItems="center"
                                    button={true}
                                >
                                    <ListItemText primary="Privacy Policy" />
                                </ListItem>
                            </Link>
                            <Link
                                to="/refund-policy"
                                style={{ textDecoration: "none" }}
                            >
                                <ListItem
                                    style={{ color: "#ffffff" }}
                                    alignItems="center"
                                    button={true}
                                >
                                    <ListItemText primary="Refund Policy" />
                                </ListItem>
                            </Link>
                            <Link
                                to="/terms-condition"
                                style={{ textDecoration: "none" }}
                            >
                                <ListItem
                                    style={{ color: "#ffffff" }}
                                    alignItems="center"
                                    button={true}
                                >
                                    <ListItemText primary="Tearms & Condition" />
                                </ListItem>
                            </Link>
                        </List>
                    </Grid>
                    <Grid
                        item
                        md={3}
                        container
                        direction="column"
                        justify="flex-start"
                        alignItems="center"
                    >
                        <Typography
                            variant="h6"
                            style={{
                                color: "#ffffff",
                                marginBottom: 10
                            }}
                        >
                            Download Doorservice App
                        </Typography>
                        <Box mt={1} mb={1}>
                            {" "}
                            {/* <Button
                                variant="contained"
                                color="primary"
                                startIcon={<PlayArrowIcon />}
                                size="large"
                            >
                                Google PLay
                            </Button> */}
                            <a href="https://play.google.com/store/apps/details?id=net.doorservice.app">
                                <img
                                    src={Google}
                                    alt="pic"
                                    style={{ width: "200px" }}
                                />
                            </a>
                        </Box>

                        {/* <Box mt={1} mb={1}>
                            <Button
                                variant="contained"
                                color="primary"
                                startIcon={<AppleIcon />}
                                size="large"
                            >
                                <Box mr={2}>App Store</Box>
                            </Button>
                        </Box> */}
                    </Grid>
                    <Grid
                        item
                        md={2}
                        container
                        direction="column"
                        justify="flex-start"
                        alignItems="center"
                    >
                        <Box mb={1}>
                            <Typography
                                variant="h6"
                                style={{ color: "#ffffff" }}
                            >
                                Follow Us
                            </Typography>
                        </Box>
                        <Grid
                            container
                            direction="row"
                            justify="center"
                            alignItems="center"
                        >
                            <Box m={1}>
                                <Button
                                    variant="text"
                                    color="primary"
                                    size="medium"
                                    href="https://www.facebook.com/doorservice.net"
                                >
                                    <FacebookIcon
                                        fontSize="large"
                                        style={{ color: "#4294FF" }}
                                    />
                                </Button>
                            </Box>
                            <Box m={1}>
                                <Button
                                    variant="text"
                                    color="primary"
                                    size="medium"
                                    href=""
                                >
                                    <InstagramIcon
                                        fontSize="large"
                                        style={{ color: "#8a3ab9" }}
                                    />
                                </Button>
                            </Box>
                            <Box m={1}>
                                <Button
                                    variant="text"
                                    color="primary"
                                    size="medium"
                                    href="https://l.facebook.com/l.php?u=https%3A%2F%2Ftwitter.com%2Fdoorservice2%3Ffbclid%3DIwAR0A2oVgMsJV22z92KtfPUNxfGAV9RzwFlkwo0_kJw6eJSt3ZgFr3m78Ivs&h=AT033SwTDy-C0U7h3L-jdlbjZLVteF4fxBoTrkXx3MtwfcblnwYcuIoePCzHf-vXmpH5KLG3jQ3x_X1WlVCIDw5nJGwaDiINiqDAwm0rArxrw0Usqda72uTe9WAfmfHFpBVk8g"
                                >
                                    <TwitterIcon
                                        fontSize="large"
                                        style={{ color: "#00acee" }}
                                    />
                                </Button>
                            </Box>
                            <Box m={1}>
                                <Button
                                    variant="text"
                                    color="primary"
                                    size="medium"
                                    href="https://l.facebook.com/l.php?u=https%3A%2F%2Fwww.youtube.com%2Fchannel%2FUCDuhgiM0_-R0REaONDdRabA%3Ffbclid%3DIwAR29Gs-HKOn8bsRPlzP3tAvOarxYwEB3sIQP8JU7N6RQVBV9Nsp32w9Y0BY&h=AT033SwTDy-C0U7h3L-jdlbjZLVteF4fxBoTrkXx3MtwfcblnwYcuIoePCzHf-vXmpH5KLG3jQ3x_X1WlVCIDw5nJGwaDiINiqDAwm0rArxrw0Usqda72uTe9WAfmfHFpBVk8g"
                                >
                                    <YouTubeIcon
                                        fontSize="large"
                                        style={{ color: "#FF0000" }}
                                    />
                                </Button>
                            </Box>
                        </Grid>
                    </Grid>
                </Grid>
            </Container>
            {/* <footer className={classes.footer}>
                <Container maxWidth="lg">
                    <Grid container direction="row" justify="space-between">
                        <Typography variant="subtitle2">About Us</Typography>
                        <Typography variant="subtitle2">
                            Tearms & Condition
                        </Typography>
                        <Typography variant="subtitle2">
                            Privacy Policy
                        </Typography>
                        <Typography variant="subtitle2">
                            Cancelation Policy
                        </Typography>
                        <Typography variant="subtitle2">FAQ</Typography>
                        <Typography variant="subtitle2">Blog</Typography>
                        <Typography variant="subtitle2">Services</Typography>
                        <Typography variant="subtitle2">Shopping</Typography>
                        <Typography variant="subtitle2">Deals</Typography>
                        <Typography variant="subtitle2">Contact</Typography>
                    </Grid>
                </Container>
            </footer> */}
        </div>
    );
}
