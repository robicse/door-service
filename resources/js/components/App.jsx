import React from "react";
import ReactDOM from "react-dom";
import { Header } from "./layout/Header";
import { Home } from "./Home";
import { Container } from "@material-ui/core";
import Footer from "./layout/Footer";
import { makeStyles } from "@material-ui/core/styles";
import { createMuiTheme, ThemeProvider } from "@material-ui/core/styles";
import {
    BrowserRouter as Router,
    Switch,
    Route,
    Link,
    Redirect
} from "react-router-dom";
import { BeOurVendor } from "./pages/BeOurVendor";
import Login from "./auth/Login";
import Registration from "./auth/Registration";
import { useState, useMemo, useEffect } from "react";
import { UserContext } from "./context/UserContext";
import { RootStoreProvider } from "./context/RootContext";
import axios from "axios";
import { SubCategory } from "./service/SubCategory";
import { ServiceList } from "./service/ServiceList";
import { ServiceLocation } from "./service/ServiceLocation";
import { ServiceDetails } from "./service/ServiceDetails";
import Dashboard from "./user/Dashboard";
import { ServiceQuestion } from "./service/ServiceQuestion";
import { Category } from "./service/all_service/Category";
import { Career } from "./pages/Career";
import { AnimatePresence } from "framer-motion";
import { Help } from "./pages/help/Help";
import { OnlinePayment } from "./pages/help/OnlinePayment";
//import Footer from "./home/new/Footer";
import StickyFooter from "./layout/StickyFooter";
import Terms from "./pages/Terms";
import Privacy from "./pages/Privacy";
import { About } from "./pages/About";
import Contact from "./pages/Contact";
import Blog from "./pages/blog/Blog";
import BlogCategory from "./pages/blog/BlogCategory";
import BlogDetails from "./pages/blog/BlogDetails";
import RefundPolicy from "./pages/help/RefundPolicy";

const theme = createMuiTheme({
    palette: {
        primary: {
            main: "#fe6140"
        },
        secondary: {
            main: "#ffdb01"
        },
        text: {
            primary: "rgba(0, 0, 0, 1)"
        }
    },
    typography: {
        fontFamily: [
            "Merriweather Sans",
            "BlinkMacSystemFont",
            '"Segoe UI"',
            "Roboto",
            '"Helvetica Neue"',
            "Arial",
            "sans-serif",
            '"Apple Color Emoji"',
            '"Segoe UI Emoji"',
            '"Segoe UI Symbol"'
        ].join(",")
    },
    routeWrapper: {
        position: "relative"
    }

    //   .route-wrapper > div {
    //     position: absolute;
    //   }
});

const useStyles = makeStyles(theme => ({}));

function App() {
    const [user, setUser] = useState({
        token: undefined,
        user: undefined,
        isAuthenticate: false
    });
    const classes = useStyles();
    const value = useMemo(() => ({ user, setUser }), [user, setUser]);
    const [loaded, setLoaded] = useState(false);
    const [pusherUser, setPusherUser] = useState();

    useEffect(() => {
        (async () => {
            // Pusher.logToConsole = true;

            // var pusher = new Pusher("2c7abd3574eb20e399ae", {
            //     cluster: "ap2"
            // });

            // var channel = pusher.subscribe("order-accept-by-vendor-to-user");
            // channel.bind("order-accept-by-vendor-to-user", function(data) {
            //     console.log(typeof data);
            //     setPusherUser(data.userid);
            // });

            let token = localStorage.getItem("auth-token");
            if (token === "") {
                localStorage.setItem("auth-token", "");
                token = "";
                setUser({
                    token: undefined,
                    user: undefined,
                    isAuthenticate: false
                });

                setLoaded(true);
            } else {
                try {
                    const userRes = await axios.get(
                        window.location.origin + "/api/user",
                        {
                            headers: { Authorization: "Bearer " + token }
                        }
                    );

                    if (userRes.data.lenght != 0) {
                        console.log(userRes);
                        setUser({
                            token,
                            user: userRes.data,
                            isAuthenticate: true
                        });
                        setLoaded(true);
                    } else {
                        localStorage.setItem("auth-token", "");
                        setUser({
                            token: undefined,
                            user: undefined,
                            isAuthenticate: false
                        });
                        setLoaded(true);
                    }
                } catch (error) {
                    console.log("Unauthorized", error);
                    setUser({
                        token: undefined,
                        user: undefined,
                        isAuthenticate: false
                    });

                    setLoaded(true);
                }
            }
        })();
    }, []);

    // useEffect(() => {
    //     let token = localStorage.getItem("auth-token");
    //     if (token === "") {
    //     } else {
    //     }
    // }, [pusherUser]);

    if (!loaded) {
        return null;
    }

    return (
        <>
            <RootStoreProvider>
                <ThemeProvider theme={theme}>
                    <Router>
                        <Container
                            maxWidth={false}
                            disableGutters={true}
                            style={{
                                backgroundColor: "white",
                                display: "flex",
                                flexDirection: "column",
                                minHeight: "100vh"
                            }}
                        >
                            <UserContext.Provider value={value}>
                                <Header />
                                <AnimatePresence>
                                    <Switch>
                                        <Route path="/" exact>
                                            <Home />
                                        </Route>
                                        <Route path="/service-providers" exact>
                                            <BeOurVendor />
                                        </Route>
                                        <Route path="/services/explore" exact>
                                            <Category />
                                        </Route>
                                        <Route path="/career/job" exact>
                                            <Career />
                                        </Route>
                                        <Route path="/help/center" exact>
                                            <Help />
                                        </Route>
                                        <Route path="/payment/process" exact>
                                            <OnlinePayment />
                                        </Route>
                                        <Route path="/terms-condition" exact>
                                            <Terms />
                                        </Route>
                                        <Route path="/privacy-policy" exact>
                                            <Privacy />
                                        </Route>
                                        <Route path="/about-us" exact>
                                            <About />
                                        </Route>
                                        <Route path="/contact-us" exact>
                                            <Contact />
                                        </Route>
                                        <Route path="/refund-policy" exact>
                                            <RefundPolicy />
                                        </Route>
                                        <Route path="/blog" exact>
                                            <Blog />
                                        </Route>
                                        <Route
                                            path="/blog/:blog_id"
                                            component={BlogDetails}
                                            exact
                                        />
                                        <Route
                                            path="/blog/category/:cat_id"
                                            component={BlogCategory}
                                            exact
                                        />

                                        {!user.isAuthenticate ? (
                                            <Route path="/signin" exact>
                                                <Login />
                                            </Route>
                                        ) : (
                                            <Route path="/signin" exact>
                                                <Redirect to="/dashboard" />
                                            </Route>
                                        )}
                                        {!user.isAuthenticate ? (
                                            <Route path="/signup" exact>
                                                <Registration />
                                            </Route>
                                        ) : (
                                            <Route path="/signup" exact>
                                                <Redirect to="/dashboard" />
                                            </Route>
                                        )}

                                        <Route path="/user/request" exact>
                                            {user.isAuthenticate ? (
                                                <Dashboard comp="request" />
                                            ) : (
                                                <Redirect to="/signin" />
                                            )}
                                        </Route>
                                        <Route path="/user/settings" exact>
                                            {user.isAuthenticate ? (
                                                <Dashboard comp="setting" />
                                            ) : (
                                                <Redirect to="/signin" />
                                            )}
                                        </Route>
                                        <Route
                                            path="/user/request/vendor/book/:vendor_id"
                                            exact
                                        >
                                            {user.isAuthenticate ? (
                                                <Dashboard comp="chat" />
                                            ) : (
                                                <Redirect to="/signin" />
                                            )}
                                        </Route>
                                        <Route
                                            path="/user/request/:invoice_id/quotes"
                                            component={Dashboard}
                                            comp="requestDetails"
                                        />
                                        <Route
                                            path="/service/service_requests/service_details/:location"
                                            component={ServiceDetails}
                                        />
                                        <Route
                                            path="/service/question-set/:service"
                                            component={ServiceQuestion}
                                        />
                                        <Route
                                            path="/service/service_requests/:service"
                                            component={ServiceLocation}
                                        />
                                        <Route
                                            path="/:category/:subcategory"
                                            component={ServiceList}
                                        />
                                        <Route
                                            path="/:category"
                                            component={SubCategory}
                                        />
                                    </Switch>
                                </AnimatePresence>
                            </UserContext.Provider>
                            {/* <StickyFooter /> */}
                            <Footer />
                        </Container>
                    </Router>
                </ThemeProvider>
            </RootStoreProvider>
        </>
    );
}

export default App;

if (document.getElementById("app")) {
    ReactDOM.render(<App />, document.getElementById("app"));
}
