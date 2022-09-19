import React from "react";
import { makeStyles } from "@material-ui/core/styles";
import { useState, useEffect } from "react";
import {
    Grid,
    GridList,
    GridListTile,
    GridListTileBar
} from "@material-ui/core";
import axios from "axios";
import Skeleton from "@material-ui/lab/Skeleton";
import { Link } from "react-router-dom";
import { useAsyncEffect } from "use-async-effect";

const useStyles = makeStyles(theme => ({
    root: {
        flexGrow: 1
    },

    serviceGrid: {
        display: "flex",
        flexWrap: "wrap",
        justifyContent: "space-around",
        overflow: "hidden"
    }
}));

export const HomeService = () => {
    const classes = useStyles();
    const [category, setCategory] = useState([]);
    const [loaded, setLoaded] = useState(false);

    const getSubCat = id => {};
    useAsyncEffect(async isMounted => {
        try {
            const cat = await axios.get(
                window.location.origin + "/api/home-category"
            );
            if (!isMounted()) return;

            if (cat.data.length != 0) {
                setCategory(cat.data.success.category);
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

    if (loaded) {
        return (
            <div className={classes.serviceGrid}>
                <GridList cellHeight={180} cols={3} spacing={10}>
                    {category.map(cat => (
                        <GridListTile key={cat.id}>
                            <img
                                src={
                                    window.location.origin +
                                    "/uploads/category/" +
                                    cat.image
                                }
                            />
                            <Link to={`/${cat.slug}`}>
                                <GridListTileBar title={cat.category} />
                            </Link>

                            {/* <a href={window.location.origin + `/${cat.slug}`}>
                                <GridListTileBar title={cat.category} />
                            </a> */}
                        </GridListTile>
                    ))}
                </GridList>
            </div>
        );
    } else {
        return (
            <div className={classes.serviceGrid}>
                <GridList cellHeight={180} cols={3} spacing={10}>
                    <GridListTile>
                        <Skeleton variant="rect" width={210} height={128} />
                        <Skeleton variant="text" />
                    </GridListTile>
                    <GridListTile>
                        <Skeleton variant="rect" width={210} height={128} />
                        <Skeleton variant="text" />
                    </GridListTile>
                    <GridListTile>
                        <Skeleton variant="rect" width={210} height={128} />
                        <Skeleton variant="text" />
                    </GridListTile>
                    <GridListTile>
                        <Skeleton variant="rect" width={210} height={128} />
                        <Skeleton variant="text" />
                    </GridListTile>
                    <GridListTile>
                        <Skeleton variant="rect" width={210} height={128} />
                        <Skeleton variant="text" />
                    </GridListTile>
                    <GridListTile>
                        <Skeleton variant="rect" width={210} height={128} />
                        <Skeleton variant="text" />
                    </GridListTile>
                </GridList>
            </div>
        );
    }
};
