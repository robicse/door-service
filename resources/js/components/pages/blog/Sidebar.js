import React, { useContext, useState } from "react";
import PropTypes from "prop-types";
import { makeStyles } from "@material-ui/core/styles";
import Grid from "@material-ui/core/Grid";
import Paper from "@material-ui/core/Paper";
import Typography from "@material-ui/core/Typography";
// import Link from "@material-ui/core/Link";
import { useAsyncEffect } from "use-async-effect";
import { UserContext } from "../../context/UserContext";
import { Link } from "react-router-dom";

const useStyles = makeStyles(theme => ({
    sidebarAboutBox: {
        padding: theme.spacing(2),
        backgroundColor: theme.palette.grey[200]
    },
    sidebarSection: {
        marginTop: theme.spacing(3)
    }
}));

export default function Sidebar(props) {
    const { user, setUser } = useContext(UserContext);
    const classes = useStyles();
    const [categories, setCategories] = useState([]);
    const { archives, description, social, title } = props;
    useAsyncEffect(async isMounted => {
        try {
            const request = await axios.get(
                window.location.origin + "/api/home-category",
                {
                    headers: { Authorization: "Bearer " + user.token }
                }
            );
            if (!isMounted()) return;

            console.log(request.data.success.category);
            setCategories(request.data.success.category);
        } catch (error) {
            console.log("Error fetching User Service Request from the server.");
        }
    }, []);
    return (
        <Grid item xs={12} md={4}>
            <Typography
                variant="h6"
                gutterBottom
                className={classes.sidebarSection}
            >
                Category
            </Typography>
            {categories.map(archive => (
                <Link
                    to={`/blog/category/${archive.id}`}
                    key={archive.id}
                    style={{ textDecoration: "none" }}
                >
                    <Typography display="block" variant="body1" color="primary">
                        {archive.category}
                    </Typography>
                </Link>
            ))}
        </Grid>
    );
}

Sidebar.propTypes = {
    archives: PropTypes.array,
    description: PropTypes.string,
    social: PropTypes.array,
    title: PropTypes.string
};
