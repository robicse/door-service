import React from "react";
import { useState, useMemo, useEffect } from "react";
import axios from "axios";
import { Link } from "react-router-dom";
import {
    Typography,
    Grid,
    Button,
    Container,
    Paper,
    Box
} from "@material-ui/core";
import { makeStyles } from "@material-ui/core/styles";
import Skeleton from "@material-ui/lab/Skeleton";
import { motion } from "framer-motion";

const useStyles = makeStyles(theme => ({
    root: {
        flexGrow: 1,
        marginTop: 0,
        marginBottom: 30
    },
    paper: {
        padding: 6
    },
    parentgrid: {},
    serviceGrid: {
        display: "flex",
        flexWrap: "wrap",
        justifyContent: "space-around",
        overflow: "hidden"
    }
}));

export const SubCategory = ({ match }) => {
    const classes = useStyles();
    const [subCategory, setSubCategory] = useState([]);
    const [category, setCategory] = useState({});
    const [loaded, setLoaded] = useState(false);

    useEffect(() => {
        window.scrollTo(0, 0);
        (async () => {
            try {
                const subCat = await axios.post(
                    window.location.origin + "/api/get-subcategory",
                    {
                        slug: match.params.category
                    }
                );

                if (subCat.data.success.subcategory.length != 0) {
                    setSubCategory(subCat.data.success.subcategory);
                    setCategory(subCat.data.category);
                    setLoaded(true);
                } else {
                    console.log("No Data");
                    setLoaded(false);
                }
            } catch (error) {
                console.log(
                    "Error fetching Subcategory from the server.",
                    error
                );
                setLoaded(false);
            }
        })();
    }, []);

    return (
        <motion.div
            initial={{ opacity: 0 }}
            animate={{ opacity: 1 }}
            exit={{ opacity: 0 }}
            className={classes.root}
        >
            <Container maxWidth="md" style={{ marginTop: "30px" }}>
                {/* <Box mb={2}>
                    <Typography variant="h5" style={{ color: "#9b9b9b" }}>
                        {loaded ? category.category : <Skeleton />}
                    </Typography>
                </Box> */}
                <Box mb={2}>
                    <Typography variant="h4" color="primary">
                        {loaded ? category.category : <Skeleton />}
                    </Typography>
                </Box>

                <Typography variant="body1">
                    {loaded ? category.description : <Skeleton />}
                </Typography>

                <Grid container spacing={2} style={{ marginTop: 20 }}>
                    {loaded ? (
                        subCategory.map(subcat => (
                            <Grid item xs={6} md={6} key={subcat.id}>
                                <Link
                                    to={`/${category.slug}/${subcat.slug}`}
                                    style={{ textDecoration: "none" }}
                                >
                                    <Paper
                                        variant="outlined"
                                        className={classes.paper}
                                    >
                                        <Grid container>
                                            <Grid
                                                item
                                                xs={12}
                                                md={4}
                                                container
                                                justify="center"
                                                align="center"
                                            >
                                                <img
                                                    src={
                                                        window.location.origin +
                                                        "/uploads/sub-category/" +
                                                        subcat.icon
                                                    }
                                                    alt=""
                                                    width="96px"
                                                />
                                            </Grid>
                                            <Grid item xs={12} md={8}>
                                                <Typography variant="h6">
                                                    {subcat.sub_category}
                                                </Typography>
                                                <Typography variant="body2">
                                                    {subcat.description == null
                                                        ? "Lorem Ipsum has been the industry's standard dummy text ever since ."
                                                        : subcat.description}
                                                </Typography>
                                            </Grid>
                                        </Grid>
                                    </Paper>
                                </Link>
                            </Grid>
                        ))
                    ) : (
                        <div>
                            <Grid container direction="row" spacing={1}>
                                <Grid item md={5}>
                                    <Skeleton
                                        variant="rect"
                                        width={340}
                                        height={110}
                                    />
                                </Grid>
                                <Grid item md={5}>
                                    <Skeleton
                                        variant="rect"
                                        width={340}
                                        height={110}
                                    />
                                </Grid>
                                <Grid item md={5}>
                                    <Skeleton
                                        variant="rect"
                                        width={340}
                                        height={110}
                                    />
                                </Grid>
                                <Grid item md={5}>
                                    <Skeleton
                                        variant="rect"
                                        width={340}
                                        height={110}
                                    />
                                </Grid>
                            </Grid>
                        </div>
                    )}
                </Grid>
            </Container>
        </motion.div>
    );
};
