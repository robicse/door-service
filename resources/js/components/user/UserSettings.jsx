import React, { useContext, useState } from "react";
import { UserContext } from "../context/UserContext";
import { Box, Container, Grid, Typography } from "@material-ui/core";
import { makeStyles } from "@material-ui/core/styles";
import { UserEditForm } from "./UserEditForm";
import ImageUploading from "react-images-uploading";
import Snackbar from "@material-ui/core/Snackbar";
import Alert from "@material-ui/lab/Alert";
import Axios from "axios";
import Tooltip from "@material-ui/core/Tooltip";
import { motion } from "framer-motion";
import CircularProgress from '@material-ui/core/CircularProgress';

const useStyles = makeStyles(theme => ({
    root: {
        flexGrow: 1
    },
    img_btn: {
        border: 0,
        cursor: "pointer",
        backgroundColor: "#ffffff"
    },
    fabProgress: {

        position: 'absolute',
        zIndex: 1,
      },

}));

export const UserSettings = () => {
    const { user, setUser } = useContext(UserContext);
    const classes = useStyles();
    const [images, setImages] = React.useState([]);
    const [error, setError] = React.useState(true);
    const [picsubmit, setPicsubmit] = React.useState(false);
    const [alert, setAlert] = useState({
        open: false,
        severity: "error",
        massage: "Loading"
    });
    const maxNumber = 69;
    const handleClose = (event, reason) => {
        if (reason === "clickaway") {
            return;
        }
        setAlert({
            open: false,
            severity: "info",
            massage: "Saved"
        });
    };
    const handleError = (event, reason) => {
        if (reason === "clickaway") {
            return;
        }
        setError(false);
    };
    const onChange = imageList => {
        // data for submiting image
        setPicsubmit(true);
        Axios.post(
            window.location.origin + `/api/user/profile/update/image`,
            {
                pro_img: imageList[0].data_url
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
                setPicsubmit(false);
                localStorage.setItem("auth-token", persons.response.token);
                setAlert({
                    open: true,
                    severity: "success",
                    massage: "Profile Picture Update Succesfully"
                });
            })
            .catch(function(error) {
                setPicsubmit(false);
                setAlert({
                    open: true,
                    severity: "error",
                    massage: "Failed"
                });
            });
    };
        console.log(user)
    return (
        <motion.div
            initial={{ opacity: 0 }}
            animate={{ opacity: 1 }}
            exit={{ opacity: 0 }}
        >

            <Container maxWidth="lg">
                <Grid container>
                    <Grid
                        item
                        md={4}
                        container
                        direction="column"
                        justify="flex-start"
                        alignItems="center"
                        style={{ marginTop: 50 }}
                    >
                        <ImageUploading
                            value={images}
                            onChange={onChange}
                            maxNumber={maxNumber}
                            dataURLKey="data_url"
                        >
                            {({
                                imageList,
                                onImageUpload,
                                onImageRemoveAll,
                                onImageUpdate,
                                onImageRemove,
                                isDragging,
                                dragProps,
                                errors
                            }) => (
                                // write your building UI

                                <div className="upload__image-wrapper" style={{position:"relative"}}>
                                    {picsubmit && <CircularProgress size={210} thickness={1} className={classes.fabProgress} />}
                                    <Tooltip title="Click to Change the Profile Picture">
                                        <button
                                            className={classes.img_btn}
                                            style={
                                                isDragging
                                                    ? { color: "red" }
                                                    : undefined
                                            }
                                            onClick={onImageUpload}
                                            {...dragProps}
                                        >
                                            <img
                                                src={
                                                    window.location.origin +
                                                    "/uploads/profile/" +
                                                    user.user.image
                                                }
                                                alt=""
                                                width="200px"
                                                height="200px"
                                                style={{ borderRadius: "50%" }}
                                            />
                                        </button>
                                    </Tooltip>
                                    &nbsp;
                                    {errors && (
                                        <div>
                                            {errors.maxNumber && (
                                                <Snackbar
                                                    open={error}
                                                    autoHideDuration={2000}
                                                    onClose={handleError}
                                                >
                                                    <Alert
                                                        onClose={handleError}
                                                        severity="error"
                                                        variant="filled"
                                                    >
                                                        Number of selected
                                                        images exceed maxNumber
                                                    </Alert>
                                                </Snackbar>
                                            )}
                                            {errors.acceptType && (
                                                <Snackbar
                                                    open={error}
                                                    autoHideDuration={2000}
                                                    onClose={handleError}
                                                >
                                                    <Alert
                                                        onClose={handleError}
                                                        severity="error"
                                                        variant="filled"
                                                    >
                                                        Format Is Not
                                                        Supported.Supported
                                                        Format 'jpg', 'gif',
                                                        'png'
                                                    </Alert>
                                                </Snackbar>
                                            )}
                                            {errors.maxFileSize && (
                                                <Snackbar
                                                    open={error}
                                                    autoHideDuration={2000}
                                                    onClose={handleError}
                                                >
                                                    <Alert
                                                        onClose={handleError}
                                                        severity="error"
                                                        variant="filled"
                                                    >
                                                        Selected file size
                                                        exceed max file Size
                                                    </Alert>
                                                </Snackbar>
                                            )}
                                            {errors.resolution && (
                                                <Snackbar
                                                    open={error}
                                                    autoHideDuration={2000}
                                                    onClose={handleError}
                                                >
                                                    <Alert
                                                        onClose={handleError}
                                                        severity="error"
                                                        variant="filled"
                                                    >
                                                        Not Supported Resulation
                                                    </Alert>
                                                </Snackbar>
                                            )}
                                        </div>
                                    )}
                                </div>
                            )}
                        </ImageUploading>

                        <Box m={1}>
                            <Typography variant="h4">
                                {user.user.name}
                            </Typography>
                        </Box>

                        <Box>
                            <Typography variant="h6">
                                +{user.user.mobile_number}
                            </Typography>
                        </Box>
                        <Box>
                            <Typography variant="h6">
                                {user.user.email}
                            </Typography>
                        </Box>
                    </Grid>
                    <Grid item md={8}>
                        <UserEditForm />
                    </Grid>
                </Grid>
            </Container>
            <Snackbar
                open={alert.open}
                autoHideDuration={1200}
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
        </motion.div>
    );
};
