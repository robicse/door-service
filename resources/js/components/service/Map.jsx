import React from "react";
import {
    GoogleMap,
    LoadScript,
    Marker,
    InfoWindow
} from "@react-google-maps/api";
// import { useRootStore } from "../context/RootContext";
// import { useState, useContext } from "react";
import List from "@material-ui/core/List";
import ListItem from "@material-ui/core/ListItem";
import Divider from "@material-ui/core/Divider";
import ListItemText from "@material-ui/core/ListItemText";
import ListItemAvatar from "@material-ui/core/ListItemAvatar";
import Button from "@material-ui/core/Button";
import Avatar from "@material-ui/core/Avatar";
import Typography from "@material-ui/core/Typography";
import PersonPinCircleIcon from "@material-ui/icons/PersonPinCircle";

const containerStyle = {
    width: "700px",
    height: "500px"
};

const center = {
    lat: 23.835272,
    lng: 90.416934
};
const test = {
    lat: 23.821684,
    lng: 90.422817
};

export const Map = ({ vendors }) => {
    const [map, setMap] = React.useState(null);
    const [selectedMarker, setSelectedMarker] = React.useState(null);
    // const store = useRootStore();
    // const {
    //     service_title,
    //     getQuestionAnswerSet,
    //     service_location,
    //     service_location_lat,
    //     service_location_lng,
    //     getServiceDate,
    //     getTotalPrice,
    //     getUserLoginState
    // } = store;
    console.log(vendors);
    const onLoad = React.useCallback(function callback(map) {
        const bounds = new window.google.maps.LatLngBounds();
        map.fitBounds(bounds);
        setMap(map);
    }, []);

    const onUnmount = React.useCallback(function callback(map) {
        setMap(null);
    }, []);

    return (
        <LoadScript googleMapsApiKey="AIzaSyCE1oI9UN7X2VYS0UFVRKBdWd3TzyxT-tE">
            <GoogleMap
                mapContainerStyle={containerStyle}
                center={center}
                zoom={14}
                // onLoad={onLoad}
                onUnmount={onUnmount}
            >
                {
                    <Marker
                        position={center}
                        icon={{
                            url: `https://icons.iconarchive.com/icons/icons8/windows-8/32/Maps-Geo-Fence-icon.png`
                        }}
                    />
                }
                {vendors.map(vendor => (
                    <Marker
                        position={{
                            lat: parseFloat(vendor.services_latitude),
                            lng: parseFloat(vendor.services_longitude)
                        }}
                        icon={{
                            url: `https://icons.iconarchive.com/icons/graphicloads/polygon/32/home-icon.png`
                        }}
                        onClick={() => {
                            setSelectedMarker(vendor);
                        }}
                        key={vendor.mobile_number}
                    />
                ))}

                {selectedMarker ? (
                    <InfoWindow
                        position={{
                            lat: parseFloat(selectedMarker.services_latitude),
                            lng: parseFloat(selectedMarker.services_longitude)
                        }}
                        // onCloseClick={() => {
                        //     setSelectedMarker(null);
                        // }}
                    >
                        <List dense>
                            <ListItem alignItems="flex-start" button>
                                <ListItemAvatar>
                                    <Avatar
                                        sizes="small"
                                        alt={selectedMarker.image}
                                        src={
                                            window.location.origin +
                                            "/uploads/profile/" +
                                            selectedMarker.image
                                        }
                                    />
                                </ListItemAvatar>
                                <ListItemText
                                    primary={selectedMarker.name}
                                    secondary={
                                        <React.Fragment>
                                            <Typography
                                                component="span"
                                                variant="body2"
                                                color="textPrimary"
                                            ></Typography>
                                            {selectedMarker.services_area}
                                        </React.Fragment>
                                    }
                                />
                            </ListItem>
                        </List>
                    </InfoWindow>
                ) : null}
                <></>
            </GoogleMap>
        </LoadScript>
    );
};
