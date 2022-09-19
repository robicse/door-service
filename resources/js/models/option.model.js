import { SnapshotOrInstance, types, Instance } from "mobx-state-tree";

export const OptionModel = types
    .model("Option", {
        id: types.integer,
        service_question_id: types.integer,
        option_title: "",
        option_price: "",
        created_at: "",
        updated_at: "",
        checked: ""
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
