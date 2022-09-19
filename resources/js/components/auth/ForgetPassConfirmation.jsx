import React, { createRef, useState } from "react";
import Button from "@material-ui/core/Button";
import TextField from "@material-ui/core/TextField";
import Dialog from "@material-ui/core/Dialog";
import DialogActions from "@material-ui/core/DialogActions";
import DialogContent from "@material-ui/core/DialogContent";
import DialogContentText from "@material-ui/core/DialogContentText";
import DialogTitle from "@material-ui/core/DialogTitle";
import Axios from "axios";
import { Box } from "@material-ui/core";

const ForgetPassConfirmation = ({onOpen, onClose, phone}) => {
    //const [phone, setPhone] = useState(onPhone);
    const handlePhone = e => {
        setPhone(e.target.value);
    };
    const [code, setCode] = useState();
    const handleCode = e => {
        setCode(e.target.value);
    };
    const [newPass, setNewPass] = useState();
    const handlePass = e => {
        setNewPass(e.target.value);
    };
    const sendCode = () => {
        Axios.post(window.location.origin + `/api/reset/password/confirmation`, {
            phone: phone,
            newPass: newPass,
            code: code,
        })
        .then(res => {
            console.log(res.data);
            console.log('test')
            onClose()
        })
        .catch(function(e) {
            console.log(e);
        });
    };
    return (
        <div>
            <Dialog
                open={onOpen}
                onClose={onClose}
                aria-labelledby="form-dialog-title"
                maxWidth="md"
            >
                <DialogTitle id="form-dialog-title">Password Confirmation</DialogTitle>
                <DialogContent>
                    {/* <DialogContentText>
                        You will get a verification code.
                    </DialogContentText> */}
                    <TextField
                        autoFocus
                        id="name"
                        label="Phone Number"
                        type="number"
                        value={phone}
                        onChange={handlePhone}
                        fullWidth
                    />
                    <TextField
                        autoFocus
                        id="code"
                        label="Code"
                        type="number"
                        value={code}
                        onChange={handleCode}
                        fullWidth
                    />
                    <Box mt={2}></Box>
                    <TextField
                        autoFocus
                        id="password"
                        label="Enter New Password"
                        type="password"
                        value={newPass}
                        onChange={handlePass}
                        fullWidth
                    />
                </DialogContent>
                <DialogActions>
                    <Button onClick={onClose} color="primary">
                        Cancel
                    </Button>
                    <Button onClick={sendCode} color="primary">
                        Submit
                    </Button>
                </DialogActions>
            </Dialog>
        </div>
    );
};

export default ForgetPassConfirmation
