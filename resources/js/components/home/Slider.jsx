import React from "react";
import Grid from "@material-ui/core/Grid";
import { makeStyles } from "@material-ui/core/styles";
import { Link } from "react-router-dom";
import { Carousel } from "react-responsive-carousel";
import "react-responsive-carousel/lib/styles/carousel.min.css";
import { SearchBar } from "./SearchBar";
import { Box } from "@material-ui/core";

const useStyles = makeStyles(theme => ({
    root: {
        flexGrow: 1,
        marginBottom: 50
    },
    sliderImg: {
        maxWidth: "100%",
        height: "auto"
    },
    banner: {
        backgroundImage:
            "url(" +
            window.location.origin +
            "/frontend/img/home/slider-test-large-4.jpg)",
        height: 430,
        backgroundSize: "cover",
        backgroundPosition: "center"
    }
}));

export const Slider = () => {
    const small = "300.jpg";
    const medium =
        window.location.origin + "/frontend/img/home/slider-test.jpg";
    const large =
        window.location.origin + "/frontend/img/home/slider-test-large.jpg";

    const classes = useStyles();

    return (
        <div className={classes.root}>
            <Grid container>
                <Grid
                    item
                    xs={12}
                    className={classes.banner}
                    container
                    direction="column"
                    justify="center"
                >
                    <Box>
                        <SearchBar />
                    </Box>
                    {/* <Link>
                        <img src={large} alt="" className={classes.sliderImg} />
                    </Link> */}

                    {/* <Carousel
                        autoPlay
                        showThumbs={false}
                        showStatus={false}
                        infiniteLoop={true}
                        interval="1400"
                    >
                        <div>
                            <img
                                alt=""
                                src={
                                    window.location.origin +
                                    "/frontend/img/home/slider-test-large.jpg"
                                }
                            />
                        </div>
                        <div>
                            <img
                                alt=""
                                src={
                                    window.location.origin +
                                    "/frontend/img/home/slider-test-large-2.jpg"
                                }
                            />
                        </div>
                        <div>
                            <img
                                alt=""
                                src={
                                    window.location.origin +
                                    "/frontend/img/home/slider-test-large-3.jpg"
                                }
                            />
                        </div>
                    </Carousel> */}
                </Grid>
            </Grid>
        </div>
    );
};
