import React, { useContext, useState } from "react";
import Avatar from "@material-ui/core/Avatar";
import Button from "@material-ui/core/Button";
import CssBaseline from "@material-ui/core/CssBaseline";
import { TextField } from "formik-material-ui";
import Grid from "@material-ui/core/Grid";
import Box from "@material-ui/core/Box";
import Typography from "@material-ui/core/Typography";
import { makeStyles } from "@material-ui/core/styles";
import Container from "@material-ui/core/Container";
import Axios from "axios";
import { useHistory } from "react-router-dom";
import { Formik, Form, Field } from "formik";
import { LinearProgress } from "@material-ui/core";
import Snackbar from "@material-ui/core/Snackbar";
import Alert from "@material-ui/lab/Alert";
import { SimpleFileUpload } from "formik-material-ui";
import { motion } from "framer-motion";
import { withStyles } from "@material-ui/core/styles";
import Table from "@material-ui/core/Table";
import TableBody from "@material-ui/core/TableBody";
import TableCell from "@material-ui/core/TableCell";
import TableContainer from "@material-ui/core/TableContainer";
import TableHead from "@material-ui/core/TableHead";
import TableRow from "@material-ui/core/TableRow";
import Paper from "@material-ui/core/Paper";
import Dialog from "@material-ui/core/Dialog";
import DialogActions from "@material-ui/core/DialogActions";
import DialogContent from "@material-ui/core/DialogContent";
import DialogContentText from "@material-ui/core/DialogContentText";
import DialogTitle from "@material-ui/core/DialogTitle";
import { Helmet } from "react-helmet";
import { UserContext } from "../context/UserContext";
import { useAsyncEffect } from "use-async-effect";

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
    background: {
        backgroundImage:
            "url(" + window.location.origin + "/frontend/img/career.png)",
        height: 350,
        backgroundSize: "cover",
        backgroundPosition: "center"
    }
}));

const StyledTableCell = withStyles(theme => ({
    head: {
        backgroundColor: "#FE6140",
        color: theme.palette.common.white
    },
    body: {
        fontSize: 16
    }
}))(TableCell);

const StyledTableRow = withStyles(theme => ({
    root: {
        "&:nth-of-type(odd)": {
            backgroundColor: theme.palette.action.hover
        }
    }
}))(TableRow);

function createData(name, calories, fat, carbs, protein) {
    return { name, calories, fat, carbs, protein };
}

const rows = [
    createData("Account Manager", "Business", "25.12.2020"),
    createData("Receptionist", "Administrative", "25.12.2020"),
    createData("Manager", "Leadership", "25.12.2020")
];

export const Career = () => {
    const classes = useStyles();
    const history = useHistory();
    const [open, setOpen] = useState(false);
    const [row, setRow] = useState(null);

    const handleClose = (event, reason) => {
        if (reason === "clickaway") {
            return;
        }
        setOpen(false);
    };

    const [openDialog, setOpenDialog] = React.useState(false);
    const handleClickOpenDialog = row => {
        setRow(row);
        setOpenDialog(true);
    };
    const handleCloseDialog = () => {
        setOpenDialog(false);
    };

    const [jobs, setJobs] = useState([]);
    const { user, setUser } = useContext(UserContext);
    useAsyncEffect(async isMounted => {
        try {
            const request = await axios.get(
                window.location.origin + "/api/all-career"
            );
            if (!isMounted()) return;

            console.log("Blo");
            setJobs(request.data.success.careers);
        } catch (error) {
            console.log(error);
        }
    }, []);
    return (
        <motion.div
            initial={{ opacity: 0 }}
            animate={{ opacity: 1 }}
            exit={{ opacity: 0 }}
        >
            <Helmet>
                <title>Carrer | Doorservice</title>
            </Helmet>
            <Container maxWidth="xl" disableGutters={true}>
                <Grid
                    container
                    direction="column"
                    justify="center"
                    alignItems="center"
                    className={classes.background}
                >
                    <Box mb={2}>
                        <Typography
                            variant="h2"
                            align="center"
                            style={{ color: "#ffffff" }}
                        >
                            Join With Our Innovative Team
                        </Typography>
                    </Box>
                    {/* <Box>
                        <Button
                            variant="contained"
                            color="primary"
                            size="large"
                        >
                            Apply Now
                        </Button>
                    </Box> */}
                </Grid>
                <Container maxWidth="md">
                    <Grid
                        container
                        direction="column"
                        justify="center"
                        alignItems="center"
                    >
                        <Box mb={2} mt={10}>
                            <Typography
                                variant="h4"
                                align="center"
                                color="primary"
                            >
                                Join With Our Team
                            </Typography>
                        </Box>
                        <Box>
                            <Typography>
                                Lorem ipsum dolor sit amet consectetur
                                adipisicing elit. Amet aliquam vero nam maxime
                                modi repellendus mollitia quibusdam, illo quod
                                hic. Rem ipsum consectetur eveniet quaerat quis
                                tempora dicta ipsam officia.Lorem ipsum dolor
                                sit amet consectetur adipisicing elit. Amet
                                aliquam vero nam maxime modi repellendus
                                mollitia quibusdam, illo quod hic. Rem ipsum
                                consectetur eveniet quaerat quis tempora dicta
                                ipsam officia.sit amet consectetur adipisicing
                                elit. Amet aliquam vero nam maxime modi
                                repellendus mollitia quibusdam, illo quod hic.
                                Rem ipsum consectetur eveniet quaerat quis
                                tempora dicta ipsam officia.
                            </Typography>
                        </Box>
                    </Grid>
                    <Grid
                        container
                        direction="column"
                        justify="center"
                        alignItems="center"
                    >
                        <Box mb={5} mt={10}>
                            <Typography
                                variant="h4"
                                align="center"
                                color="primary"
                            >
                                Available Jobs
                            </Typography>
                        </Box>
                        <Box mb={5}>
                            <TableContainer component={Paper}>
                                <Table
                                    className={classes.table}
                                    aria-label="customized table"
                                >
                                    <TableHead>
                                        <TableRow>
                                            <StyledTableCell>
                                                Job Title
                                            </StyledTableCell>
                                            <StyledTableCell align="center">
                                                Experience
                                            </StyledTableCell>
                                            <StyledTableCell align="center">
                                                Educational Requirement
                                            </StyledTableCell>
                                            <StyledTableCell align="center">
                                                Deadline
                                            </StyledTableCell>
                                            <StyledTableCell align="center">
                                                Apply
                                            </StyledTableCell>
                                        </TableRow>
                                    </TableHead>
                                    <TableBody>
                                        {jobs.map(row => (
                                            <StyledTableRow key={row.id}>
                                                <StyledTableCell
                                                    component="th"
                                                    scope="row"
                                                >
                                                    {row.title}
                                                </StyledTableCell>
                                                <StyledTableCell align="center">
                                                    {row.experience}
                                                </StyledTableCell>
                                                <StyledTableCell align="center">
                                                    {row.education}
                                                </StyledTableCell>
                                                <StyledTableCell align="center">
                                                    {row.deadline}
                                                </StyledTableCell>
                                                <StyledTableCell align="center">
                                                    <Button
                                                        variant="outlined"
                                                        color="primary"
                                                        onClick={() => {
                                                            handleClickOpenDialog(
                                                                row
                                                            );
                                                        }}
                                                    >
                                                        Apply Now
                                                    </Button>
                                                </StyledTableCell>
                                            </StyledTableRow>
                                        ))}
                                    </TableBody>
                                </Table>
                            </TableContainer>
                        </Box>
                    </Grid>
                </Container>
                <Dialog
                    open={openDialog}
                    onClose={handleCloseDialog}
                    aria-labelledby="form-dialog-title"
                    style={{ zIndex: 2002 }}
                >
                    <DialogTitle id="form-dialog-title">
                        Email to : {row && row.email}
                    </DialogTitle>
                    <DialogContent>
                        {row && (
                            <div
                                dangerouslySetInnerHTML={{
                                    __html: row.description
                                }}
                            ></div>
                        )}

                        {/* <Formik
                            initialValues={{
                                firstname: "",
                                lastname: "",
                                email: "",
                                phone: "",
                                resume: ""
                            }}
                            validate={values => {
                                const errors = {};
                                if (!values.firstname) {
                                    errors.firstname = "Required";
                                }
                                if (!values.lastname) {
                                    errors.lastname = "Required";
                                }
                                if (!values.email) {
                                    errors.email = "Required";
                                }
                                if (!values.phone) {
                                    errors.phone = "Required";
                                }
                                if (!values.resume) {
                                    errors.resume = "Required";
                                }
                                return errors;
                            }}


                            onSubmit={(values, { setSubmitting }) => {
                                setTimeout(() => {
                                    setSubmitting(false);
                                    console.log(values.resume);
                                    let data = new FormData();
                                    data.append("resume", values.resume);
                                    Axios.post(
                                        window.location.origin +
                                            `/api/career/store`,
                                        {
                                            firstname: values.firstname,
                                            lastname: values.lastname,
                                            email: values.email,
                                            phone: values.phone,
                                            resume: data
                                        }
                                    )
                                        .then(res => {
                                            setOpen(true);
                                        })
                                        .catch(function() {
                                            console.log("error");
                                            setOpen(false);
                                        });
                                });
                            }}
                        >
                            {({ submitForm, isSubmitting }) => (
                                <div>
                                    <Container component="main" maxWidth="lg">
                                        <CssBaseline />
                                        <div>
                                            <form
                                                className={classes.form}
                                                noValidate
                                            >
                                                <Field
                                                    component={TextField}
                                                    name="firstname"
                                                    label="First Name"
                                                    variant="standard"
                                                    margin="normal"
                                                    fullWidth
                                                />
                                                <Field
                                                    component={TextField}
                                                    variant="standard"
                                                    margin="normal"
                                                    fullWidth
                                                    label="Last Name"
                                                    name="lastname"
                                                />
                                                <Field
                                                    component={TextField}
                                                    variant="standard"
                                                    margin="normal"
                                                    fullWidth
                                                    label="Email"
                                                    name="email"
                                                />
                                                <Field
                                                    component={TextField}
                                                    variant="standard"
                                                    margin="normal"
                                                    fullWidth
                                                    label="Phone"
                                                    name="phone"
                                                />
                                                <Box my={2}>
                                                    <Field
                                                        component={
                                                            SimpleFileUpload
                                                        }
                                                        name="resume"
                                                        label="Resume"
                                                        fullWidth
                                                    />
                                                </Box>

                                                {isSubmitting && (
                                                    <LinearProgress color="primary" />
                                                )}
                                                <Button
                                                    variant="contained"
                                                    color="secondary"
                                                    className={classes.submit}
                                                    disabled={isSubmitting}
                                                    onClick={submitForm}
                                                >
                                                    Submit Application
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
                                            severity="success"
                                            color="success"
                                            style={{
                                                backgroundColor: "#ff1a1a",
                                                color: "white"
                                            }}
                                        >
                                            Success
                                        </Alert>
                                    </Snackbar>
                                </div>
                            )}
                        </Formik> */}
                        <Typography>
                            Lorem, ipsum dolor sit amet consectetur adipisicing
                            elit. Esse, possimus? Sit obcaecati exercitationem
                            illo omnis fugit magni laborum fugiat, assumenda
                            odio asperiores ipsa laudantium quaerat earum
                            reprehenderit quos! Nulla, debitis!
                        </Typography>
                    </DialogContent>
                    <DialogActions>
                        <Button onClick={handleCloseDialog} color="primary">
                            Cancel
                        </Button>
                    </DialogActions>
                </Dialog>
            </Container>
        </motion.div>
    );
};
