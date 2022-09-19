import React from "react";
import { useState, useMemo, useEffect } from "react";
import axios from "axios";
import { Link } from "react-router-dom";
import { Typography, Grid, Button, Container, Paper } from "@material-ui/core";
import { makeStyles } from "@material-ui/core/styles";
import Skeleton from "@material-ui/lab/Skeleton";
import Box from "@material-ui/core/Box";
import Card from "@material-ui/core/Card";
import CardActionArea from "@material-ui/core/CardActionArea";
import CardActions from "@material-ui/core/CardActions";
import CardContent from "@material-ui/core/CardContent";
import CardMedia from "@material-ui/core/CardMedia";
import { useHistory } from "react-router-dom";
import { useRootStore } from "../context/RootContext";
import { motion } from "framer-motion";
import { HowItWork } from "../home/HowItWork";
import { WhyDoorService } from "../home/WhyDoorService";
import { Helmet } from "react-helmet";

const useStyles = makeStyles(theme => ({
    root: {
        flexGrow: 1
    },

    banner: {
        height: 300,
        backgroundSize: "cover",
        backgroundPosition: "center"
    },
    card: {
        maxWidth: 325
    },
    content: {
        height: 190
    },
    media: {
        height: 180
    }
}));

export const ServiceList = ({ match }) => {
    const history = useHistory();
    const classes = useStyles();
    const [services, setServices] = useState([]);
    const [subCategory, setSubCategory] = useState({});
    const [loaded, setLoaded] = useState(false);
    const store = useRootStore();
    const { setServiceInfo, clearStore } = store;

    useEffect(() => {
        window.scrollTo(0, 0);
        (async () => {
            try {
                const service = await axios.post(
                    window.location.origin + "/api/service",
                    {
                        slug: match.params.subcategory
                    }
                );

                if (service.data.success.service.length != 0) {
                    setServices(service.data.success.service);
                    setSubCategory(service.data.subcategory);
                    setLoaded(true);
                } else {
                    console.log("No Data");
                    setSubCategory(service.data.subcategory);
                    setLoaded(false);
                }
            } catch (error) {
                console.log("Error fetching Service from the server.", error);
                setLoaded(false);
            }
        })();
    }, [match]);

    function setService(service) {
        clearStore();
        setServiceInfo(service);
        history.push("/service/service_requests/plumbing-installation");
    }

    return (
        <motion.div
            initial={{ opacity: 0 }}
            animate={{ opacity: 1 }}
            exit={{ opacity: 0 }}
            className={classes.root}
        >
            <Helmet>
                <title>{match.params.subcategory} | Doorservice</title>
            </Helmet>
            <div
                className={classes.banner}
                style={{
                    backgroundImage:
                        "url(" +
                        window.location.origin +
                        "/uploads/sub-category/" +
                        subCategory.banner +
                        ")"
                }}
            ></div>
            <Container maxWidth="md">
                <Grid
                    container
                    direction="column"
                    justify="center"
                    alignItems="center"
                    style={{
                        paddingTop: 30,
                        paddingBottom: 30,
                        backgroundColor: "white",
                        marginTop: -150
                    }}
                >
                    <Box>
                        <img
                            src={
                                window.location.origin +
                                "/uploads/sub-category/" +
                                subCategory.icon
                            }
                            alt=""
                            width="70"
                            height="70"
                        />
                    </Box>

                    <Box mb={1}>
                        <Typography variant="h4" color="primary">
                            {subCategory.sub_category}
                        </Typography>
                    </Box>
                    <Box mb={1}>
                        <Typography variant="body2">
                            Doorservice/{match.params.category}/
                            {match.params.subcategory}
                        </Typography>
                    </Box>
                    <Box mb={1} pl={10} pr={10}>
                        <Typography variant="body1">
                            {subCategory.description == null
                                ? "Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."
                                : subCategory.description}
                        </Typography>
                    </Box>
                </Grid>
            </Container>
            <Container maxWidth="lg">
                <Grid
                    container
                    direction="row"
                    justify="center"
                    spacing={2}
                    style={{
                        marginBottom: 80
                    }}
                >
                    {loaded ? (
                        services.map(service => (
                            <Grid item xs={12} md={3} key={service.id}>
                                <Card className={classes.card}>
                                    <CardActionArea>
                                        <CardMedia
                                            className={classes.media}
                                            image={
                                                window.location.origin +
                                                "/uploads/service/" +
                                                service.image
                                            }
                                            title={service.service_name}
                                        />
                                        <CardContent
                                            className={classes.content}
                                            onClick={() => setService(service)}
                                        >
                                            <Typography
                                                gutterBottom
                                                variant="h6"
                                                component="h2"
                                                color="primary"
                                            >
                                                {service.service_name}
                                            </Typography>
                                            <Typography
                                                variant="body2"
                                                color="textSecondary"
                                                component="p"
                                            >
                                                {service.description}
                                            </Typography>
                                        </CardContent>
                                    </CardActionArea>
                                    <CardActions>
                                        {/* <Link
                                             to={`/service/service_requests/${service.slug}`}
                                         >
                                             <Button
                                                 size="small"
                                                 color="primary"
                                             >
                                                 Request Now
                                             </Button>
                                         </Link> */}

                                        <Button
                                            size="small"
                                            color="primary"
                                            variant="outlined"
                                            fullWidth={true}
                                            onClick={() => setService(service)}
                                        >
                                            Request Now
                                        </Button>
                                    </CardActions>
                                </Card>
                            </Grid>
                        ))
                    ) : (
                        <div>
                            <Grid container direction="row" spacing={3}>
                                {/* <Grid item md={3}>
                                    <Skeleton
                                        variant="rect"
                                        width={230}
                                        height={328}
                                    />
                                </Grid>
                                <Grid item md={3}>
                                    <Skeleton
                                        variant="rect"
                                        width={230}
                                        height={328}
                                    />
                                </Grid>
                                <Grid item md={3}>
                                    <Skeleton
                                        variant="rect"
                                        width={230}
                                        height={328}
                                    />
                                </Grid>
                                <Grid item md={3}>
                                    <Skeleton
                                        variant="rect"
                                        width={230}
                                        height={328}
                                    />
                                </Grid> */}
                                <Box mb={1} pl={10} pr={10}>
                                    <Typography variant="body1">
                                        No Service Found!
                                    </Typography>
                                </Box>
                            </Grid>
                        </div>
                    )}
                </Grid>
            </Container>
            <Container maxWidth="lg">
                <HowItWork />
                <WhyDoorService />
            </Container>
        </motion.div>
    );
};
