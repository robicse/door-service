import {
    Box,
    Button,
    Container,
    Grid,
    TextField,
    Typography
} from "@material-ui/core";
import React, { useEffect } from "react";
import BusinessIcon from "@material-ui/icons/Business";
import PhoneIcon from "@material-ui/icons/Phone";
import EmailIcon from "@material-ui/icons/Email";
import { Helmet } from "react-helmet";

export default function Contact() {
    useEffect(() => {
        window.scrollTo(0, 0);
    }, []);
    return (
        <div>
            <Helmet>
                <title>Contact | Doorservice</title>
            </Helmet>
            <Container maxWidth="md">
                <Grid container style={{ marginTop: "30px" }}>
                    <Grid item xs={12} md={6}>
                        <Typography variant="h5" color="primary">
                            Our Contact Details
                        </Typography>
                        <Box my={2}>
                            <Typography variant="h6">
                                “Door Service” is the Largest Workplace where
                                you can find verified and experienced service
                                providers at your doorstep.
                            </Typography>
                        </Box>
                        <Box my={2}>
                            <Button
                                size="large"
                                variant="text"
                                startIcon={<BusinessIcon />}
                            >
                                Address
                            </Button>
                            <Box ml={2}>
                                <Typography variant="body2">
                                    House: 05, Block: G, 1219 Banasree Main Rd,
                                    Dhaka 1219
                                </Typography>
                            </Box>
                        </Box>
                        <Box my={2}>
                            <Button
                                size="large"
                                variant="text"
                                startIcon={<PhoneIcon />}
                            >
                                Phone
                            </Button>
                            <Box ml={2}>
                                <Typography variant="body2">
                                    Hotline : 09677 100 200, 01313 740 740
                                </Typography>
                            </Box>
                        </Box>
                        <Box my={2}>
                            <Button
                                size="large"
                                variant="text"
                                startIcon={<EmailIcon />}
                            >
                                Email
                            </Button>
                            <Box ml={2}>
                                <Typography variant="body2">
                                    infodsl740@gmail.com
                                </Typography>
                            </Box>
                        </Box>
                    </Grid>
                    <Grid
                        item
                        xs={12}
                        md={6}
                        container
                        direction="column"
                        style={{ padding: "0px 30px" }}
                    >
                        <Box mb={2}>
                            <Typography variant="h5" color="primary">
                                Say Hello To Us
                            </Typography>
                        </Box>

                        <form
                            action="mailto:shirjoy.starit@gmail.com"
                            method="post"
                            enctype="text/plain"
                        >
                            <Box mb={2}>
                                <TextField
                                    id="outlined-basic"
                                    label="Your Name"
                                    variant="outlined"
                                    placeholder="Your Name*"
                                    name="name"
                                    type="text"
                                    fullWidth={true}
                                    color="primary"
                                />
                            </Box>

                            <Box mb={2}>
                                <TextField
                                    id="outlined-basic"
                                    label="Your Email"
                                    variant="outlined"
                                    placeholder="Your Email*"
                                    name="email"
                                    type="email"
                                    fullWidth={true}
                                    color="primary"
                                />
                            </Box>

                            <Box mb={2}>
                                <TextField
                                    id="outlined-basic"
                                    label="Your Query"
                                    variant="outlined"
                                    placeholder="Your Query*"
                                    name="query"
                                    type="text"
                                    fullWidth={true}
                                    multiline={true}
                                    color="primary"
                                />
                            </Box>
                            <Box mb={2}>
                                <Button
                                    variant="outlined"
                                    color="primary"
                                    fullWidth={true}
                                    type="submit"
                                >
                                    Submit
                                </Button>
                            </Box>
                        </form>
                    </Grid>
                    <Grid item xs={12} md={12}>
                        <Box my={5}>
                            <Box mb={2}>
                                <Typography variant="h5" color="primary">
                                    Find us on google map
                                </Typography>
                            </Box>
                            <iframe
                                src=""
                                width="100%"
                                height="400"
                                allowfullScreen=""
                                loading="lazy"
                                style={{ border: "0px" }}
                            ></iframe>
                        </Box>
                    </Grid>
                </Grid>
            </Container>
        </div>
    );
}
