import React, { useState } from "react";
import Grid from "@material-ui/core/Grid";
import Box from "@material-ui/core/Box";
import Typography from "@material-ui/core/Typography";
import { makeStyles } from "@material-ui/core/styles";
import Container from "@material-ui/core/Container";
import Accordion from "@material-ui/core/Accordion";
import AccordionDetails from "@material-ui/core/AccordionDetails";
import AccordionSummary from "@material-ui/core/AccordionSummary";
import ExpandMoreIcon from "@material-ui/icons/ExpandMore";

const useStyles = makeStyles(theme => ({
    root: {
        width: "100%"
    },
    heading: {
        fontSize: theme.typography.pxToRem(15),
        flexBasis: "33.33%",
        flexShrink: 0
    },
    secondaryHeading: {
        fontSize: theme.typography.pxToRem(15),
        color: theme.palette.text.secondary
    }
}));

export const CustomerHelpCenter = () => {
    const classes = useStyles();
    const [expanded, setExpanded] = React.useState(false);

    const handleChange = panel => (event, isExpanded) => {
        setExpanded(isExpanded ? panel : false);
    };
    return (
        <div>
            <Container maxWidth="md" disableGutters={true}>
                <Grid
                    container
                    direction="column"
                    justify="center"
                    alignItems="center"
                >
                    <Box mb={2}>
                        <Accordion
                            expanded={expanded === "panel1"}
                            onChange={handleChange("panel1")}
                        >
                            <AccordionSummary
                                expandIcon={<ExpandMoreIcon color="primary" />}
                                aria-controls="panel1bh-content"
                                id="panel1bh-header"
                            >
                                <Typography className={classes.heading}>
                                    How To Create an Account?
                                </Typography>
                            </AccordionSummary>
                            <AccordionDetails>
                                <Typography>
                                    Nulla facilisi. Phasellus sollicitudin nulla
                                    et quam mattis feugiat. Aliquam eget maximus
                                    est, id dignissim quam.
                                </Typography>
                            </AccordionDetails>
                        </Accordion>
                        <Accordion
                            expanded={expanded === "panel2"}
                            onChange={handleChange("panel2")}
                        >
                            <AccordionSummary
                                expandIcon={<ExpandMoreIcon color="primary" />}
                                aria-controls="panel2bh-content"
                                id="panel2bh-header"
                            >
                                <Typography className={classes.heading}>
                                    How To Create an Website?
                                </Typography>
                            </AccordionSummary>
                            <AccordionDetails>
                                <Typography>
                                    Donec placerat, lectus sed mattis semper,
                                    neque lectus feugiat lectus, varius pulvinar
                                    diam eros in elit. Pellentesque convallis
                                    laoreet laoreet.
                                </Typography>
                            </AccordionDetails>
                        </Accordion>
                        <Accordion
                            expanded={expanded === "panel3"}
                            onChange={handleChange("panel3")}
                        >
                            <AccordionSummary
                                expandIcon={<ExpandMoreIcon color="primary" />}
                                aria-controls="panel3bh-content"
                                id="panel3bh-header"
                            >
                                <Typography className={classes.heading}>
                                    How To Create an Profile?
                                </Typography>
                            </AccordionSummary>
                            <AccordionDetails>
                                <Typography>
                                    Nunc vitae orci ultricies, auctor nunc in,
                                    volutpat nisl. Integer sit amet egestas
                                    eros, vitae egestas augue. Duis vel est
                                    augue.
                                </Typography>
                            </AccordionDetails>
                        </Accordion>
                        <Accordion
                            expanded={expanded === "panel4"}
                            onChange={handleChange("panel4")}
                        >
                            <AccordionSummary
                                expandIcon={<ExpandMoreIcon color="primary" />}
                                aria-controls="panel4bh-content"
                                id="panel4bh-header"
                            >
                                <Typography className={classes.heading}>
                                    How To Create an Site?
                                </Typography>
                            </AccordionSummary>
                            <AccordionDetails>
                                <Typography>
                                    Nunc vitae orci ultricies, auctor nunc in,
                                    volutpat nisl. Integer sit amet egestas
                                    eros, vitae egestas augue. Duis vel est
                                    augue.
                                </Typography>
                            </AccordionDetails>
                        </Accordion>
                    </Box>
                </Grid>
            </Container>
        </div>
    );
};
