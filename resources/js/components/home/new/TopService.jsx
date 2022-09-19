import React from "react";
import {
    Card,
    makeStyles,
    Typography,
    Grid,
    Box,
    Button,
    CircularProgress
} from "@material-ui/core";
import axios from "axios";
import Skeleton from "@material-ui/lab/Skeleton";
import { Link } from "react-router-dom";
import { useAsyncEffect } from "use-async-effect";
import { useState, useEffect } from "react";

const useStyles = makeStyles(() => ({
    root: {
        marginTop: "-80px",
        marginBottom: "30px"
    },
    card: {
        width: "100%",
        boxShadow: "3",
        overflow: "hidden"
    },
    text: {
        paddingLeft: "25px"
    },
    grid: {
        paddingLeft: "10%",
        paddingTop: "50px",
        paddingBottom: "30px"
    },
    smallCard: {
        width: "100%",
        textAlign: "center",
        marker: "0 auto",
        marginBottom: "-20px",
        overflow: "hidden",
        background: "white",
        borderRadius: "5px"
    },
    vr: {
        paddingTop: "5px",
        fontSize: "30px",
        opacity: ".3"
    },
    ol: {
        fontSize: "0.8rem",
        fontFamily: "Merriweather Sans",
        fontWeight: 500,
        lineHeight: 1.6,
        paddingLeft: 15
    }
}));

const TopService = () => {
    const classes = useStyles();
    const [category, setCategory] = useState([]);
    const [loaded, setLoaded] = useState(false);
    const [servicesFirst, setServicesFirst] = React.useState();
    const [servicesSecond, setServicesSecond] = React.useState();
    const [servicesThird, setServicesThird] = React.useState();

    const getSubCat = id => {};
    useAsyncEffect(async isMounted => {
        try {
            const cat = await axios.get(
                window.location.origin + "/api/home-category"
            );
            if (!isMounted()) return;

            if (cat.data.length != 0) {
                setCategory(cat.data.success.category);
                setServicesFirst(cat.data.success.category.slice(0, 3));
                setServicesSecond(cat.data.success.category.slice(3, 6));
                setServicesThird(cat.data.success.category.slice(7, 10));
                setLoaded(true);
            } else {
                console.log("No Data");
                setLoaded(false);
            }
        } catch (error) {
            console.log("Error fetching Home category from the server.");
            setLoaded(false);
        }
    }, []);
    return (
        <div className={classes.root}>
            <Grid container>
                <Grid item md={2} sm={2}></Grid>
                <Grid item md={8} sm={8} xs={12}>
                    <Box
                        boxShadow={8}
                        className={classes.smallCard}
                        overflow="hidden"
                    >
                        <Grid container>
                            <Grid item md={5} xs={5}>
                                <Typography style={{ padding: "15px" }}>
                                    Ours Users 754 k+
                                </Typography>
                            </Grid>

                            <Grid item md={2} xs={2}>
                                <Typography className={classes.vr}>
                                    |
                                </Typography>
                            </Grid>
                            <Grid item md={5} xs={5}>
                                <Typography style={{ padding: "15px" }}>
                                    Ours Vendors 2.3 k+
                                </Typography>
                            </Grid>
                        </Grid>
                    </Box>
                </Grid>
                <Grid item md={2} sm={2}></Grid>
            </Grid>
            <Box boxShadow={3} className={classes.card} overflow="hidden">
                <Grid container className={classes.grid}>
                    <Grid item md={3} sm={3} xs={6}>
                        <Typography variant="h6" color="primary">
                            Top Services
                        </Typography>
                        <ol type="1" className={classes.ol}>
                            {loaded ? (
                                servicesFirst.map(cat => (
                                    <li>
                                        <Link
                                            style={{ textDecoration: "none" }}
                                            to={`/${cat.slug}`}
                                        >
                                            <Button size="small">
                                                {cat.category}
                                            </Button>
                                        </Link>
                                    </li>
                                ))
                            ) : (
                                <CircularProgress />
                            )}
                        </ol>
                        <Link
                            style={{ textDecoration: "none" }}
                            to={`/services/explore`}
                        >
                            <Button variant="contained" size="small">
                                See more
                            </Button>
                        </Link>
                    </Grid>

                    <Grid item md={3} sm={3} xs={6}>
                        <Typography variant="h6" color="primary">
                            Popular Services
                        </Typography>
                        <ol type="1" className={classes.ol}>
                            {loaded ? (
                                servicesSecond.map(cat => (
                                    <li>
                                        <Link
                                            style={{ textDecoration: "none" }}
                                            to={`/${cat.slug}`}
                                        >
                                            <Button size="small">
                                                {cat.category}
                                            </Button>
                                        </Link>
                                    </li>
                                ))
                            ) : (
                                <CircularProgress />
                            )}
                        </ol>
                        <Link
                            style={{ textDecoration: "none" }}
                            to={`/services/explore`}
                        >
                            <Button variant="contained" size="small">
                                See more
                            </Button>
                        </Link>
                    </Grid>

                    <Grid item md={3} sm={3} xs={6}>
                        <Typography variant="h6" color="primary">
                            Trending Services
                        </Typography>
                        <ol type="1" className={classes.ol}>
                            {loaded ? (
                                servicesThird.map(cat => (
                                    <li>
                                        <Link
                                            style={{ textDecoration: "none" }}
                                            to={`/${cat.slug}`}
                                        >
                                            <Button size="small">
                                                {cat.category}
                                            </Button>
                                        </Link>
                                    </li>
                                ))
                            ) : (
                                <CircularProgress />
                            )}
                        </ol>
                        <Link
                            style={{ textDecoration: "none" }}
                            to={`/services/explore`}
                        >
                            <Button variant="contained" size="small">
                                See more
                            </Button>
                        </Link>
                    </Grid>

                    <Grid item md={3} sm={3} xs={6}>
                        <Typography variant="h6" color="primary">
                            For You
                        </Typography>
                        <ol type="1" className={classes.ol}>
                            {loaded ? (
                                servicesFirst.map(cat => (
                                    <li>
                                        <Link
                                            style={{ textDecoration: "none" }}
                                            to={`/${cat.slug}`}
                                        >
                                            <Button size="small">
                                                {cat.category}
                                            </Button>
                                        </Link>
                                    </li>
                                ))
                            ) : (
                                <CircularProgress />
                            )}
                        </ol>
                        <Link
                            style={{ textDecoration: "none" }}
                            to={`/services/explore`}
                        >
                            <Button variant="contained" size="small">
                                See more
                            </Button>
                        </Link>
                    </Grid>
                </Grid>
            </Box>
        </div>
    );
};

export default TopService;
