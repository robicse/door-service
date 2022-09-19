import React from "react";
import { Request } from "./Request";
import { RequestDetails } from "./RequestDetails";
import { UserSettings } from "./UserSettings";
import { motion } from "framer-motion";
import { UserChat } from "./UserChat";

export const Navigate = props => {
    switch (props.comp) {
        case "request":
            return (
                <motion.div
                    initial={{ opacity: 0 }}
                    animate={{ opacity: 1 }}
                    exit={{ opacity: 0 }}
                >
                    <Request />
                </motion.div>
            );
            break;
        case "requestDetails":
            return <RequestDetails invoice_id={props.invoice} />;
            break;
        case "setting":
            return (
                <motion.div
                    initial={{ opacity: 0 }}
                    animate={{ opacity: 1 }}
                    exit={{ opacity: 0 }}
                >
                    <UserSettings />
                </motion.div>
            );

            break;
        case "chat":
            return (
                <motion.div
                    initial={{ opacity: 0 }}
                    animate={{ opacity: 1 }}
                    exit={{ opacity: 0 }}
                >
                    <UserChat />
                </motion.div>
            );

            break;
        default:
            return <div></div>;
    }
};
