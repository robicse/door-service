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
import { useRootStore } from "../../context/RootContext";

const useStyles = makeStyles(theme => ({
    root: {
        flexGrow: 1
    },

    card: {
        maxWidth: 345
    },
    media: {
        height: 110
    }
}));

export const Service = ({ services }) => {
    const history = useHistory();
    const classes = useStyles();
    // const [services, setServices] = useState([]);
    const [subCategory, setSubCategory] = useState({});
    const [loaded, setLoaded] = useState(true);
    const store = useRootStore();
    const { setServiceInfo } = store;

    // useEffect(() => {
    //     (async () => {
    //         try {
    //             const service = await axios.post(
    //                 window.location.origin + "/api/service",
    //                 {
    //                     slug: subcategory
    //                 }
    //             );

    //             if (service.data.success.service.length != 0) {
    //                 setServices(service.data.success.service);
    //                 setSubCategory(service.data.subcategory);
    //                 setLoaded(true);
    //             } else {
    //                 console.log("No Data");
    //                 setSubCategory(service.data.subcategory);
    //                 setLoaded(false);
    //             }
    //         } catch (error) {
    //             console.log("Error fetching Service from the server.", error);
    //             setLoaded(false);
    //         }
    //     })();
    // }, []);

    function setService(service) {
        setServiceInfo(service);
        history.push("/service/service_requests/" + service.slug);
    }

    return (
        <div className={classes.root}>
            <div className={classes.banner}></div>
            <Container maxWidth="lg">
                <Grid container direction="row" justify="center" spacing={1}>
                    {loaded ? (
                        services.map(service => (
                            <Grid item md={4} key={service.id}>
                                <Card className={classes.card}>
                                    <CardActionArea
                                        onClick={() => setService(service)}
                                    >
                                        <CardMedia
                                            image={
                                                window.location.origin +
                                                "/uploads/service/" +
                                                service.image
                                            }
                                            className={classes.media}
                                            title={service.service_name}
                                        />
                                        <CardContent
                                            style={{
                                                paddingTop: 10,
                                                paddingBottom: 0
                                            }}
                                        >
                                            <Typography
                                                gutterBottom
                                                variant="h6"
                                                component="h2"
                                                color="primary"
                                            >
                                                {service.service_name}
                                            </Typography>
                                        </CardContent>
                                    </CardActionArea>
                                    <CardActions>
                                        <Button
                                            size="small"
                                            color="primary"
                                            justify="flex-end"
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
        </div>
    );
};
