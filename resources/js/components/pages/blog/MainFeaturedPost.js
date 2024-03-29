import React from "react";
import PropTypes from "prop-types";
import { makeStyles } from "@material-ui/core/styles";
import Paper from "@material-ui/core/Paper";
import Typography from "@material-ui/core/Typography";
import Grid from "@material-ui/core/Grid";
import Link from "@material-ui/core/Link";
import { CircularProgress, LinearProgress } from "@material-ui/core";

const useStyles = makeStyles(theme => ({
    mainFeaturedPost: {
        position: "relative",
        backgroundColor: theme.palette.grey[800],
        color: theme.palette.common.white,
        marginBottom: theme.spacing(4),
        backgroundImage: "url(https://source.unsplash.com/random)",
        backgroundSize: "cover",
        backgroundRepeat: "no-repeat",
        backgroundPosition: "center"
    },
    overlay: {
        position: "absolute",
        top: 0,
        bottom: 0,
        right: 0,
        left: 0,
        backgroundColor: "rgba(0,0,0,.3)"
    },
    mainFeaturedPostContent: {
        position: "relative",
        padding: theme.spacing(3),
        [theme.breakpoints.up("md")]: {
            padding: theme.spacing(6),
            paddingRight: 0
        }
    }
}));

export default function MainFeaturedPost(props) {
    const classes = useStyles();
    const { post, found } = props;
    console.log(post);
    return (
        <>
            <div>
                {post ? (
                    <Paper
                        className={classes.mainFeaturedPost}
                        style={{
                            backgroundImage: `url(${window.location.origin}/uploads/post/${post.image})`
                        }}
                    >
                        {/* Increase the priority of the hero background image */}
                        {
                            <img
                                style={{ display: "none" }}
                                src={`${window.location.origin}/uploads/post/${post.image}`}
                                alt={post.title}
                            />
                        }
                        <div className={classes.overlay} />
                        <Grid container>
                            <Grid item md={6}>
                                <div
                                    className={classes.mainFeaturedPostContent}
                                >
                                    <Typography
                                        component="h1"
                                        variant="h3"
                                        color="inherit"
                                        gutterBottom
                                    >
                                        {post.title}
                                    </Typography>
                                    <Typography
                                        variant="h5"
                                        color="inherit"
                                        paragraph
                                    >
                                        {post.short_description}
                                    </Typography>
                                    {/* <Link variant="subtitle1" href="#">
                            {post.linkText}
                        </Link> */}
                                </div>
                            </Grid>
                        </Grid>
                    </Paper>
                ) : (
                    <>
                        {found && (
                            <div>
                                <Typography align="center" variant="h5">
                                    Nothing Found
                                </Typography>
                            </div>
                        )}
                        <div
                            style={{
                                height: "900px",
                                marginTop: "100px"
                            }}
                        >
                            <LinearProgress />
                        </div>
                    </>
                )}
            </div>
        </>
    );
}

MainFeaturedPost.propTypes = {
    post: PropTypes.object
};
