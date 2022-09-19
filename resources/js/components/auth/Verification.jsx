import React, { useContext, useState } from "react";
import Button from "@material-ui/core/Button";
import TextField from "@material-ui/core/TextField";
import Dialog from "@material-ui/core/Dialog";
import DialogActions from "@material-ui/core/DialogActions";
import DialogContent from "@material-ui/core/DialogContent";
import DialogContentText from "@material-ui/core/DialogContentText";
import DialogTitle from "@material-ui/core/DialogTitle";
import Typography from "@material-ui/core/Typography";
import { makeStyles } from "@material-ui/core/styles";
import { Link } from "react-router-dom";
import { UserContext } from "../context/UserContext";
import Axios from "axios";
import { useHistory } from "react-router-dom";
import Snackbar from "@material-ui/core/Snackbar";
import Alert from "@material-ui/lab/Alert";
import { useRootStore } from "../context/RootContext";
import CircularProgress from "@material-ui/core/CircularProgress";
import firebase from "../../utils/firestore";
import "firebase/firestore";
import "firebase/auth";
import "firebase/analytics";
import { useAuthState } from "react-firebase-hooks/auth";
import { observer } from "mobx-react-lite";

const auth = firebase.auth();

export const Verification = observer(
    ({
        open,
        setOpen,
        handleClickOpen,
        handleClose,
        phone,
        name,
        password
    }) => {
        const history = useHistory();
        const { user, setUser } = useContext(UserContext);
        const store = useRootStore();
        const { setLogInState, key, setKey, isVendor, setisVendor } = store;
        const [otpCode, setOtpCode] = React.useState(null);
        const [openAlert, setOpenAlert] = useState(false);
        const [otpConMas, setOtpConMas] = useState(false);

        const handleCloseAlert = (event, reason) => {
            if (reason === "clickaway") {
                return;
            }
            setOpenAlert(false);
            setOtpConMas(false);
        };
        const setOtp = e => {
            setOtpCode(e.target.value);
        };
        const verify = () => {
            Axios.post(window.location.origin + `/api/otp`, {
                code: otpCode,
                phone: phone
            })
                .then(res => {
                    Axios.post(window.location.origin + `/api/login`, {
                        phone: phone,
                        password: password
                    })
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
                            setKey(persons.response.user.key);
                            setisVendor(persons.response.user.isVendor);
                            setLogInState(true);
                            auth.signInWithCustomToken(
                                persons.response.firebase_token
                            ).then(user => console.log(user));
                            setOpenAlert(true);
                            history.push("/user/request");
                        })
                        .catch(function() {
                            setLogInState(false);
                            alert("Something went wrong.Login again");
                            console.log("Unauthorised");
                        });
                })
                .catch(function() {
                    setOtpConMas(true);
                    setLogInState(false);
                });
        };

        return (
            <div>
                <Dialog
                    open={open}
                    onClose={handleClose}
                    aria-labelledby="form-dialog-title"
                >
                    <DialogTitle id="form-dialog-title">
                        Dear {name},
                    </DialogTitle>
                    <DialogContent>
                        <DialogContentText>
                            Please enter verification code to Signup
                        </DialogContentText>
                        <TextField
                            autoFocus
                            margin="dense"
                            id="name"
                            type="text"
                            fullWidth
                            value={otpCode}
                            onChange={setOtp}
                        />
                    </DialogContent>
                    <DialogActions>
                        <Button onClick={handleClose} color="primary">
                            Cancel
                        </Button>
                        <Button onClick={verify} color="primary">
                            Submit
                        </Button>
                    </DialogActions>
                </Dialog>
                <Snackbar
                    open={openAlert}
                    autoHideDuration={2000}
                    onClose={handleCloseAlert}
                >
                    <Alert
                        onClose={handleCloseAlert}
                        severity="success"
                        color="success"
                    >
                        Your account created successfully.
                    </Alert>
                </Snackbar>

                <Snackbar
                    open={otpConMas}
                    autoHideDuration={2000}
                    onClose={handleCloseAlert}
                >
                    <Alert
                        onClose={handleCloseAlert}
                        severity="error"
                        color="error"
                    >
                        Invalid Verification Code.
                    </Alert>
                </Snackbar>
            </div>
        );
    }
);
