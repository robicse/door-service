import { SnapshotOrInstance, types, Instance } from "mobx-state-tree";
import { OptionModel } from "./option.model";

export const QuestionModel = types
    .model("Question", {
        id: types.identifierNumber,
        service_id: "",
        question_type: "",
        is_optional: "",
        question: "",
        created_at: "",
        updated_at: "",
        answer: "",
        questionsOption: types.array(OptionModel)
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
