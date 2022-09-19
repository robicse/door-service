import React from "react";
import { useAsyncEffect } from "use-async-effect";
import { makeStyles } from "@material-ui/core/styles";
import { useState } from "react";
import { Link } from "react-router-dom";
import {
    Typography,
    Grid,
    Button,
    Container,
    Paper,
    Box
} from "@material-ui/core";
import Skeleton from "@material-ui/lab/Skeleton";
import { observer } from "mobx-react-lite";
import { useRootStore } from "../context/RootContext";
import ArrowBackIcon from "@material-ui/icons/ArrowBack";
import { ServiceQuestionOption } from "./ServiceQuestionOption";
import Tooltip from "@material-ui/core/Tooltip";
import { ServiceSummary } from "./ServiceSummary";
import { motion } from "framer-motion";

const useStyles = makeStyles(theme => ({
    root: {
        flexGrow: 1,
        marginTop: 70,
        marginBottom: 30
    },
    center: {
        backgroundColor: "#F5F5F5",
        borderRadius: 6,
        borderTop: "3px solid #f16044",
        marginTop: 30
    }
}));

export const ServiceQuestion = observer(({ match }) => {
    const classes = useStyles();
    const [checked, setChecked] = useState(false);
    const [question, setQuestion] = useState([]);
    const [loaded, setLoaded] = useState(false);
    const [serviceSummary, setServiceSummary] = useState(false);
    const [index, setIndex] = useState(0);
    const {
        service_title,
        addQuestionSet,
        root_index,
        service_price,
        getTotalPrice,
        service_slug
    } = useRootStore();
    const [checkbox, setCheckbox] = useState([]);

    useAsyncEffect(async isMounted => {
        try {
            const question = await axios.post(
                window.location.origin + "/api/service-wise-question-option",
                { service_slug: service_slug }
            );
            if (!isMounted()) return;
            console.log(question);
            if (question.data.question.length != 0) {
                addQuestionSet(question.data);
                setLoaded(true);
            } else {
                console.log("No Data");
                setLoaded(false);
            }
        } catch (error) {
            console.log(error);
            setLoaded(false);
        }
    }, []);

    const incrementIndex = event => {
        if (index < root_index.length - 1) {
            setIndex(index + 1);
        } else {
            setServiceSummary(true);
        }
        setChecked(false);
    };
    const decrementIndex = event => {
        if (index > 0) {
            setIndex(index - 1);
        }
        setChecked(false);
    };

    return (
        <motion.div
            initial={{ opacity: 0 }}
            animate={{ opacity: 1 }}
            exit={{ opacity: 0 }}
        >
            {serviceSummary ? (
                <ServiceSummary />
            ) : (
                <Container maxWidth="md" className={classes.root}>
                    <Grid container alignItems="center">
                        <Grid item xs={12} md={2} />
                        <Grid
                            item
                            xs={12}
                            md={8}
                            className={classes.center}
                            container
                            direction="column"
                            justify="center"
                            alignItems="center"
                        >
                            <Grid container direction="row">
                                <Grid item md={4}>
                                    {index > 0 && (
                                        <Button onClick={decrementIndex}>
                                            <Box>
                                                <ArrowBackIcon color="primary" />
                                            </Box>
                                        </Button>
                                    )}
                                </Grid>
                                <Grid item md={8}>
                                    <Typography variant="h6">
                                        {service_title}
                                    </Typography>
                                </Grid>
                            </Grid>
                            <Grid container direction="column">
                                <Grid
                                    item
                                    xs={12}
                                    style={{ padding: "40px 40px" }}
                                >
                                    <Box mb={2}>
                                        <Typography variant="caption">
                                            Question {index + 1} of
                                            {root_index.length}
                                        </Typography>
                                    </Box>
                                    {loaded && (
                                        <ServiceQuestionOption
                                            setChecked={setChecked}
                                            index={index}
                                            setSingleQuestion={setQuestion}
                                            setCheckbox={setCheckbox}
                                            checkbox={checkbox}
                                        />
                                    )}
                                </Grid>
                            </Grid>
                            {loaded ? (
                                <Grid container direction="row">
                                    <Grid item xs={9} md={9}>
                                        {getTotalPrice == 0 ? (
                                            <Box ml={3}>
                                                <Typography variant="caption">
                                                    Estimeted price
                                                </Typography>
                                            </Box>
                                        ) : (
                                            <Box ml={3}>
                                                <Typography variant="body1">
                                                    Estimate
                                                </Typography>

                                                <Typography
                                                    variant="h6"
                                                    color="primary"
                                                >
                                                    TK {getTotalPrice}
                                                </Typography>
                                            </Box>
                                        )}
                                    </Grid>
                                    <Grid
                                        item
                                        xs={3}
                                        md={3}
                                        container
                                        justify="flex-end"
                                    >
                                        <Box mr={3}>
                                            <Button
                                                variant="contained"
                                                color="primary"
                                                disabled={!checked}
                                                onClick={incrementIndex}
                                            >
                                                Next
                                            </Button>
                                        </Box>
                                    </Grid>
                                </Grid>
                            ) : (
                                <Typography variant="h5" justify="center">
                                    Add Question First
                                </Typography>
                            )}
                        </Grid>
                        <Grid item xs={12} md={2} />
                    </Grid>
                </Container>
            )}
        </motion.div>
    );
});
