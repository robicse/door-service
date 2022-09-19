import React from "react";
import { Menu, MenuItem, MenuButton, SubMenu } from "@szhsin/react-menu";
import "@szhsin/react-menu/dist/index.css";
import { Typography } from "@material-ui/core";
import { useAsyncEffect } from "use-async-effect";
import { Link } from "react-router-dom";
import axios from "axios";

export const MegaMenu = () => {
    const [services, setServices] = React.useState([]);
    const [loaded, setLoaded] = React.useState();
    const [overflow, setOverflow] = React.useState("hidden");
    const [position, setPosition] = React.useState("anchor");
    useAsyncEffect(async isMounted => {
        try {
            const ser = await axios.get(
                window.location.origin + "/api/category/subcategory/service/all"
            );
            if (!isMounted()) return;
            console.log(ser.data.success[0]);
            if (ser.data.success.lenght != 0) {
                setServices(ser.data.success);
                setLoaded(true);
            } else {
                console.log("No Data");
                setLoaded(false);
            }
        } catch (error) {
            console.log(error);
            setLoaded(false);
        }
    }, []);
    if (!loaded) {
        return null;
    }
    return (
        <Menu
            // overflow={overflow}
            position={position}
            align="center"
            menuButton={
                <Typography
                    style={{
                        marginRight: 20,
                        marginTop: 5,
                        fontSize: 14,
                        color: "#000000",
                        cursor: "pointer"
                    }}
                >
                    Services
                </Typography>
            }
        >
            {services.map(cat => (
                <SubMenu label={cat.category} key={cat.id}>
                    {services[0].subcategories.map(subcat => (
                        <MenuItem key={subcat.id}>
                            <Link
                                to={`/${cat.slug}/${subcat.slug}`}
                                style={{
                                    textDecoration: "none",
                                    width: "100%",
                                    height: "100%",
                                    color: "#000000"
                                }}
                            >
                                {subcat.sub_category}
                            </Link>
                        </MenuItem>
                    ))}
                </SubMenu>
            ))}
        </Menu>
    );
};
