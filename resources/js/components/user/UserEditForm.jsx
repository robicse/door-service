import React, { useContext, useState } from "react";
import { UserContext } from "../context/UserContext";
import { makeStyles } from "@material-ui/core/styles";
import Button from "@material-ui/core/Button";
import CssBaseline from "@material-ui/core/CssBaseline";
import { TextField } from "formik-material-ui";
import Typography from "@material-ui/core/Typography";
import Container from "@material-ui/core/Container";
import Axios from "axios";
import { useHistory } from "react-router-dom";
import { Formik, Form, Field } from "formik";
import { LinearProgress } from "@material-ui/core";
import Snackbar from "@material-ui/core/Snackbar";
import Alert from "@material-ui/lab/Alert";

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
        width: "100%" // Fix IE 11 issue.
        // marginTop: theme.spacing(1)
    },
    submit: {
        margin: theme.spacing(3, 0, 2)
    }
}));

export const UserEditForm = () => {
    const classes = useStyles();
    const history = useHistory();
    const { user, setUser } = useContext(UserContext);
    const [alert, setAlert] = useState({});
    const handleClose = (event, reason) => {
        if (reason === "clickaway") {
            return;
        }
        setAlert({
            open: false,
            severity: "info",
            massage: "Loading"
        });
    };

    return (
        <Formik
            initialValues={{
                name: user.user.name,
                email: user.user.email,
                oldPassword: "",
                newPassword: ""
            }}
            validate={values => {
                const errors = {};
                if (!values.name) {
                    errors.name = "Required";
                }
                if (!values.email) {
                    errors.email = "Required";
                }
                return errors;
            }}
            // onSubmit={(values, { setSubmitting }) => {
            //     setTimeout(() => {
            //         setSubmitting(false);
            //         alert(JSON.stringify(values, null, 2));
            //     }, 500);
            // }}

            onSubmit={(values, { setSubmitting }) => {
                setTimeout(() => {
                    setSubmitting(false);

                    Axios.post(
                        window.location.origin + `/api/user/profile/update`,
                        {
                            name: values.name,
                            email: values.email,
                            oldPass: values.oldPassword,
                            newPass: values.newPassword
                        },
                        {
                            headers: { Authorization: "Bearer " + user.token }
                        }
                    )
                        .then(res => {
                            const persons = res.data;
                            setUser({
                                token: persons.response.token,
                                user: persons.response.user,
                                isAuthenticate: true
                            });

                            localStorage.setItem(
                                "auth-token",
                                persons.response.token
                            );
                            setAlert({
                                open: true,
                                severity: "success",
                                massage: "Update Succesfully"
                            });
                        })
                        .catch(function(error) {
                            let response = error.response.data.response;
                            //console.log(error.response.data.response);
                            setAlert({
                                open: true,
                                severity: "error",
                                massage: error.response.data.response
                            });
                        });
                }, 500);
            }}
        >
            {({ submitForm, isSubmitting }) => (
                <div className={classes.root}>
                    <Container component="main" maxWidth="xs">
                        <CssBaseline />
                        <div className={classes.paper}>
                            <Typography component="h1" variant="h5">
                                
                            </Typography>
                            <form className={classes.form} noValidate>
                                <Field
                                    component={TextField}
                                    name="name"
                                    label="Name"
                                    variant="filled"
                                    margin="normal"
                                    fullWidth
                                />

                                <Field
                                    component={TextField}
                                    variant="filled"
                                    margin="normal"
                                    fullWidth
                                    type="email"
                                    label="Email"
                                    name="email"
                                />
                                <Field
                                    component={TextField}
                                    variant="filled"
                                    margin="normal"
                                    fullWidth
                                    type="password"
                                    label="Old Password"
                                    name="oldPassword"
                                />
                                <Field
                                    component={TextField}
                                    variant="filled"
                                    margin="normal"
                                    fullWidth
                                    type="password"
                                    label="New Password"
                                    name="newPassword"
                                />

                                {isSubmitting && (
                                    <LinearProgress color="primary" />
                                )}
                                <Button
                                    fullWidth
                                    variant="contained"
                                    color="primary"
                                    className={classes.submit}
                                    disabled={isSubmitting}
                                    onClick={submitForm}
                                >
                                    UPDATE
                                </Button>
                            </form>
                        </div>
                    </Container>
                    <Snackbar
                        open={alert.open}
                        autoHideDuration={2000}
                        onClose={handleClose}
                    >
                        <Alert
                            onClose={handleClose}
                            severity={alert.severity}
                            variant="filled"
                        >
                            {alert.massage}
                        </Alert>
                    </Snackbar>
                </div>
            )}
        </Formik>
    );
};
