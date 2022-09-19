import React from "react";
import { makeStyles, useTheme } from "@material-ui/core/styles";
import Card from "@material-ui/core/Card";
import CardContent from "@material-ui/core/CardContent";
import CardMedia from "@material-ui/core/CardMedia";
import IconButton from "@material-ui/core/IconButton";
import Typography from "@material-ui/core/Typography";
import SkipPreviousIcon from "@material-ui/icons/SkipPrevious";
import PlayArrowIcon from "@material-ui/icons/PlayArrow";
import SkipNextIcon from "@material-ui/icons/SkipNext";
import { Container, Grid } from "@material-ui/core";

const useStyles = makeStyles(theme => ({
    root: {
        display: "flex",
        margin: "70px 0px"
    },
    details: {
        display: "flex",
        flexDirection: "column",
        height: "200px",
        width: "100%"
    },
    content: {
        flex: "1 0 auto"
    },
    sec: {
        display: "flex",
        flexDirection: "column",
        justifyColumn: "flex-end",
        alignItems: "flex-end"
    },
    covera: {
        width: "300px"
    },
    coverS: {
        width: "300px"
    },
    controls: {
        display: "flex",
        alignItems: "center",
        paddingLeft: theme.spacing(1),
        paddingBottom: theme.spacing(1)
    },
    playIcon: {
        height: 38,
        width: 38
    }
}));
const Mission = () => {
    const classes = useStyles();
    const theme = useTheme();
    return (
        <Container maxWidth="lg">
            <Grid container className={classes.content} spacing={2}>
                <Grid item md={6} sx={6} xs={12}>
                    <Card className={classes.root}>
                        <CardMedia
                            className={classes.covera}
                            image={`${window.location.origin}/frontend/img/mission/mission.jpg`}
                            title="Mission"
                        />
                        <div className={classes.details}>
                            <CardContent className={classes.content}>
                                <Typography component="h5" variant="h5">
                                    Our Mission
                                </Typography>
                                <Typography
                                    variant="subtitle1"
                                    color="textSecondary"
                                >
                                    Facilitating to avail utmost types of service through integrating advancement of technology leads to build the largest open workplace for professionals.
                                </Typography>
                            </CardContent>
                        </div>
                    </Card>
                </Grid>
                <Grid item md={6} sx={6} xs={12}>
                    <Card className={classes.root}>
                        <div className={classes.details}>
                            <CardContent className={classes.content}>
                                <div className={classes.sec}>
                                    <Typography component="h5" variant="h5">
                                        Our Vission
                                    </Typography>
                                    <Typography
                                        variant="subtitle1"
                                        color="textSecondary"
                                        align="right"
                                    >
                                        Bringing all abilities under our umbrella to satisfy needs at large.
                                    </Typography>
                                </div>
                            </CardContent>
                        </div>
                        <CardMedia
                            className={classes.covera}
                            image={`${window.location.origin}/frontend/img/mission/vission.jpg`}
                            title="Mission"
                        />
                    </Card>
                </Grid>
            </Grid>
        </Container>
    );
};

export default Mission;
