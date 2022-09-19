import React from "react";
import { makeStyles } from "@material-ui/core/styles";
import Accordion from "@material-ui/core/Accordion";
import AccordionSummary from "@material-ui/core/AccordionSummary";
import AccordionDetails from "@material-ui/core/AccordionDetails";
import Typography from "@material-ui/core/Typography";
import ExpandMoreIcon from "@material-ui/icons/ExpandMore";
import { Service } from "./Service";
import { Box, Container, Grid } from "@material-ui/core";
import Avatar from "@material-ui/core/Avatar";

const useStyles = makeStyles(theme => ({
    root: {
        width: "100%",
        overflowY: "scroll",
        height: "500px"
    },
    heading: {
        fontSize: theme.typography.pxToRem(15),
        fontWeight: theme.typography.fontWeightRegular
    }
}));

export const ChildCategory = ({ subcategory }) => {
    const classes = useStyles();

    return (
        <div className={classes.root}>
            <Container maxWidth="lg">
                {subcategory.map((subcat, index) => (
                    <Accordion
                        key={index}
                        style={{
                            marginBottom: 10
                        }}
                    >
                        <AccordionSummary
                            expandIcon={<ExpandMoreIcon color="primary" />}
                            aria-controls="panel2a-content"
                            id="panel2a-header"
                        >
                            <Grid container direction="row" alignItems="center">
                                <Box mr={2}>
                                    <Avatar
                                        alt="Remy Sharp"
                                        src={
                                            window.location.origin +
                                            "/uploads/sub-category/" +
                                            subcat.icon
                                        }
                                        variant="square"
                                    />
                                </Box>

                                <Typography className={classes.heading}>
                                    {subcat.sub_category}
                                </Typography>
                            </Grid>
                        </AccordionSummary>
                        <AccordionDetails>
                            {subcat.service.length > 0 ? (
                                <Service services={subcat.service} />
                            ) : (
                                <Typography variant="caption">
                                    Nothing Found
                                </Typography>
                            )}
                        </AccordionDetails>
                    </Accordion>
                ))}
            </Container>
        </div>
    );
};
