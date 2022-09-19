import { SnapshotOrInstance, types, Instance } from "mobx-state-tree";

export const ServiceModel = types
    .model("Service", {
        id: types.identifierNumber,
        service_type: "",
        service_name: "",
        service_slug: "",
        icon_image: ""
    })
    .actions(self => ({
        increment() {
            self.quantity++;
        },
        decrement() {
            self.quantity--;
        }
    }))
    .views(self => ({
        get canDecrement() {
            return self.quantity < 2;
        },
        get subtotal() {
            return self.price * self.quantity;
        }
    }));
