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
    Box,
    TextField
} from "@material-ui/core";
import Skeleton from "@material-ui/lab/Skeleton";
import { observer } from "mobx-react-lite";
import { useRootStore } from "../context/RootContext";
import Radio from "@material-ui/core/Radio";
import RadioGroup from "@material-ui/core/RadioGroup";
import FormControlLabel from "@material-ui/core/FormControlLabel";
import FormControl from "@material-ui/core/FormControl";
import FormLabel from "@material-ui/core/FormLabel";
import Checkbox from "@material-ui/core/Checkbox";
import "date-fns";
import DateFnsUtils from "@date-io/date-fns";
import {
    MuiPickersUtilsProvider,
    KeyboardDateTimePicker
} from "@material-ui/pickers";
import { motion } from "framer-motion";

const useStyles = makeStyles(theme => ({
    root: {
        flexGrow: 1,
        marginTop: 70,
        marginBottom: 30
    }
}));

export const ServiceQuestionOption = observer(props => {
    const classes = useStyles();
    const store = useRootStore();
    const [singleQuestion, setLocalQuestion] = useState({});
    const {
        updateCheckStatus,
        getQuestion,
        root_index,
        updateQuestionAnswer,
        updateServiceAlternativeDate,
        updateServiceDate
    } = store;
    const [selectedPreDate, setSelectedPreDate] = React.useState(new Date());
    const [selectedAltDate, setSelectedAltDate] = React.useState(new Date());
    console.log(new Date(selectedPreDate).toLocaleString())

    useAsyncEffect(
        isMounted => {
            if (!isMounted()) return;
            setLocalQuestion(getQuestion(root_index[props.index]));
        },
        [props.index]
    );

    const handleChangeTextField = event => {
        updateQuestionAnswer(singleQuestion.id, event.target.value);
        if (event.target.value.length == 0) {
            props.setChecked(false);
        } else {
            props.setChecked(true);
        }
    };
    const handleChangeRadio = event => {
        updateCheckStatus(root_index[props.index], event.target.value);
        props.setChecked(true);
    };
    const handleChangeCheck = event => {
        updateCheckStatus(root_index[props.index], event.target.value);
        props.setChecked(true);
    };
    const handlePrferedDateChange = date => {
        updateServiceDate(date);
        setSelectedPreDate(date);
        if (date == null) {
            props.setChecked(false);
        } else {
            props.setChecked(true);
        }
    };
    const handleALternativeDateChange = date => {
        updateServiceAlternativeDate(date);
        setSelectedAltDate(date);
    };

    if (singleQuestion.question_type == "textarea") {
        return (
            <motion.div
                initial={{ opacity: 0 }}
                animate={{ opacity: 1 }}
                exit={{ opacity: 0 }}
            >
                <FormControl component="fieldset" fullWidth={true}>
                    <FormLabel
                        component="legend"
                        style={{
                            fontSize: 23,
                            marginBottom: 20,
                            color: "black"
                        }}
                    >
                        {singleQuestion.question}
                    </FormLabel>

                    <TextField
                        id="outlined-multiline-static"
                        multiline
                        rows={4}
                        placeholder="Write Something"
                        variant="outlined"
                        value={getQuestion(root_index[props.index]).answer}
                        onChange={handleChangeTextField}
                    />
                </FormControl>
            </motion.div>
        );
    } else if (singleQuestion.question_type == "radio") {
        return (
            <motion.div
                initial={{ opacity: 0 }}
                animate={{ opacity: 1 }}
                exit={{ opacity: 0 }}
            >
                <FormControl component="fieldset" style={{ width: "100%" }}>
                    <FormLabel
                        component="legend"
                        style={{
                            fontSize: 23,
                            marginBottom: 5,
                            color: "black"
                        }}
                    >
                        {singleQuestion.question}
                    </FormLabel>

                    <RadioGroup name="answer">
                        {getQuestion(
                            root_index[props.index]
                        ).questionsOption.map((option, index) => (
                            <FormControlLabel
                                key={option.id}
                                checked={
                                    option.checked == "true" ? true : false
                                }
                                value={index}
                                control={<Radio />}
                                label={option.option_title}
                                onChange={handleChangeRadio}
                            />
                        ))}
                    </RadioGroup>
                </FormControl>
            </motion.div>
        );
    } else if (singleQuestion.question_type == "checkbox") {
        return (
            <motion.div
                initial={{ opacity: 0 }}
                animate={{ opacity: 1 }}
                exit={{ opacity: 0 }}
            >
                <FormControl component="fieldset" style={{ width: "100%" }}>
                    <FormLabel
                        component="legend"
                        style={{
                            fontSize: 23,
                            marginBottom: 5,
                            color: "black"
                        }}
                    >
                        {singleQuestion.question}
                    </FormLabel>
                    {getQuestion(root_index[props.index]).questionsOption.map(
                        (option, index) => (
                            <FormControlLabel
                                checked={
                                    option.checked == "true" ? true : false
                                }
                                key={option.id}
                                value={index}
                                control={<Checkbox />}
                                label={option.option_title}
                                onChange={handleChangeCheck}
                                name="answer[]"
                            />
                        )
                    )}
                </FormControl>
            </motion.div>
        );
    } else if (singleQuestion.question_type == "date") {
        return (
            <motion.div
                initial={{ opacity: 0 }}
                animate={{ opacity: 1 }}
                exit={{ opacity: 0 }}
            >
                <FormControl component="fieldset" style={{ width: "100%" }}>
                    <FormLabel
                        component="legend"
                        style={{
                            fontSize: 23,
                            marginBottom: 5,
                            color: "black"
                        }}
                    >
                        {singleQuestion.question}
                    </FormLabel>
                    <MuiPickersUtilsProvider utils={DateFnsUtils}>
                        <KeyboardDateTimePicker
                            margin="normal"
                            id="date-picker-dialog"
                            disablePast={true}
                            inputVariant="outlined"
                            label="Preferred Date and Time"
                            value={selectedPreDate}
                            onChange={handlePrferedDateChange}
                            KeyboardButtonProps={{
                                "aria-label": "change date"
                            }}
                            required={true}
                        />
                        <KeyboardDateTimePicker
                            margin="normal"
                            disablePast={true}
                            inputVariant="outlined"
                            id="date-picker-dialog"
                            label="Alternative Date and Time (Optional)"
                            value={selectedAltDate}
                            onChange={handleALternativeDateChange}
                            KeyboardButtonProps={{
                                "aria-label": "change date"
                            }}
                        />
                    </MuiPickersUtilsProvider>
                </FormControl>
            </motion.div>
        );
    }
});
