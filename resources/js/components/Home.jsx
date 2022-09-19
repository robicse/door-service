import React from "react";
import { Slider } from "./home/Slider";
import { SearchBar } from "./home/SearchBar";
import { WhatNeed } from "./home/WhatNeed";
import { HowItWork } from "./home/HowItWork";
import { WhyDoorService } from "./home/WhyDoorService";
import { Testimonals } from "./home/Testimonals";
import { TrendingNow } from "./home/TrendingNow";
import { motion } from "framer-motion";
import TopService from "./home/new/TopService";
import Banner from "./home/new/Banner";
import WhyDoorServiceNew from "./home/new/WhyDoorService";
import Mission from "./home/new/Mission";
import Footer from "./home/new/Footer";
// import HowItWorks from "./home/new/HowItWorks";
import Google from "./home/new/Google";
import { Helmet } from "react-helmet";
import { useRootStore } from "./context/RootContext";
import { observer } from "mobx-react-lite";

export const Home = observer(() => {
    const store = useRootStore();
    const { homeScroll } = store;
    React.useEffect(() => {
        window.scrollTo(0, 0);
    }, []);
    // console.log(homeScroll);
    // React.useEffect(() => {
    //     alert("SSj");
    //     window.scrollTo(0, 0);
    // }, [homeScroll]);
    return (
        <motion.div
            initial={{ opacity: 0 }}
            animate={{ opacity: 1 }}
            exit={{ opacity: 0 }}
        >
            <Helmet>
                <title>Home | Doorservice</title>
            </Helmet>
            {/* <Slider />*/}
            {/* <SearchBar />
            <Banner />
            <TopService />
            <WhatNeed />
            <TrendingNow />
            <HowItWork />
            <WhyDoorServiceNew/>
            <Mission/>
            <WhyDoorService />
            <Testimonals />
            */}
            <Banner />
            <TopService />
            <TrendingNow />
            <HowItWork />
            <WhyDoorServiceNew />
            <Mission />
            {/* <Footer /> */}
        </motion.div>
    );
});
