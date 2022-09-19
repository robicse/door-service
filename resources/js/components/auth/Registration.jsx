import React, { useContext, useState, useRef } from "react";
import Avatar from "@material-ui/core/Avatar";
import Button from "@material-ui/core/Button";
import CssBaseline from "@material-ui/core/CssBaseline";
import { TextField } from "formik-material-ui";
import FormControlLabel from "@material-ui/core/FormControlLabel";
import Checkbox from "@material-ui/core/Checkbox";
// import Link from "@material-ui/core/Link";
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
import { LinearProgress } from "@material-ui/core";
import Snackbar from "@material-ui/core/Snackbar";
import Alert from "@material-ui/lab/Alert";
import { useRootStore } from "../context/RootContext";
import CircularProgress from "@material-ui/core/CircularProgress";
import Dialog from "@material-ui/core/Dialog";
import DialogActions from "@material-ui/core/DialogActions";
import DialogContent from "@material-ui/core/DialogContent";
import DialogContentText from "@material-ui/core/DialogContentText";
import DialogTitle from "@material-ui/core/DialogTitle";
import { Verification } from "./Verification";
import { Helmet } from "react-helmet";
import Backdrop from "@material-ui/core/Backdrop";

const useStyles = makeStyles(theme => ({
    root: {
        flexGrow: 1,
        marginBottom: 100
    },
    paper: {
        marginTop: theme.spacing(8),
        display: "flex",
        flexDirection: "column",
        alignItems: "center"
    },
    avatar: {
        margin: theme.spacing(1),
        backgroundColor: theme.palette.primary.main
    },
    form: {
        width: "100%", // Fix IE 11 issue.
        marginTop: theme.spacing(1)
    },
    submit: {
        margin: theme.spacing(3, 0, 2)
    },
    backdrop: {
        zIndex: theme.zIndex.drawer + 1,
        color: "#fff"
    }
}));

export default function Registration() {
    const classes = useStyles();
    const history = useHistory();
    const { user, setUser } = useContext(UserContext);
    const [open, setOpen] = useState(false);
    const [openBackdrop, setOpenbackdrop] = React.useState(false);
    const [otpConMas, setOtpConMas] = useState(false);
    const store = useRootStore();
    const { setLogInState, key, setKey, isVendor, setisVendor } = store;

    const handleClose = (event, reason) => {
        if (reason === "clickaway") {
            return;
        }
        setOpen(false);
        setOtpConMas(false);
    };
    const [openOtp, setOpenOtp] = React.useState(false);

    const handleClickOpenOtp = () => {
        setOpenOtp(true);
    };

    const handleCloseOtp = () => {
        setOpenOtp(false);
    };

    return (
        <>
            <Helmet>
                <title>Signup | Doorservice</title>
            </Helmet>
            <Backdrop className={classes.backdrop} open={openBackdrop}>
                <Box mr={2}>
                    <CircularProgress color="inherit" />
                </Box>
                <Typography variant="h6" color="inherit">
                    Verifying Your Number
                </Typography>
            </Backdrop>
            <Formik
                initialValues={{
                    name: "",
                    phone: "",
                    password: ""
                }}
                validate={values => {
                    const errors = {};
                    if (!values.name) {
                        errors.name = "Required";
                    }
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
                    setOpenbackdrop(true);
                    setTimeout(() => {
                        Axios.post(window.location.origin + `/api/register`, {
                            name: values.name,
                            phone: values.phone,
                            password: values.password
                        })
                            .then(res => {
                                const persons = res.data;
                                // setUser({
                                //     token: persons.response.token,
                                //     user: persons.response.user,
                                //     isAuthenticate: true
                                // });
                                // // setUser(persons.response);
                                // localStorage.setItem(
                                //     "auth-token",
                                //     persons.response.token
                                // );
                                // setKey(persons.response.user.key);
                                // setisVendor(persons.response.user.isVendor);
                                // setLogInState(true);
                                // history.push("/user/request");
                                setSubmitting(false);
                                setOpenbackdrop(false);
                                setOtpConMas(true);
                                handleClickOpenOtp();
                            })
                            .catch(function() {
                                setSubmitting(false);
                                setOpenbackdrop(false);
                                setLogInState(false);
                                console.log("Something went Wrong");
                                setOpen(true);
                            });
                    }, 500);
                }}
            >
                {({ values, submitForm, isSubmitting }) => (
                    <div className={classes.root}>
                        <Container component="main" maxWidth="xs">
                            <CssBaseline />
                            <div className={classes.paper}>
                                <Avatar className={classes.avatar}>
                                    <LockOutlinedIcon />
                                </Avatar>
                                <Typography component="h1" variant="h5">
                                    SIGN UP
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
                                        name="name"
                                        type="text"
                                        label="Name"
                                        variant="outlined"
                                        margin="normal"
                                        fullWidth
                                    />
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
                                    <Verification
                                        open={openOtp}
                                        setOpen={setOpenOtp}
                                        handleClickOpen={handleClickOpenOtp}
                                        handleClose={handleCloseOtp}
                                        phone={values.phone}
                                        name={values.name}
                                        password={values.password}
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
                                            "SIGN UP"
                                        )}
                                    </Button>

                                    <Grid container justify="center">
                                        <Link
                                            to="/signin"
                                            variant="body2"
                                            style={{
                                                textDecoration: "none",
                                                color: "#c22200"
                                            }}
                                        >
                                            {"Already have an account? Sign In"}
                                        </Link>
                                        {/* <Link to="/signup">User</Link>
                                        <Link>Service Provider</Link> */}
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
                                Phone Number Already Exist
                            </Alert>
                        </Snackbar>
                        <Snackbar
                            open={otpConMas}
                            autoHideDuration={8000}
                            onClose={handleClose}
                        >
                            <Alert
                                onClose={handleClose}
                                severity="success"
                                color="success"
                                // style={{
                                //     backgroundColor: "#ff1a1a",
                                //     color: "white"
                                // }}
                            >
                                We have sent verification code to this number
                            </Alert>
                        </Snackbar>
                    </div>
                )}
            </Formik>
        </>
    );
}
