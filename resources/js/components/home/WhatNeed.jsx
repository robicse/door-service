import React from "react";
import { Link } from "react-router-dom";
import { Typography, Grid, Button, Container } from "@material-ui/core";
import { HomeService } from "./HomeService";
import { makeStyles } from "@material-ui/core/styles";

const useStyles = makeStyles(theme => ({
    root: {
        flexGrow: 1
    }
}));

export const WhatNeed = () => {
    const classes = useStyles();

    return (
        <div className={classes.root}>
            <Container maxWidth="lg">
                <Grid container spacing={1}>
                    <Grid item md={5}>
                        <Grid
                            container
                            direction="column"
                            alignItems="center"
                            style={{ marginTop: 40 }}
                        >
                            <Grid item xs={12}>
                                <Typography
                                    variant="h4"
                                    align="center"
                                    color="primary"
                                    style={{ fontWeight: 700 }}
                                >
                                    Tell Us,What You Need
                                </Typography>
                            </Grid>
                            <Grid item xs={12} style={{ padding: 25 }}>
                                <Typography variant="subtitle2" align="center">
                                    We offer more than 300+ services for your
                                    home, office, healthcare, cleaning, personal
                                    care, etc. in the lowest price in comparison
                                    while keeping in mind the quality of the
                                    services. Our Service Heroes are available
                                    for your requests 24/7. Book your
                                    appointment with our Service Heroes, today.
                                </Typography>
                            </Grid>
                            <Grid item xs={12}>
                                <Button
                                    color="primary"
                                    size="small"
                                    variant="contained"
                                >
                                    <Link
                                        to="/services/explore"
                                        style={{
                                            textDecoration: "none",
                                            color: "black"
                                        }}
                                    >
                                        Explore All Our Service
                                    </Link>
                                </Button>
                            </Grid>
                        </Grid>
                    </Grid>
                    <Grid item md={7}>
                        <HomeService />
                    </Grid>
                </Grid>
            </Container>
        </div>
    );
};
