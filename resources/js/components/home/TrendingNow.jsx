import React from "react";
import Grid from "@material-ui/core/Grid";
import { makeStyles } from "@material-ui/core/styles";
import { Link } from "react-router-dom";
import { Carousel } from "react-responsive-carousel";
import "react-responsive-carousel/lib/styles/carousel.min.css";
import {
    Box,
    Container,
    Typography,
    CircularProgress
} from "@material-ui/core";
import { useAsyncEffect } from "use-async-effect";
import Slider from "react-slick";
import "slick-carousel/slick/slick.css";
import "slick-carousel/slick/slick-theme.css";
import ChevronRightIcon from "@material-ui/icons/ChevronRight";
import ChevronLeftIcon from "@material-ui/icons/ChevronLeft";
import Skeleton from "@material-ui/lab/Skeleton";

const useStyles = makeStyles(theme => ({
    root: {
        flexGrow: 1,
        marginTop: 40
    },
    link: {
        textDecoration: "none"
    }
}));

var settings = {
    dots: false,
    infinite: true,
    speed: 500,
    slidesToShow: 5,
    slidesToScroll: 4,
    initialSlide: 0,
    nextArrow: <ChevronRightIcon color="primary" />,
    prevArrow: <ChevronLeftIcon color="primary" />,
    responsive: [
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
                infinite: true,
                dots: false
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
                initialSlide: 2
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
    ]
};
const skeleton = [1, 2, 3, 4, 5];
export const TrendingNow = () => {
    const classes = useStyles();
    const [loaded, setLoaded] = React.useState(false);
    const [services, setServices] = React.useState(null);
    useAsyncEffect(async isMounted => {
        try {
            const service = await axios.get(
                window.location.origin + "/api/home-category"
            );
            if (!isMounted()) return;
            if (service.data.success.category != 0) {
                setServices(service.data.success.category);
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
    return (
        <div className={classes.root}>
            <Container maxWidth="lg">
                <Grid container>
                    <Grid
                        item
                        md={12}
                        container
                        direction="column"
                        justify="center"
                        alignItems="center"
                    >
                        <Box mb={4}>
                            <Typography
                                variant="h5"
                                color="primary"
                                style={{ fontWeight: 700 }}
                            >
                                Our Services
                            </Typography>
                        </Box>
                    </Grid>
                    <Grid item md={12}>
                        {/* <Carousel
                            autoPlay
                            centerMode
                            showThumbs={false}
                            showStatus={false}
                            showIndicators={false}
                            infiniteLoop={true}
                            stopOnHover={true}
                            interval="1200"
                            centerSlidePercentage="20"
                        >
                            {services ? (
                                services.map(ser => (
                                    <Box component="div" mx={1}>
                                        <img
                                            alt=""
                                            src={
                                                window.location.origin +
                                                "/uploads/category/" +
                                                ser.image
                                            }
                                        />
                                        <Typography
                                            variant="subtitle2"
                                            // className="legend"
                                            // style={{
                                            //     color: "primary",
                                            //     borderBottomLeftRadius: "15px",
                                            //     borderTopRightRadius: "15px"
                                            // }}
                                            color="primary"
                                        >
                                            {ser.category}
                                        </Typography>
                                    </Box>
                                ))
                            ) : (
                                <p>loading</p>
                            )}
                        </Carousel> */}
                        <Slider {...settings}>
                            {services
                                ? services.map(ser => (
                                      <Link
                                          className={classes.link}
                                          to={`/${ser.slug}`}
                                          key={ser.id}
                                      >
                                          <Box component="div" mx={1}>
                                              <img
                                                  alt=""
                                                  src={
                                                      window.location.origin +
                                                      "/uploads/category/" +
                                                      ser.image
                                                  }
                                                  style={{
                                                      borderRadius: "5px",
                                                      height: "158px",
                                                      width: "220px",
                                                      boxShadow:
                                                          "0px 5px 7px -1px rgba(0,0,0,0.30)",
                                                      cursor: "pointer"
                                                  }}
                                              />
                                              <Box mt={2}>
                                                  <Typography
                                                      variant="subtitle2"
                                                      color="primary"
                                                      align="center"
                                                  >
                                                      {ser.category}
                                                  </Typography>
                                              </Box>
                                          </Box>
                                      </Link>
                                  ))
                                : skeleton.map(ser => (
                                      <Skeleton
                                          variant="rect"
                                          width={220}
                                          height={158}
                                      />
                                  ))}
                        </Slider>
                    </Grid>
                </Grid>
            </Container>
        </div>
    );
};
