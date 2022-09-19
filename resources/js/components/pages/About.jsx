import {Box, Container, Grid, ListItem, ListItemText , Typography} from "@material-ui/core";
import React, { useEffect } from "react";
import { Helmet } from "react-helmet";
import { WhyDoorService } from "../home/WhyDoorService";
import List from "@material-ui/core/List";

export const About = () => {
    useEffect(() => {
        window.scrollTo(0, 0);
    }, []);
    return (
        <div>
            <Helmet>
                <title>About | Doorservice</title>
            </Helmet>
            <Container maxWidth="md">
                <Grid container>
                    <Grid
                        item
                        xs={12}
                        md={6}
                        container
                        direction="column"
                        justify="center"
                    >
                        <Typography variant="h5">Hello!</Typography>
                        <Box my={1}>
                            <Typography color="primary" variant="h4">
                                About Us
                            </Typography>
                        </Box>
                        <Box my={2}>
                            <Typography variant="body1">
                                As we believe service required to satisfy needs, we love bridging to avail services. DSL administers an app based platform which connecting people to realize services at hand with values as well as creating opportunities unconditionally.
                                <Box marginTop={3}>
                                    <Typography component="h5" variant="h5" mt={3}>
                                        We extent for
                                    </Typography>
                                </Box>
                                   <List disablePadding>
                                       <ListItem>
                                           <ListItemText>1. To reach out Services at your hand</ListItemText>
                                       </ListItem>
                                       <ListItem > <ListItemText>2. Building Largest Open Workplace for Professionals and Entrepreneurs</ListItemText></ListItem>
                                       <ListItem ><ListItemText>3.  We are on your side with zero commission sharing</ListItemText></ListItem>
                                       <ListItem><ListItemText>4. To ensure Secured & Hassle free experience</ListItemText></ListItem>
                                       <ListItem><ListItemText>5. 24/7 with you</ListItemText></ListItem>
                                   </List>

                            </Typography>
                        </Box>
                    </Grid>
                    <Grid item xs={12} md={6}>
                        <img
                            src={
                                window.location.origin +
                                "/frontend/img/about/about.png"
                            }
                            alt=""
                        />
                    </Grid>
                    <Grid container>
                        <WhyDoorService />
                    </Grid>
                </Grid>
            </Container>
        </div>
    );
};
