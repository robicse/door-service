import React from "react";
import { useAsyncEffect } from "use-async-effect";
import { makeStyles } from "@material-ui/core/styles";
import { useState, useContext } from "react";
import { Link } from "react-router-dom";
import {
    Typography,
    Grid,
    Button,
    Container,
    Box,
    Paper
} from "@material-ui/core";
import moment from "moment";
import Skeleton from "@material-ui/lab/Skeleton";
import List from "@material-ui/core/List";
import ListItem from "@material-ui/core/ListItem";
import ListItemIcon from "@material-ui/core/ListItemIcon";
import ListItemText from "@material-ui/core/ListItemText";
import { observer } from "mobx-react-lite";

import { useHistory } from "react-router-dom";
import Axios from "axios";
import { useRootStore } from "../../context/RootContext";
import { UserContext } from "../../context/UserContext";

const useStyles = makeStyles(theme => ({
    root: {
        flexGrow: 1,
        marginTop: 20,
        marginBottom: 30
    },
    // leftGrid: {
    //     backgroundColor: "#F5F5F5",
    //     borderRadius: 6,
    //     borderTop: "3px solid #f16044",
    //     marginTop: 1
    // },

    inline: {
        display: "inline"
    }
}));

export const Details = props => {
    const classes = useStyles();
    const [order, setOrder] = useState(props.order);
    const [question, setQuestion] = useState(props.details.question_set);
    const [answer, setAnswer] = useState(props.details.answer_set);
    // console.log(props.order.shipping_address);
    // const question = props.details.question_set;
    // const answer = props.details.answer_set;

    return (
        <div>
            <Container maxWidth="md" className={classes.root}>
                <Grid container alignItems="center" justify="center">
                    <Grid item xs={12} md={12}>
                        <Paper elevation={3}>
                            <Box pt={4} pb={1} px={2}>
                                <Grid container>
                                    <Grid item md={2}>
                                        <Typography variant="body1">
                                            Service Name :
                                        </Typography>
                                    </Grid>
                                    <Grid item md={10}>
                                        <Typography variant="body1">
                                            {props.details.service_name}.
                                        </Typography>
                                    </Grid>
                                </Grid>
                            </Box>

                            <Box px={2}>
                                <Grid container>
                                    <Grid item md={2}>
                                        <Typography variant="body1">
                                            Service Date :
                                        </Typography>
                                    </Grid>
                                    <Grid item md={10}>
                                        <Typography variant="body1">
                                        {moment(
                                            order
                                                ?.shipping_address
                                                ?.service_date
                                        ).format(
                                            "MMMM Do YYYY, h:mm:ss a"
                                        )}
                                            .
                                        </Typography>
                                    </Grid>
                                </Grid>
                            </Box>

                            <Box pt={1} pb={4} px={2}>
                                <Grid container>
                                    <Grid item md={2}>
                                        <Typography variant="body1">
                                            Service Location :
                                        </Typography>
                                    </Grid>
                                    <Grid item md={10}>
                                        <Typography variant="body1">
                                            {order.shipping_address.address}.
                                        </Typography>
                                    </Grid>
                                </Grid>
                            </Box>
                        </Paper>
                    </Grid>
                    <Grid item xs={12} md={12} style={{ marginTop: 30 }}>
                        <Paper elevation={3}>
                            <Grid
                                container
                                direction="column"
                                justify="flex-start"
                            >
                                <Box mt={2} ml={3}>
                                    <Typography variant="h6" color="primary">
                                        Request Details
                                    </Typography>
                                </Box>
                                <Box ml={1}>
                                    <List dense={false}>
                                        {answer.map((value, index) => (
                                            <ListItem key={index}>
                                                <ListItemIcon>
                                                    <Typography>
                                                        {index + 1}
                                                    </Typography>
                                                </ListItemIcon>
                                                <ListItemText
                                                    primary={question[index]}
                                                    secondary={
                                                        <React.Fragment>
                                                            {answer[index].map(
                                                                ans => ans
                                                            )}
                                                        </React.Fragment>
                                                    }
                                                />
                                            </ListItem>
                                        ))}
                                    </List>
                                </Box>
                            </Grid>
                        </Paper>
                    </Grid>
                </Grid>
            </Container>
        </div>
    );
};
