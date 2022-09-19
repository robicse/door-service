import React from "react";
import PropTypes from "prop-types";
import moment from "moment"
import { makeStyles } from "@material-ui/core/styles";
import Typography from "@material-ui/core/Typography";
import Grid from "@material-ui/core/Grid";
import Card from "@material-ui/core/Card";
import CardActionArea from "@material-ui/core/CardActionArea";
import CardContent from "@material-ui/core/CardContent";
import CardMedia from "@material-ui/core/CardMedia";
import Hidden from "@material-ui/core/Hidden";
import { CircularProgress } from "@material-ui/core";

const useStyles = makeStyles({
    card: {
        display: "flex"
    },
    cardDetails: {
        flex: 1
    },
    cardMedia: {
        width: 160
    }
});

export default function FeaturedPost(props) {
    const classes = useStyles();
    const { post } = props;

    return (
        <>
            {post ? (
                <CardActionArea component="a" href="#">
                    <Card className={classes.card}>
                        <div className={classes.cardDetails}>
                            <CardContent>
                                <Typography component="h2" variant="h5">
                                    {post.title}
                                </Typography>
                                <Typography
                                    variant="subtitle1"
                                    color="textSecondary"
                                >
                                    {moment(post.created_at).format('MMMM Do YYYY, h:mm:ss a')}
                                </Typography>
                                <Typography variant="subtitle1" paragraph>
                                    {post.short_description}
                                </Typography>
                                <Typography variant="subtitle1" color="primary">
                                    Continue reading...
                                </Typography>
                            </CardContent>
                        </div>
                        <Hidden xsDown>
                            <CardMedia
                                className={classes.cardMedia}
                                image={`${window.location.origin}/uploads/post/${post.image}`}
                                title={post.title}
                            />
                        </Hidden>
                    </Card>
                </CardActionArea>
            ) : (
                <CircularProgress />
            )}
        </>
    );
}

FeaturedPost.propTypes = {
    post: PropTypes.object
};
