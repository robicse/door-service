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
import { LinearProgress } from "@material-ui/core";
import Snackbar from "@material-ui/core/Snackbar";
import Alert from "@material-ui/lab/Alert";
import { useRootStore } from "../context/RootContext";

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

export const Coupon = props => {
    // const [modalOpen, setModalOpen] = React.useState(true);
    const classes = useStyles();
    const history = useHistory();
    const [open, setOpen] = useState(false);
    const [sckbar, setSckbar] = useState("");

    const handleClose = (event, reason) => {
        if (reason === "clickaway") {
            return;
        }
        setOpen(false);
    };

    const handleModalClickOpen = () => {
        props.setCoupon(true);
    };

    const handleModalClose = () => {
        props.setCoupon(false);
    };

    return (
        <div>
            <Dialog
                open={props.coupon}
                TransitionComponent={Transition}
                keepMounted
                onClose={handleModalClose}
                aria-labelledby="alert-dialog-slide-title"
                aria-describedby="alert-dialog-slide-description"
            >
                <DialogContent>
                    <Formik
                        initialValues={{
                            coupon: ""
                        }}
                        validate={values => {
                            const errors = {};
                            if (!values.coupon) {
                                errors.coupon = "Required";
                            }
                            return errors;
                        }}
                        onSubmit={(values, { setSubmitting }) => {
                            setTimeout(() => {
                                setSubmitting(false);
                                Axios.post(
                                    window.location.origin +
                                        `/api/order/coupon`,
                                    {
                                        coupon_code: values.coupon,
                                        subtotal: props.total
                                    }
                                )
                                    .then(coupon => {
                                        console.log(coupon.data);
                                        if (coupon.data.response == 0) {
                                            props.setDiscount(0);
                                            setSckbar(coupon.data.maseg);
                                            setOpen(true);
                                        } else {
                                            props.setDiscount(
                                                coupon.data.response
                                            );
                                            setSckbar(coupon.data.maseg);
                                            setOpen(true);
                                            handleModalClose();
                                        }
                                    })
                                    .catch(function(error) {
                                        console.log(error);
                                        setSckbar("Something Went Wrong");
                                        setOpen(true);
                                        // handleModalClose();
                                    });
                            });
                        }}
                    >
                        {({ submitForm, isSubmitting }) => (
                            <div className={classes.root}>
                                <Container component="main" maxWidth="xs">
                                    <CssBaseline />
                                    <div className={classes.paper}>
                                        {/* <Avatar className={classes.avatar}>
                                            <LockOutlinedIcon />
                                        </Avatar> */}
                                        <Typography component="h4" variant="h5">
                                            Enjoy Discounts!
                                        </Typography>
                                        <form
                                            className={classes.form}
                                            noValidate
                                        >
                                            <Field
                                                component={TextField}
                                                name="coupon"
                                                label="Promo Code"
                                                variant="outlined"
                                                margin="normal"
                                                fullWidth
                                            />

                                            {isSubmitting && (
                                                <LinearProgress color="primary" />
                                            )}
                                            <Button
                                                fullWidth
                                                variant="contained"
                                                color="secondary"
                                                className={classes.submit}
                                                disabled={isSubmitting}
                                                onClick={submitForm}
                                            >
                                                Redeem
                                            </Button>
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
                                        {sckbar}
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
