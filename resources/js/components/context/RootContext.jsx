import localforage from "localforage";
import { applySnapshot, onSnapshot } from "mobx-state-tree";
import React, { createContext, useContext, useState, useRef } from "react";
import { useAsyncEffect } from "use-async-effect";
import RootStore from "../../models/RootStore";
import { debounce } from "../../utils/debounce";

const RootStoreContext = createContext(null);

export const RootStoreProvider = ({ children }) => {
    const [loaded, setLoaded] = useState(false);
    const store = useRef();

    useAsyncEffect(async isMounted => {
        const _store = RootStore.create();
        const data = await localforage.getItem("rootStore");
        if (data) {
            // data.questionSet = [];
            // console.log("Emptying Question Set");
            applySnapshot(_store, data);
        }

        const saveSnapshot = snapshot => {
            console.log("Saving Snapshot to Storage");
            localforage.setItem("rootStore", snapshot);
        };

        onSnapshot(_store, snapshot => {
            console.log(snapshot);
            saveSnapshot(snapshot);
        });

        store.current = _store;
        if (isMounted()) {
            setLoaded(true);
        }
    }, []);

    if (!loaded || !store.current) {
        return null;
    }

    return (
        <RootStoreContext.Provider value={store.current}>
            {children}
        </RootStoreContext.Provider>
    );
};

export const useRootStore = () => {
    const store = useContext(RootStoreContext);
    if (!store) {
        throw new Error(
            "useRootStore must be used within a RootStoreProvider."
        );
    }
    return store;
};
