import React from "react";
import { Grid, makeStyles, Typography } from "@material-ui/core";
import logo from "./icons/logo_large.png";
import Google from "./icons/google.png";
import FacebookIcon from "@material-ui/icons/Facebook";
import InstagramIcon from "@material-ui/icons/Instagram";
import TwitterIcon from "@material-ui/icons/Twitter";
import YouTubeIcon from "@material-ui/icons/YouTube";
const useStyle = makeStyles(() => ({
    root: {
        marginTop: "70px"
    },
    title: {
        fontSize: "22px",
        fontWeight: 500
    },
    logo1: {
        width: "100%",
        textAlign: "right"
    },
    logo2: {
        width: "100%",
        textAlign: "left"
    },
    follow: {
        width: "100%",
        textAlign: "center"
    }
}));
const Footer = () => {
    const classes = useStyle();
    return (
        <div className={classes.root}>
            <Grid container>
                <Grid item md={4} sm={4} xs={4} className={classes.logo1}>
                    <img
                        src={logo}
                        alt="pic"
                        width="30%"
                        style={{ marginTop: "-30px" }}
                    />
                </Grid>

                <Grid
                    item
                    md={4}
                    sm={4}
                    xs={4}
                    style={{ textAlign: "center" }}
                    className={classes.follow}
                >
                    <Typography className={classes.title} color="primary">
                        Follow Us
                    </Typography>
                    <Typography>
                        <a href="https://www.facebook.com/doorservice.net">
                            <FacebookIcon
                                fontSize="large"
                                style={{ color: "##3b5998" }}
                            />
                        </a>
                        <a href="">
                            <InstagramIcon
                                fontSize="large"
                                style={{ color: "#8a3ab9" }}
                            />
                        </a>
                        <a href="https://l.facebook.com/l.php?u=https%3A%2F%2Ftwitter.com%2Fdoorservice2%3Ffbclid%3DIwAR0A2oVgMsJV22z92KtfPUNxfGAV9RzwFlkwo0_kJw6eJSt3ZgFr3m78Ivs&h=AT033SwTDy-C0U7h3L-jdlbjZLVteF4fxBoTrkXx3MtwfcblnwYcuIoePCzHf-vXmpH5KLG3jQ3x_X1WlVCIDw5nJGwaDiINiqDAwm0rArxrw0Usqda72uTe9WAfmfHFpBVk8g">
                            <TwitterIcon
                                fontSize="large"
                                style={{ color: "#00acee" }}
                            />
                        </a>
                        <a href="https://l.facebook.com/l.php?u=https%3A%2F%2Fwww.youtube.com%2Fchannel%2FUCDuhgiM0_-R0REaONDdRabA%3Ffbclid%3DIwAR29Gs-HKOn8bsRPlzP3tAvOarxYwEB3sIQP8JU7N6RQVBV9Nsp32w9Y0BY&h=AT033SwTDy-C0U7h3L-jdlbjZLVteF4fxBoTrkXx3MtwfcblnwYcuIoePCzHf-vXmpH5KLG3jQ3x_X1WlVCIDw5nJGwaDiINiqDAwm0rArxrw0Usqda72uTe9WAfmfHFpBVk8g">
                            <YouTubeIcon
                                fontSize="large"
                                style={{ color: "#FF0000" }}
                            />
                        </a>
                    </Typography>
                </Grid>

                <Grid item md={4} sm={4} xs={4} className={classes.logo2}>
                    <img src={Google} alt="pic" width="45%" />
                </Grid>
            </Grid>
        </div>
    );
};

export default Footer;
