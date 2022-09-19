import React from "react";
import { Grid, makeStyles, Typography, fade, Button } from "@material-ui/core";
import SearchIcon from "@material-ui/icons/Search";
import InputBase from "@material-ui/core/InputBase";
import { SearchBar } from "../SearchBar";

const useStyle = makeStyles(theme => ({
    root: {
        flexGrow: 1,
        marginBottom: 50
    },
    banner: {
        backgroundImage:
            "url(" +
            window.location.origin +
            "/frontend/img/home/slider-test-large-4.jpg)",
        height: 430,
        backgroundSize: "cover",
        backgroundPosition: "center"
    },
    searchIcon: {
        height: "100%",
        position: "absolute",
        pointerEvents: "none",
        display: "flex",
        alignItems: "center",
        justifyContent: "center",
        background: "white",
        paddingLeft: "5px"
    },
    search: {
        position: "relative",
        marginLeft: 0,
        width: "90%"
    },

    inputRoot: {
        color: "inherit"
    },
    inputInput: {
        padding: theme.spacing(1, 1, 1, 0),
        width: "90%",
        // vertical padding + font size from searchIcon
        paddingLeft: `calc(1em + ${theme.spacing(1)}px)`,
        background: "orange"
    },
    searchGrid: {
        position: "relative",
        top: "50%",
        left: "5%"
    },
    btn: {
        marginTop: "10px",
        marginLeft: "40px"
    },
    title: {
        fontSize: "20px"
    }
}));
const Banner = () => {
    const classes = useStyle();
    return (
        <div className={classes.root}>
            <Grid container className={classes.banner}>
                {/* <Grid item md={4} sm={4} xs={8} className={classes.searchGrid}>
                    <Typography className={classes.title} color="primary">
                        Tell us what you need ...
                    </Typography>

                    <div className={classes.search}>
                        <div
                            className={classes.searchIcon}
                            style={{ background: "orange" }}
                        >
                            <SearchIcon style={{ color: "white" }} />
                        </div>
                        <InputBase
                            style={{ paddingLeft: "27px", width: "80%" }}
                            classes={{
                                input: classes.inputInput
                            }}
                        />
                    </div>
                    <Button variant="contained" className={classes.btn}>
                        Register Now
                    </Button>
                </Grid> */}
                <Grid
                    item
                    md={12}
                    sm={12}
                    xs={12}
                    container
                    alignItems="center"
                >
                    <SearchBar />
                </Grid>
                {/* <Grid item md={2} sm={2} xs={2} style={{textAlign:'right'}}>
                  <Typography>
                  <Button variant="contained" style={{marginTop:'5px'}}>Bangla</Button>
                  </Typography> 
                  <Typography>
                  <Button variant="contained" style={{marginTop:'5px'}}>English</Button>
                  </Typography>
                </Grid> */}
            </Grid>
        </div>
    );
};

export default Banner;
