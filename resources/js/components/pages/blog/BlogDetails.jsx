import React, { useContext, useState } from "react";
import { makeStyles } from "@material-ui/core/styles";
import CssBaseline from "@material-ui/core/CssBaseline";
import moment from 'moment'
import Grid from "@material-ui/core/Grid";
import Container from "@material-ui/core/Container";
import GitHubIcon from "@material-ui/icons/GitHub";
import FacebookIcon from "@material-ui/icons/Facebook";
import TwitterIcon from "@material-ui/icons/Twitter";
import MainFeaturedPost from "./MainFeaturedPost";
import FeaturedPost from "./FeaturedPost";
import Main from "./Main";
import Sidebar from "./Sidebar";
import { useAsyncEffect } from "use-async-effect";
import { UserContext } from "../../context/UserContext";
import { Link } from "react-router-dom";
import { Box, CircularProgress, Divider, Typography } from "@material-ui/core";
import { Helmet } from "react-helmet";
// import post1 from "./blog-post.1.md";
// import post2 from "./blog-post.2.md";
// import post3 from "./blog-post.3.md";

const useStyles = makeStyles(theme => ({
    mainGrid: {
        marginTop: theme.spacing(3)
    }
}));

const sections = [
    { title: "Technology", url: "#" },
    { title: "Design", url: "#" },
    { title: "Culture", url: "#" },
    { title: "Business", url: "#" },
    { title: "Politics", url: "#" },
    { title: "Opinion", url: "#" },
    { title: "Science", url: "#" },
    { title: "Health", url: "#" },
    { title: "Style", url: "#" },
    { title: "Travel", url: "#" }
];

const mainFeaturedPost = {
    title: "Title of a longer featured blog post",
    description:
        "Multiple lines of text that form the lede, informing new readers quickly and efficiently about what's most interesting in this post's contents.",
    image: "https://source.unsplash.com/random",
    imgText: "main image description",
    linkText: "Continue reading…"
};

const featuredPosts = [
    {
        title: "Featured post",
        date: "Nov 12",
        description:
            "This is a wider card with supporting text below as a natural lead-in to additional content.",
        image: "https://source.unsplash.com/random",
        imageText: "Image Text"
    },
    {
        title: "Post title",
        date: "Nov 11",
        description:
            "This is a wider card with supporting text below as a natural lead-in to additional content.",
        image: "https://source.unsplash.com/random",
        imageText: "Image Text"
    }
];

const posts = [];

const sidebar = {
    title: "About",
    description:
        "Etiam porta sem malesuada magna mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.",
    archives: [
        { title: "March 2020", url: "#" },
        { title: "February 2020", url: "#" },
        { title: "January 2020", url: "#" },
        { title: "November 1999", url: "#" },
        { title: "October 1999", url: "#" },
        { title: "September 1999", url: "#" },
        { title: "August 1999", url: "#" },
        { title: "July 1999", url: "#" },
        { title: "June 1999", url: "#" },
        { title: "May 1999", url: "#" },
        { title: "April 1999", url: "#" }
    ],
    social: [
        { name: "GitHub", icon: GitHubIcon },
        { name: "Twitter", icon: TwitterIcon },
        { name: "Facebook", icon: FacebookIcon }
    ]
};

export default function BlogDetails({ match }) {
    console.log(match);
    const classes = useStyles();
    const [blogs, setBlogs] = useState(null);
    const { user, setUser } = useContext(UserContext);
    useAsyncEffect(async isMounted => {
        window.scrollTo(0, 0);
        try {
            const request = await axios.post(
                window.location.origin + "/api/blog-details",
                { blog_id: match.params.blog_id }
            );
            if (!isMounted()) return;

            console.log("Blo");
            setBlogs(request.data.success.blog);
        } catch (error) {
            console.log(error);
        }
    }, []);
    return (
        <React.Fragment>
            <Helmet>
                <title>Blogs Details | Doorservice</title>
            </Helmet>
            <CssBaseline />
            <Container maxWidth="lg" style={{ marginBottom: "30px" }}>
                <main>
                    <MainFeaturedPost post={blogs} />
                    <Grid container spacing={5} className={classes.mainGrid}>
                        <Grid item xs={12} md={8}>
                            {blogs ? (
                                <>
                                    <Typography
                                        variant="subtitle2"
                                        color="textSecondary"
                                    >
                                        Created at : {moment(blogs.created_at).format('MMMM Do YYYY, h:mm:ss a')}
                                    </Typography>
                                    <div
                                        dangerouslySetInnerHTML={{
                                            __html: blogs.description
                                        }}
                                    ></div>
                                </>
                            ) : (
                                <CircularProgress />
                            )}
                        </Grid>
                        <div
                        style={{zIndex:1}}
                        >
                        <Sidebar
                            title=""
                            description=""
                            archives=""
                            social=""
                        />
                        </div>
                    </Grid>
                </main>
            </Container>
        </React.Fragment>
    );
}
