import React from "react";
import { makeStyles } from "@material-ui/core/styles";
import {
    Typography,
    Grid,
    Button,
    GridList,
    GridListTile,
    GridListTileBar,
    IconButton,
    Container,
    Box
} from "@material-ui/core";
import Image from "material-ui-image";

const useStyles = makeStyles(theme => ({
    root: {
        flexGrow: 1,
        marginTop: 60
    }
}));

export const HowItWork = () => {
    const classes = useStyles();
    return (
        <div className={classes.root}>
            <Container maxWidth="lg">
                <Grid container spacing={6}>
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
                                How It Works
                            </Typography>
                        </Box>
                    </Grid>
                    <Grid
                        item
                        md={6}
                        container
                        direction="column"
                        justify="center"
                    >
                        <Box mb={2}>
                            <Typography variant="h5" align="center">
                                For User
                            </Typography>
                        </Box>
                        <Box>
                            <iframe
                                width="100%"
                                height="315"
                                src="https://www.youtube.com/embed/exQXKScolmA"
                                frameBorder="0"
                                allowFullScreen
                            ></iframe>
                        </Box>
                    </Grid>
                    <Grid
                        item
                        md={6}
                        container
                        direction="column"
                        justify="center"
                    >
                        <Box mb={2}>
                            <Typography variant="h5" align="center">
                                For Vendor
                            </Typography>
                        </Box>
                        <Box>
                            <iframe
                                width="100%"
                                height="315"
                                src="https://www.youtube.com/embed/T2FU1LKqN1M"
                                frameBorder="0"
                                allowFullScreen
                            ></iframe>
                        </Box>
                    </Grid>

                    {/* <Grid
                        item
                        md={4}
                        container
                        direction="column"
                        justify="center"
                    >
                        <Box>
                            <img
                                alt=""
                                src={
                                    window.location.origin +
                                    "/frontend/img/how/Cartoon-01.png"
                                }
                                width="300px"
                            />
                        </Box>
                        <Box mt={2}>
                            <Typography
                                variant="h6"
                                align="center"
                                color="primary"
                            >
                                Submit Your Request
                            </Typography>
                        </Box>
                        <Box mt={1}>
                            <Typography variant="body2" align="center">
                                Lorem, ipsum dolor sit amet consectetur
                                adipisicing elit. Rem nisi dolor rerum animi,
                                culpa porro voluptas saepe libero nulla cum.
                            </Typography>
                        </Box>
                    </Grid>
                    <Grid
                        item
                        md={4}
                        container
                        direction="column"
                        justify="center"
                    >
                        <Box mt={4}>
                            <img
                                alt=""
                                src={
                                    window.location.origin +
                                    "/frontend/img/how/Cartoon-02.png"
                                }
                                width="320px"
                            />
                        </Box>
                        <Box mt={2}>
                            <Typography
                                variant="h6"
                                align="center"
                                color="primary"
                            >
                                Get Pricing & Compare
                            </Typography>
                        </Box>
                        <Box mt={1}>
                            <Typography variant="body2" align="center">
                                Lorem, ipsum dolor sit amet consectetur
                                adipisicing elit. Rem nisi dolor rerum animi,
                                culpa porro voluptas saepe libero nulla cum.
                            </Typography>
                        </Box>
                    </Grid>
                    <Grid
                        item
                        md={4}
                        container
                        direction="column"
                        justify="center"
                    >
                        <Box>
                            <img
                                alt=""
                                src={
                                    window.location.origin +
                                    "/frontend/img/how/Cartoon-03.png"
                                }
                                width="300px"
                            />
                        </Box>
                        <Box mt={2}>
                            <Typography
                                variant="h6"
                                align="center"
                                color="primary"
                            >
                                Book & Pay
                            </Typography>
                        </Box>
                        <Box mt={1}>
                            <Typography variant="body2" align="center">
                                Lorem, ipsum dolor sit amet consectetur
                                adipisicing elit. Rem nisi dolor rerum animi,
                                culpa porro voluptas saepe libero nulla cum.
                            </Typography>
                        </Box>
                    </Grid> */}
                </Grid>
            </Container>
        </div>
    );
};
