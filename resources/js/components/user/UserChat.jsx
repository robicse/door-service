import React, { useRef, useState, useEffect, useContext } from "react";
import firebase from "../../utils/firestore";
import "firebase/firestore";
import "firebase/auth";
import "firebase/analytics";
import { useAuthState } from "react-firebase-hooks/auth";
import {
    useCollectionData,
    useCollection,
    useDocument
} from "react-firebase-hooks/firestore";
import styles from "@chatscope/chat-ui-kit-styles/dist/default/styles.min.css";
import {
    MainContainer,
    ChatContainer,
    MessageList,
    Message,
    MessageInput,
    ConversationHeader,
    Avatar,
    MessageSeparator,
    TypingIndicator,
    InputToolbox,
    SendButton
} from "@chatscope/chat-ui-kit-react";
import {
    Container,
    Grid,
    Paper,
    Box,
    Divider,
    Typography,
    Button,
    TextareaAutosize
} from "@material-ui/core";
import { useAsyncEffect } from "use-async-effect";
import { useRootStore } from "../context/RootContext";
import { UserContext } from "../context/UserContext";
import TextField from "@material-ui/core/TextField";
import InputAdornment from "@material-ui/core/InputAdornment";
import Dialog from "@material-ui/core/Dialog";
import DialogActions from "@material-ui/core/DialogActions";
import DialogContent from "@material-ui/core/DialogContent";
import DialogContentText from "@material-ui/core/DialogContentText";
import DialogTitle from "@material-ui/core/DialogTitle";
import { useHistory } from "react-router-dom";
import Card from "@material-ui/core/Card";
import CardActionArea from "@material-ui/core/CardActionArea";
import CardActions from "@material-ui/core/CardActions";
import CardContent from "@material-ui/core/CardContent";
import CardMedia from "@material-ui/core/CardMedia";
import { Helmet } from "react-helmet";

const auth = firebase.auth();
const firestore = firebase.firestore();
const analytics = firebase.analytics();

export const UserChat = () => {
    const history = useHistory();
    const store = useRootStore();
    const { getCurOrderVenId } = store;
    const { user } = useContext(UserContext);
    const messagesRef = firestore.collection("conversation");
    const [formValue, setFormValue] = useState("");
    const [chat, setChat] = useState(false);
    const [vendor, setVendor] = useState();
    const [order, setOrder] = useState();
    const [vendorOrder, setVendorOrder] = useState();
    const [open, setOpen] = React.useState(false);
    const [toggler, setToggler] = useState(false);
    const handleClickOpen = () => {
        setOpen(true);
    };

    const handleClose = () => {
        setOpen(false);
    };
    const [loaded, setLoaded] = useState(false);
    const [chatId, setChatId] = useState("loading");
    const [value, loading, error] = useDocument(
        firebase.firestore().doc("conversation/" + chatId)
    );

    //console.log("Document data:", value);
    console.log("Order data:", order);

    let orderData = null;
    if (order) {
        orderData = JSON.parse(order?.shipping_address);
    }
    // console.log(orderData?.service_type);

    const sendMessage = async formValue => {
        setFormValue(formValue);
        // const { uid, photoURL } = auth.currentUser;
        // await messagesRef.doc("u12-ven2").add({
        //     text: formValue,
        //     sentTime: "now",
        //     sender: "Emily",
        //     direction: "outgoing",
        //     position: "last",
        //     createdAt: firebase.firestore.FieldValue.serverTimestamp()
        // });

        await messagesRef.doc(chatId).update({
            messages: firebase.firestore.FieldValue.arrayUnion({
                text: formValue,
                sentTime: Date.now(),
                sender: user.user.id,
                senderType: "user",
                position: "last",
                createdAt: Date.now()
            })
        });
    };
    const emilyIco = "https://image.flaticon.com/icons/png/512/147/147144.png";

    useAsyncEffect(
        async isMounted => {
            try {
                const request_details = await axios.post(
                    window.location.origin +
                        "/api/user/order/request/list/vendor/details",
                    {
                        id: getCurOrderVenId
                    },
                    {
                        headers: { Authorization: "Bearer " + user.token }
                    }
                );
                if (!isMounted()) return;

                if (request_details.data.response.lenght != 0) {
                    //console.log(request_details.data.response[0].chat_id);
                    setVendor(request_details.data.response[1][0]);
                    setOrder(request_details.data.response[2]);
                    //setVendorOrder(request_details.data.response[0]);
                    setLoaded(true);
                    console.log(request_details.data.response[0].chat_id);
                    var docRef = messagesRef.doc(
                        request_details.data.response[0].chat_id
                    );
                    docRef
                        .get()
                        .then(function(doc) {
                            if (doc.exists) {
                                console.log("Exist");
                                setChatId(
                                    request_details.data.response[0].chat_id
                                );
                            } else {
                                setChatId(
                                    request_details.data.response[0].chat_id
                                );
                                console.log("No such document!");
                                messagesRef
                                    .doc(
                                        request_details.data.response[0].chat_id
                                    )
                                    .set({
                                        messages: [
                                            {
                                                text:
                                                    "Welcome to Door Service.From now you can start chat with vendor",
                                                sentTime: Date.now(),
                                                sender: "1",
                                                senderType: "vendor",
                                                position: "first",
                                                createdAt: Date.now()
                                            }
                                        ]
                                    })
                                    .then(function() {
                                        console.log(
                                            "Document successfully written!"
                                        );
                                        setChat(true);
                                    });
                            }
                        })
                        .catch(function(error) {
                            console.log("Error getting document:", error);
                        });
                } else {
                    console.log("No Data");
                    setLoaded(false);
                }
            } catch (error) {
                console.log(error);
                setLoaded(false);
            }
        },
        [toggler]
    );

    // useEffect(() => {
    //     console.log("hi");
    // }, [formValue]);
    const [finalPrice, setFinalPrice] = useState(null);
    const handleFinalPrice = e => setFinalPrice(e.target.value);
    const changeFinalPrice = async () => {
        try {
            const final = await axios.post(
                window.location.origin + "/api/user/order/grand-total/change",
                {
                    order_id: order.id,
                    grand_total: finalPrice
                },
                {
                    headers: { Authorization: "Bearer " + user.token }
                }
            );
            if (final.data.response.lenght != 0) {
                //console.log(final.data);
                // history.push(`/user/request/${order.invoice_code}/quotes`);
                setToggler(!toggler);
            } else {
                console.log("No Data");
            }
        } catch (error) {
            console.log(error);
        }
    };
    const [paymentProcess, setPaymentprocess] = useState("");
    const payment_process = type => {
        // if (type == "authorized") {
        //     if (order.payment_status == 1) {
        //         bookVendor(type);
        //     } else {
        //         history.push(`/user/request/${order.invoice_code}/quotes`);
        //     }
        // } else {
        //     bookVendor(type);
        // }]

        if (type == "authorized") {
            if (order.payment_status == 0) {
                bookVendor(type);
            } else {
                history.push(`/user/request/${order.invoice_code}/quotes`);
            }
        } else {
            bookVendor(type);
        }
    };
    const bookVendor = async type => {
        console.log("vid", vendor.user_id);
        // return 0;
        try {
            const submit = await axios.post(
                window.location.origin + "/api/user/order/book",
                {
                    order_id: order.id,
                    vendor_id: vendor.user_id,
                    payment_process: type,
                    order_detail_communication: orderDetailCommunication
                },
                {
                    headers: { Authorization: "Bearer " + user.token }
                }
            );
            if (submit?.data?.response?.lenght != 0) {
                //console.log(submit.data);
                history.push(`/user/request/${order.invoice_code}/quotes`);
            } else {
                console.log("No Data");
            }
        } catch (error) {
            console.log(error);
        }
    };

    const [orderDetailCommunication, setOrderDetailCommunication] = useState(
        null
    );

    return (
        <>
            <Helmet>
                <title>Chat | Doorservice</title>
            </Helmet>
            <Container maxWidth="lg">
                <Grid container direction="row">
                    <Grid item xs={12} md={4}>
                        {loaded && (
                            <Paper elevation={3}>
                                <Grid
                                    container
                                    direction="row"
                                    alignItems="center"
                                    justify="center"
                                >
                                    <Grid
                                        item
                                        xs={12}
                                        md={4}
                                        container
                                        alignItems="center"
                                        justify="center"
                                    >
                                        <Box p={1}>
                                            <img
                                                src={
                                                    window.location.origin +
                                                    "/uploads/profile/" +
                                                    vendor.image
                                                }
                                                alt=""
                                                width="60px"
                                                height="60px"
                                            />
                                        </Box>
                                    </Grid>
                                    <Grid item xs={12} md={8}>
                                        <Box px={3}>
                                            <Typography variant="h6">
                                                {vendor.vendor_company_name}
                                            </Typography>
                                            {/* <Typography variant="caption">
                                                268 rating
                                            </Typography> */}
                                        </Box>
                                    </Grid>
                                </Grid>
                                <Divider variant="middle" />
                                <Grid
                                    container
                                    direction="row"
                                    alignItems="center"
                                    justify="space-between"
                                >
                                    <Grid item xs={6}>
                                        <Box p={3} py={3}>
                                            <Typography variant="subtitle2">
                                                Quoted Price
                                            </Typography>
                                        </Box>
                                    </Grid>
                                    <Grid item xs={6}>
                                        <Box px={3} py={3}>
                                            <Typography variant="subtitle2">
                                                TK {order.grand_total}
                                            </Typography>
                                        </Box>
                                    </Grid>
                                </Grid>
                                {order.payment_status == 0 && (
                                    <Grid
                                        container
                                        direction="row"
                                        alignItems="center"
                                        // justify="space-between"
                                    >
                                        <Grid item xs={12}>
                                            <Box mb={1}>
                                                <TextField
                                                    id="outlined-basic"
                                                    label="Final Price"
                                                    variant="outlined"
                                                    required={true}
                                                    value={finalPrice}
                                                    onChange={handleFinalPrice}
                                                    fullWidth
                                                    size="medium"
                                                    onKeyDown={evt =>
                                                        evt.key != "0" &&
                                                        evt.key !=
                                                            "Backspace" &&
                                                        evt.key !=
                                                            "ArrowLeft" &&
                                                        evt.key !=
                                                            "ArrowRight" &&
                                                        evt.key != "9" &&
                                                        evt.key != "8" &&
                                                        evt.key != "7" &&
                                                        evt.key != "6" &&
                                                        evt.key != "5" &&
                                                        evt.key != "4" &&
                                                        evt.key != "3" &&
                                                        evt.key != "2" &&
                                                        evt.key != "1" &&
                                                        evt.preventDefault()
                                                    }
                                                    // type="number"

                                                    disabled={
                                                        orderData?.service_type ==
                                                        "Fixed"
                                                            ? true
                                                            : false
                                                    }
                                                    InputProps={{
                                                        endAdornment: (
                                                            <InputAdornment position="start">
                                                                <Button
                                                                    aria-label="Update Final Price"
                                                                    edge="end"
                                                                    size="small"
                                                                    variant="contained"
                                                                    color="primary"
                                                                    disabled={
                                                                        orderData?.service_type ==
                                                                        "Fixed"
                                                                            ? true
                                                                            : false
                                                                    }
                                                                    onClick={
                                                                        changeFinalPrice
                                                                    }
                                                                >
                                                                    update
                                                                </Button>
                                                            </InputAdornment>
                                                        )
                                                    }}
                                                />
                                            </Box>
                                        </Grid>
                                        <Grid item xs={12}>
                                            <Box mb={1}>
                                                <TextareaAutosize
                                                    value={
                                                        orderDetailCommunication
                                                    }
                                                    label="Order Detail Communication"
                                                    onChange={e =>
                                                        setOrderDetailCommunication(
                                                            e.target.value
                                                        )
                                                    }
                                                    aria-label="minimum height"
                                                    placeholder="Service price, service details etc..."
                                                    style={{
                                                        width: 338,
                                                        height: 100
                                                    }}
                                                />
                                            </Box>
                                        </Grid>
                                    </Grid>
                                )}

                                <Divider variant="middle" />
                                <Grid
                                    container
                                    direction="row"
                                    alignItems="center"
                                    justify="space-between"
                                >
                                    <Button
                                        fullWidth
                                        variant="contained"
                                        color="primary"
                                        onClick={handleClickOpen}
                                    >
                                        Book
                                    </Button>
                                </Grid>
                            </Paper>
                        )}
                        <Dialog
                            open={open}
                            onClose={handleClose}
                            aria-labelledby="alert-dialog-title"
                            aria-describedby="alert-dialog-description"
                        >
                            <DialogTitle id="alert-dialog-title">
                                How do you want to pay for this service?
                            </DialogTitle>
                            <DialogContent>
                                <Grid container spacing={4} direction="row">
                                    <Grid item xs={6}>
                                        <Card
                                            onClick={
                                                () =>
                                                    payment_process(
                                                        "authorized"
                                                    )
                                                // console.log('OKOK1')
                                            }
                                        >
                                            <CardActionArea>
                                                <CardMedia
                                                    component="img"
                                                    alt="Authorized Payment"
                                                    height="150"
                                                    image={
                                                        window.location.origin +
                                                        "/frontend/img/payment/authorized.png"
                                                    }
                                                    title="Authorized Payment"
                                                />
                                                <CardContent>
                                                    <Typography
                                                        gutterBottom
                                                        variant="h6"
                                                        component="h2"
                                                    >
                                                        Authorized Way
                                                    </Typography>
                                                    <Typography
                                                        variant="subtitle2"
                                                        color="textSecondary"
                                                        component="p"
                                                    >
                                                        Your payment will be
                                                        handled by Door Service.
                                                    </Typography>
                                                    <Typography
                                                        variant="subtitle2"
                                                        color="textSecondary"
                                                        component="p"
                                                    >
                                                        By selecting authorize
                                                        option you have to pay
                                                        first.
                                                    </Typography>
                                                </CardContent>
                                            </CardActionArea>
                                        </Card>
                                    </Grid>
                                    <Grid item xs={6}>
                                        <Card
                                            onClick={() =>
                                                payment_process("unauthorized")
                                            }
                                        >
                                            <CardActionArea>
                                                <CardMedia
                                                    component="img"
                                                    alt="Unuthorized Payment"
                                                    height="150"
                                                    image={
                                                        window.location.origin +
                                                        "/frontend/img/payment/unauthorized.png"
                                                    }
                                                    title="Unuthorized Payment"
                                                />
                                                <CardContent>
                                                    <Typography
                                                        gutterBottom
                                                        variant="h6"
                                                        component="h2"
                                                    >
                                                        Unauthorized Way
                                                    </Typography>
                                                    <Typography
                                                        variant="subtitle2"
                                                        color="textSecondary"
                                                        component="p"
                                                    >
                                                        Your payment will be
                                                        handle by Vendor.
                                                    </Typography>
                                                    <Typography
                                                        variant="subtitle2"
                                                        color="textSecondary"
                                                        component="p"
                                                    >
                                                        Vendor will collect
                                                        payment after service.
                                                    </Typography>
                                                </CardContent>
                                            </CardActionArea>
                                        </Card>
                                    </Grid>
                                </Grid>
                            </DialogContent>
                            {/* <DialogActions>
                                <Button onClick={handleClose} color="primary">
                                    Disagree
                                </Button>
                                <Button
                                    onClick={handleClose}
                                    color="primary"
                                    autoFocus
                                >
                                    Agree
                                </Button>
                            </DialogActions> */}
                        </Dialog>
                    </Grid>
                    <Grid item xs={0} md={1}></Grid>
                    {loaded && (
                        <Grid item xs={12} md={7} style={{ marginTop: 20 }}>
                            <div
                                style={{
                                    height: "500px"
                                }}
                            >
                                <ChatContainer>
                                    <ConversationHeader>
                                        <Avatar
                                            src={
                                                window.location.origin +
                                                "/uploads/profile/" +
                                                vendor.image
                                            }
                                            name={vendor.vendor_company_name}
                                        />
                                        <ConversationHeader.Content
                                            userName={
                                                vendor.vendor_company_name
                                            }
                                        />
                                        {/* <ConversationHeader.Actions>
                        <VoiceCallButton />
                        <VideoCallButton />
                        <InfoButton />
                    </ConversationHeader.Actions> */}
                                    </ConversationHeader>
                                    <MessageList loading={loading}>
                                        {/* <MessageSeparator content="Saturday, 30 November 2019" /> */}

                                        {/* <Message
                            model={{
                                message: "Test",
                                sentTime: "15 mins ago",
                                sender: "Emily",
                                direction: "incoming",
                                position: "last"
                            }}
                        >
                            <Avatar src={emilyIco} name={"Emily"} />
                        </Message> */}
                                        {value &&
                                            value.data()?.messages.map(msg => (
                                                <Message
                                                    key={msg.createdAt}
                                                    model={{
                                                        message: msg.text,
                                                        sentTime: "15 mins ago",
                                                        sender: msg.sender,
                                                        direction:
                                                            user.user.id ==
                                                            msg.sender
                                                                ? "outgoing"
                                                                : "incoming",
                                                        position: "last"
                                                    }}
                                                />
                                            ))}
                                    </MessageList>
                                    <MessageInput
                                        attachButton={false}
                                        placeholder="Type message here"
                                        onSend={sendMessage}
                                    />
                                </ChatContainer>
                            </div>
                        </Grid>
                    )}
                </Grid>
            </Container>
        </>
    );
};
