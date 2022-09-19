import React, { useContext } from "react";
import { UserContext } from "../context/UserContext";
import { Sidebar } from "./Sidebar";

const Dashboard = props => {
    const { user, setUser } = useContext(UserContext);
    if (props.match == undefined) {
        return (
            <div 
            style={{zIndex:1}}
            >
                <Sidebar comp={props.comp} invoice={null} />
            </div>
        );
    } else {
        return (
            <div 
            style={{zIndex:1}}
            >
                <Sidebar
                    comp="requestDetails"
                    invoice={props.match.params.invoice_id}
                />
            </div>
        );
    }
};

export default Dashboard;
