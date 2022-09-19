import { Typography, Grid, makeStyles, Box } from "@material-ui/core";
import React from "react";

const useStyles = makeStyles(() => ({
    root: {
        marginTop: "100px"
    },
    title: {
        width: "100%",
        textAlign: "center",
        fontWeight: 700,
        marginBottom: 20
    },
    firstThree: {
        position: "relative",
        paddingLeft: "10%"
    },
    secThree: {
        position: "relative",
        paddingLeft: "10%"
    },
    body: {
        paddingTop: "20px",
        display: "flex",
        justifyContent: "center"
    },

    item: {
        boxShadow: "0px 0px 5px 0px rgba(0,0,0,0.45)",
        height: "40px",
        width: "350px",
        display: "flex",
        justifyContent: "flex-start",
        alignItems: "center",
        borderRadius: "7px",
        paddingLeft: "15px"
    }
}));
const WhyDoorService = () => {
    const classes = useStyles();
    return (
        <div className={classes.root}>
            <Typography className={classes.title} variant="h5" color="primary">
                Why Door Service ?
            </Typography>

            <Grid container direction="row" alignItems="center" spacing={6}>
                <Grid
                    item
                    md={6}
                    sm={6}
                    xs={12}
                    container
                    direction="column"
                    alignItems="flex-end"
                    justify="center"
                >
                    <Box mt={3} className={classes.item}>
                        <Typography variant="h6">
                            1. Largest Workplace.
                        </Typography>
                    </Box>
                    <Box mt={4} mb={1} className={classes.item}>
                        <Typography variant="h6">
                            2. No Obstacles to Earn.
                        </Typography>
                    </Box>
                    <Box my={2} className={classes.item}>
                        <Typography variant="h6">
                            3. No Commission Sharing.
                        </Typography>
                    </Box>
                </Grid>

                <Grid
                    item
                    md={6}
                    sm={12}
                    xs={12}
                    container
                    direction="column"
                    alignItems="flex-start"
                    justify="center"
                >
                    <Box my={2} className={classes.item}>
                        <Typography variant="h6">
                            4. Secure & Hassleless Payment.
                        </Typography>
                    </Box>
                    <Box my={2} className={classes.item}>
                        <Typography variant="h6">
                            5. Vendors are verified
                        </Typography>
                    </Box>
                    <Box my={1} className={classes.item}>
                        <Typography variant="h6">6. 24/7 Services</Typography>
                    </Box>
                </Grid>
            </Grid>
        </div>
    );
};

export default WhyDoorService;
