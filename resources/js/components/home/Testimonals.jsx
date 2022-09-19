import React from "react";
import "react-responsive-carousel/lib/styles/carousel.min.css"; // requires a loader
import { Carousel } from "react-responsive-carousel";
import "../../style/style.css";
import { Box, Container, Grid, Typography } from "@material-ui/core";

export const Testimonals = () => {
    return (
        <>
            <Container
                maxWidth="lg"
                style={{ marginBottom: 100, marginTop: 60 }}
            >
                <Grid
                    container
                    direction="column"
                    justify="center"
                    alignItems="center"
                >
                    <Box mt={6} mb={6}>
                        <Typography
                            variant="h4"
                            align="center"
                            color="primary"
                            style={{ fontWeight: 700 }}
                        >
                            Check out some of these recent reviews
                        </Typography>
                    </Box>
                    <Carousel
                        showArrows={true}
                        infiniteLoop={true}
                        showThumbs={false}
                        showStatus={false}
                        autoPlay={true}
                        interval={2000}
                    >
                        <div>
                            <img
                                src={
                                    window.location.origin +
                                    "/frontend/img/testimonal/1.png"
                                }
                                className="img"
                            />
                            <div className="myCarousel">
                                <h3>Shirley Fultz</h3>
                                <h4>Designer</h4>
                                <p>
                                    It's freeing to be able to catch up on
                                    customized news and not be distracted by a
                                    social media element on the same site
                                </p>
                            </div>
                        </div>

                        <div>
                            <img
                                src={
                                    window.location.origin +
                                    "/frontend/img/testimonal/2.png"
                                }
                                className="img"
                            />
                            <div className="myCarousel">
                                <h3>Daniel Keystone</h3>
                                <h4>Designer</h4>
                                <p>
                                    The simple and intuitive design makes it
                                    easy for me use. I highly recommend Fetch to
                                    my peers.
                                </p>
                            </div>
                        </div>

                        <div>
                            <img
                                src={
                                    window.location.origin +
                                    "/frontend/img/testimonal/3.png"
                                }
                                className="img"
                            />
                            <div className="myCarousel">
                                <h3>Theo Sorel</h3>
                                <h4>Designer</h4>
                                <p>
                                    I enjoy catching up with Fetch on my laptop,
                                    or on my phone when I'm on the go!
                                </p>
                            </div>
                        </div>
                    </Carousel>
                </Grid>
            </Container>
        </>
    );
};
