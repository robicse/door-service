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
        width: "100%"
    },
    grid: {
        width: "80%"
    }
}));

const HowItWork = () => {
    const classes = useStyles();
    return (
        <div className={classes.root}>
            <Container maxWidth="lg" className={classes.grid}>
                <Grid container spacing={8}>
                    <Grid
                        item
                        md={12}
                        xs={12}
                        container
                        direction="row"
                        justify="center"
                        alignItems="flex-end"
                        style={{ paddingBottom: 0 }}
                    >
                        <Typography
                            variant="h5"
                            color="primary"
                            style={{ fontWeight: 700 }}
                        >
                            How It Works
                        </Typography>
                    </Grid>
                    {/* <Grid
                        item
                        md={6}
                        container
                        direction="column"
                        justify="center"
                    >
                        <Box>
                            <iframe
                                width="100%"
                                height="315"
                                src="https://www.youtube.com/embed/K4DyBUG242c"
                                frameBorder="0"
                                allowFullScreen
                            ></iframe>
                        </Box>
                        <Box mt={2}>
                            <Typography variant="h5" align="center">
                                For User
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
                        <Box>
                            <iframe
                                width="100%"
                                height="315"
                                src="https://www.youtube.com/embed/yJg-Y5byMMw"
                                frameBorder="0"
                                allowFullScreen
                            ></iframe>
                        </Box>
                        <Box mt={2}>
                            <Typography variant="h5" align="center">
                                For Service Hero
                            </Typography>
                        </Box>
                    </Grid> */}

                    <Grid
                        item
                        md={4}
                        xs={12}
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
                                width="280px"
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
                        xs={12}
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
                                width="280px"
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
                        xs={12}
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
                                width="280px"
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
                    </Grid>
                </Grid>
            </Container>
        </div>
    );
};

export default HowItWork;
