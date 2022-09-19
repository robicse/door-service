import React from "react";
import Button from "@material-ui/core/Button";
import Dialog from "@material-ui/core/Dialog";
import DialogActions from "@material-ui/core/DialogActions";
import DialogContent from "@material-ui/core/DialogContent";
import DialogContentText from "@material-ui/core/DialogContentText";
import DialogTitle from "@material-ui/core/DialogTitle";
import Slide from "@material-ui/core/Slide";
import { useContext, useState } from "react";
import Avatar from "@material-ui/core/Avatar";
import CssBaseline from "@material-ui/core/CssBaseline";
import { TextField } from "formik-material-ui";
import FormControlLabel from "@material-ui/core/FormControlLabel";
import Checkbox from "@material-ui/core/Checkbox";
import Grid from "@material-ui/core/Grid";
import Box from "@material-ui/core/Box";
import LockOutlinedIcon from "@material-ui/icons/LockOutlined";
import Typography from "@material-ui/core/Typography";
import { makeStyles } from "@material-ui/core/styles";
import Container from "@material-ui/core/Container";
import { Link } from "react-router-dom";
import { UserContext } from "../context/UserContext";
import Axios from "axios";
import { useHistory } from "react-router-dom";
import { Formik, Form, Field } from "formik";
import { CircularProgress, LinearProgress } from "@material-ui/core";
import Snackbar from "@material-ui/core/Snackbar";
import Alert from "@material-ui/lab/Alert";
import { useRootStore } from "../context/RootContext";

import firebase from "../../utils/firestore";
import "firebase/firestore";
import "firebase/auth";
import "firebase/analytics";
import { useAuthState } from "react-firebase-hooks/auth";
import { observer } from "mobx-react-lite";
const auth = firebase.auth();

const Transition = React.forwardRef(function Transition(props, ref) {
    return <Slide direction="up" ref={ref} {...props} />;
});

const useStyles = makeStyles(theme => ({
    root: {
        flexGrow: 1
    },
    paper: {
        display: "flex",
        flexDirection: "column",
        alignItems: "center"
    },
    avatar: {
        margin: theme.spacing(1),
        backgroundColor: theme.palette.primary.main
    },
    form: {
        width: "100%" // Fix IE 11 issue.
    },
    submit: {
        margin: theme.spacing(3, 0, 2)
    }
}));

export const LoginModal = props => {
    const [modalOpen, setModalOpen] = React.useState(false);
    const classes = useStyles();
    const [per] = useAuthState(auth);
    const history = useHistory();
    const { user, setUser } = useContext(UserContext);
    const [open, setOpen] = useState(false);
    const store = useRootStore();
    const { setLogInState, key, setKey, isVendor, setisVendor } = store;

    const handleClose = (event, reason) => {
        if (reason === "clickaway") {
            return;
        }
        setOpen(false);
    };

    const handleModalClickOpen = () => {
        setModalOpen(true);
    };

    const handleModalClose = () => {
        setModalOpen(false);
    };

    return (
        <div>
            <Button
                fullWidth={true}
                variant={props.variant}
                color={props.color}
                onClick={handleModalClickOpen}
            >
                {props.content}
            </Button>
            <Dialog
                open={modalOpen}
                keepMounted
                onClose={handleModalClose}
                aria-labelledby="alert-dialog-slide-title"
                aria-describedby="alert-dialog-slide-description"
            >
                <DialogContent>
                    <Formik
                        initialValues={{
                            phone: "",
                            password: ""
                        }}
                        validate={values => {
                            const errors = {};
                            if (!values.phone) {
                                errors.phone = "Required";
                            } else if (values.phone.length != 11) {
                                errors.phone = "Invalid Phone Number";
                            }
                            if (!values.password) {
                                errors.password = "Required";
                            } else if (values.password.length < 6) {
                                errors.password = "Minimum 6 characters";
                            }
                            return errors;
                        }}
                        onSubmit={(values, { setSubmitting }) => {
                            setTimeout(() => {
                                Axios.post(
                                    window.location.origin + `/api/login`,
                                    {
                                        phone: values.phone,
                                        password: values.password
                                    }
                                )
                                    .then(res => {
                                        const persons = res.data;
                                        if (persons.response.type == "vendor") {
                                            console.log(persons.response.user);

                                            axios
                                                .post(
                                                    window.location.origin +
                                                        `/vendor-bypass-login`,
                                                    {
                                                        mobile_number:
                                                            persons.response
                                                                .user
                                                                .mobile_number,
                                                        password:
                                                            persons.response
                                                                .user.key
                                                    }
                                                )
                                                .then(
                                                    response => {
                                                        setLogInState(true);
                                                        window.location.href = `${window.location.origin}/vendor/dashboard`;
                                                    },
                                                    error => {
                                                        console.log(error);
                                                        setLogInState(false);
                                                    }
                                                );
                                        } else {
                                            setUser({
                                                token: persons.response.token,
                                                user: persons.response.user,
                                                isAuthenticate: true
                                            });
                                            localStorage.setItem(
                                                "auth-token",
                                                persons.response.token
                                            );
                                            setKey(persons.response.user.key);
                                            setisVendor(
                                                persons.response.user.isVendor
                                            );
                                            setLogInState(true);
                                            setSubmitting(false);
                                            auth.signInWithCustomToken(
                                                persons.response.firebase_token
                                            ).then(user => console.log(user));
                                            //signInFirebase(persons.response.firebase_token);
                                        }
                                    })
                                    .catch(function() {
                                        setLogInState(false);
                                        setSubmitting(false);
                                        console.log("Unauthorised");
                                        setOpen(true);
                                    });
                            });
                        }}
                    >
                        {({ submitForm, isSubmitting }) => (
                            <div className={classes.root}>
                                <Container component="main" maxWidth="xs">
                                    <CssBaseline />
                                    <div className={classes.paper}>
                                        <Avatar className={classes.avatar}>
                                            <LockOutlinedIcon />
                                        </Avatar>
                                        <Typography component="h1" variant="h5">
                                            SIGN IN
                                        </Typography>
                                        <form
                                            className={classes.form}
                                            noValidate
                                            onSubmit={submitForm}
                                            onKeyDown={e => {
                                                if (e.key === "Enter") {
                                                    submitForm();
                                                }
                                            }}
                                        >
                                            <Field
                                                component={TextField}
                                                name="phone"
                                                type="email"
                                                label="Phone"
                                                variant="outlined"
                                                margin="normal"
                                                fullWidth
                                            />

                                            <Field
                                                component={TextField}
                                                variant="outlined"
                                                margin="normal"
                                                fullWidth
                                                type="password"
                                                label="Password"
                                                name="password"
                                            />

                                            {/* <FormControlLabel
                                    control={
                                        <Checkbox
                                            value="remember"
                                            color="primary"
                                        />
                                    }
                                    label="Remember me"
                                /> */}
                                            {/* {isSubmitting && (
                                        <LinearProgress color="primary" />
                                    )} */}
                                            <Button
                                                fullWidth
                                                variant="contained"
                                                color="primary"
                                                className={classes.submit}
                                                disabled={isSubmitting}
                                                onClick={submitForm}
                                            >
                                                {isSubmitting ? (
                                                    <CircularProgress
                                                        color="primary"
                                                        size={24}
                                                    />
                                                ) : (
                                                    "SIGN IN"
                                                )}
                                            </Button>

                                            <Grid container justify="center">
                                                <Link
                                                    to="/signup"
                                                    variant="body2"
                                                    style={{
                                                        textDecoration: "none",
                                                        color: "#c22200"
                                                    }}
                                                >
                                                    {
                                                        "Don't have an account? Sign Up"
                                                    }
                                                </Link>
                                            </Grid>
                                        </form>
                                    </div>
                                </Container>
                                <Snackbar
                                    open={open}
                                    autoHideDuration={2000}
                                    onClose={handleClose}
                                >
                                    <Alert
                                        onClose={handleClose}
                                        severity="error"
                                        color="error"
                                        style={{
                                            backgroundColor: "#ff1a1a",
                                            color: "white"
                                        }}
                                    >
                                        Invalid Credential
                                    </Alert>
                                </Snackbar>
                            </div>
                        )}
                    </Formik>
                </DialogContent>
                <DialogActions>
                    <Button onClick={handleModalClose} color="primary">
                        Close
                    </Button>
                </DialogActions>
            </Dialog>
        </div>
    );
};
