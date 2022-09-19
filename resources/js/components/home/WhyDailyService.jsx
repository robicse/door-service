import React from "react";
import { makeStyles } from "@material-ui/core/styles";
import { Grid, Typography, Button, Box, Container } from "@material-ui/core";
import PlayArrowIcon from "@material-ui/icons/PlayArrow";
import AppleIcon from "@material-ui/icons/Apple";
import CheckCircleIcon from "@material-ui/icons/CheckCircle";
import SecurityIcon from "@material-ui/icons/Security";
import DeveloperBoardIcon from "@material-ui/icons/DeveloperBoard";
import LocalAtmIcon from "@material-ui/icons/LocalAtm";
import CreditCardIcon from "@material-ui/icons/CreditCard";
import TelegramIcon from "@material-ui/icons/Telegram";

const useStyles = makeStyles(theme => ({
    root: {
        flexGrow: 1,
        marginBottom: 100
    }
}));

export const WhyDoorService = () => {
    const classes = useStyles();
    return (
        <div className={classes.root}>
            <Box my={10}>
                <Container maxWidth="md">
                    <Grid
                        container
                        spacing={4}
                        direction="row"
                        justify="center"
                        alignItems="center"
                    >
                        <Grid
                            item
                            md={12}
                            container
                            direction="column"
                            justify="center"
                            alignItems="center"
                        >
                            <Box>
                                <Typography
                                    variant="h5"
                                    color="primary"
                                    style={{ fontWeight: 700 }}
                                >
                                    Why Door Service ?
                                </Typography>
                            </Box>
                        </Grid>
                        <Grid
                            item
                            md={4}
                            container
                            direction="column"
                            justify="center"
                            alignItems="center"
                        >
                            <Box mb={2}>
                                {/* <CheckCircleIcon
                                    style={{ fontSize: "4rem" }}
                                    color="primary"
                                /> */}
                                <img
                                    alt=""
                                    src={
                                        window.location.origin +
                                        "/frontend/img/why/Door-Service-Guarantee-Icon.png"
                                    }
                                    width="70px"
                                />
                            </Box>
                            <Box mb={1}>
                                <Typography variant="h6" color="primary">
                                    Door Service Guarantee
                                </Typography>
                            </Box>
                            <Box>
                                <Typography
                                    variant="subtitle2"
                                    style={{ color: "#5c5b5c" }}
                                    align="center"
                                >
                                    Get a reservice if the service rendered is
                                    unsatisfactory*
                                </Typography>
                            </Box>
                        </Grid>
                        <Grid
                            item
                            md={4}
                            container
                            direction="column"
                            justify="center"
                            alignItems="center"
                        >
                            <Box mb={2}>
                                <img
                                    alt=""
                                    src={
                                        window.location.origin +
                                        "/frontend/img/why/Trusted-Professionals-Icon.png"
                                    }
                                    width="70px"
                                />
                            </Box>
                            <Box mb={1}>
                                <Typography variant="h6" color="primary">
                                    Trusted Professionals
                                </Typography>
                            </Box>
                            <Box>
                                <Typography
                                    variant="subtitle2"
                                    style={{ color: "#5c5b5c" }}
                                    align="center"
                                >
                                    Enjoy insurance coverage for selected
                                    services, underwritten by our trusted
                                    insurance company, Allianz*
                                </Typography>
                            </Box>
                        </Grid>
                        <Grid
                            item
                            md={4}
                            container
                            direction="column"
                            justify="center"
                            alignItems="center"
                        >
                            <Box mb={2}>
                                <img
                                    alt=""
                                    src={
                                        window.location.origin +
                                        "/frontend/img/why/Lowest-Price-Guarantee-Icon.png"
                                    }
                                    width="70px"
                                />
                            </Box>
                            <Box mb={1}>
                                <Typography variant="h6" color="primary">
                                    Lowest Price Gurantee
                                </Typography>
                            </Box>
                            <Box mb={2}>
                                <Typography
                                    variant="subtitle2"
                                    style={{ color: "#5c5b5c" }}
                                    align="center"
                                >
                                    Service providers are background checked and
                                    subject to high performance standard
                                </Typography>
                            </Box>
                        </Grid>
                        <Grid
                            item
                            md={4}
                            container
                            direction="column"
                            justify="center"
                            alignItems="center"
                        >
                            <Box mb={2}>
                                <img
                                    alt=""
                                    src={
                                        window.location.origin +
                                        "/frontend/img/why/Hassle-Free-Payment-Icon.png"
                                    }
                                    width="70px"
                                />
                            </Box>
                            <Box mb={1}>
                                <Typography variant="h6" color="primary">
                                    Hassle-Free-Payment
                                </Typography>
                            </Box>
                            <Box>
                                <Typography
                                    variant="subtitle2"
                                    style={{ color: "#5c5b5c" }}
                                    align="center"
                                >
                                    Find the same service at a lower price
                                    elsewhere? We will match it. Available for
                                    selected services*
                                </Typography>
                            </Box>
                        </Grid>
                        <Grid
                            item
                            md={4}
                            container
                            direction="column"
                            justify="center"
                            alignItems="center"
                        >
                            <Box mb={2}>
                                <img
                                    alt=""
                                    src={
                                        window.location.origin +
                                        "/frontend/img/why/Services-at-Anytime-Anywhere-Icon.png"
                                    }
                                    width="70px"
                                />
                            </Box>
                            <Box mb={1}>
                                <Typography variant="h6" color="primary">
                                    Service at Anytime
                                </Typography>
                            </Box>
                            <Box>
                                <Typography
                                    variant="subtitle2"
                                    style={{ color: "#5c5b5c" }}
                                    align="center"
                                >
                                    Enjoy secure and hassle-free payments when
                                    you use DoorservicePay on the Doorservice
                                    app
                                </Typography>
                            </Box>
                        </Grid>
                        <Grid
                            item
                            md={4}
                            container
                            direction="column"
                            justify="center"
                            alignItems="center"
                        >
                            <Box mb={2}>
                                <img
                                    alt=""
                                    src={
                                        window.location.origin +
                                        "/frontend/img/why/Damage-Coverage-Icon.png"
                                    }
                                    width="70px"
                                />
                            </Box>
                            <Box mb={1}>
                                <Typography variant="h6" color="primary">
                                    Damage Coverage
                                </Typography>
                            </Box>
                            <Box>
                                <Typography
                                    variant="subtitle2"
                                    style={{ color: "#5c5b5c" }}
                                    align="center"
                                >
                                    Our customer service is there for you to
                                    make it right and make sure you are
                                    completely satisfied
                                </Typography>
                            </Box>
                        </Grid>
                    </Grid>
                </Container>
            </Box>

            {/* <Grid container>
                <Grid
                    item
                    md={5}
                    style={{ backgroundColor: "#fe5f3f" }}
                    container
                    direction="column"
                    justify="center"
                    alignItems="center"
                >
                    <Typography variant="h5" style={{ marginTop: 10 }}>
                        Download Door Service App
                    </Typography>
                    <Typography variant="h6" style={{ color: "#FFFFFF" }}>
                        It,s Smart Easy and Smooth
                    </Typography>
                    <Grid
                        container
                        direction="row"
                        justify="center"
                        style={{ marginBottom: 10 }}
                    >
                        <Button
                            variant="contained"
                            color="secondary"
                            startIcon={<PlayArrowIcon />}
                            style={{ margin: 4 }}
                        >
                            Google PLay
                        </Button>
                        <Button
                            variant="contained"
                            color="secondary"
                            startIcon={<AppleIcon />}
                            style={{ margin: 4 }}
                        >
                            App Store
                        </Button>
                    </Grid>
                </Grid>
                <Grid
                    item
                    md={5}
                    style={{ backgroundColor: "#fbdf00", padding: 25 }}
                >
                    <Grid
                        container
                        direction="column"
                        justify="center"
                        alignItems="center"
                    >
                        <Typography variant="h5" style={{ marginBottom: 10 }}>
                            Be Our Service Hero
                        </Typography>
                        <Typography
                            variant="body2"
                            style={{ marginBottom: 10 }}
                        >
                            Lorem Ipsum has been the industry's standard dummy
                            text ever since the 1500s, when an unknown printer
                            took a galley of type and scrambled it to make a
                            type specimen book. It has survived not only five
                        </Typography>
                        <Button
                            color="primary"
                            size="medium"
                            variant="contained"
                            href={
                                window.location.origin + "/vendor-registration"
                            }
                        >
                            Apply Now
                        </Button>
                    </Grid>
                </Grid>
                <Grid
                    item
                    md={2}
                    style={{ backgroundColor: "#fe5f3f" }}
                    container
                    justify="center"
                    alignItems="center"
                >
                    <img
                        src={
                            window.location.origin +
                            "/frontend/img/home/Hero.png"
                        }
                        alt=""
                        width="170px"
                    />
                </Grid>
            </Grid> */}
        </div>
    );
};
