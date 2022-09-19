import React, { useContext, useState } from "react";
import { makeStyles } from "@material-ui/core/styles";
import CssBaseline from "@material-ui/core/CssBaseline";
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
import { Box, Divider, Typography } from "@material-ui/core";
import InfiniteScroll from "react-infinite-scroll-component";
import { Helmet } from "react-helmet";
const useStyles = makeStyles(theme => ({
    mainGrid: {
        marginTop: theme.spacing(3)
    }
}));

export default function BlogCategory({ match }) {
    const classes = useStyles();
    const [blogs, setBlogs] = useState([]);
    const [found, setFound] = useState(false);
    const { user, setUser } = useContext(UserContext);

    useAsyncEffect(
        async isMounted => {
            window.scrollTo(0, 0);
            try {
                const request = await axios.post(
                    window.location.origin + "/api/category-all-blog",
                    { service_category_id: match.params.cat_id }
                );
                if (!isMounted()) return;

                if (request.data.success.blogs.length == 0) {
                    setFound(true);
                }
                setBlogs(request.data.success.blogs);
            } catch (error) {
                console.log(
                    "Error fetching User Service Request from the server."
                );
            }
        },
        [match]
    );
    const date = () => {};
    return (
        <React.Fragment>
            <Helmet>
                <title>Blogs | Doorservice</title>
            </Helmet>
            <CssBaseline />
            <Container maxWidth="lg" style={{ marginBottom: "30px" }}>
                <main>
                    <MainFeaturedPost post={blogs[0]} found={found} />
                    {/* <Grid container spacing={4}>
                        {featuredPosts.map(post => (
                            <FeaturedPost key={post.title} post={post} />
                        ))}
                    </Grid> */}

                    <Grid container spacing={5} className={classes.mainGrid}>
                        {blogs.length != 0 ? (
                            <Grid item xs={12} md={8} container>
                                <Typography variant="h6" gutterBottom>
                                    Recent Post
                                </Typography>
                                <Divider />
                                <Grid container direction="row" spacing={4}>
                                    {blogs.map(post => (
                                        <Grid item xs={12} md={12}>
                                            <Link
                                                to={`/blog/${post.id}`}
                                                key={post.id}
                                                style={{
                                                    textDecoration: "none",
                                                    color: "black"
                                                }}
                                            >
                                                <FeaturedPost
                                                    key={post.title}
                                                    post={post}
                                                />
                                            </Link>
                                        </Grid>
                                    ))}
                                </Grid>
                            </Grid>
                        ) : (
                            <Grid item xs={12} md={8} container>
                                <Typography>Nothing Found</Typography>
                            </Grid>
                        )}


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
