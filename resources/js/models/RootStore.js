import { types } from "mobx-state-tree";
import { QuestionModel } from "./question.model";
import { ServiceModel } from "./service.model";

const RootStore = types
    .model("Root", {
        service_id: 0,
        service_title: "",
        service_slug: "",
        service_type: "",
        service_location: "",
        service_location_lat: "",
        service_location_lng: "",
        service_preferred_date: 1603866240000,
        service_alternative_date: 1603866240000,
        service_price: 0,
        questionSet: types.map(QuestionModel),
        root_index: types.array(types.number),
        service: types.map(ServiceModel),
        log_in_state: false,
        windows_location: "",
        current_order_vendor_id: 0,
        payment_process: "unauthorize",
        key: "",
        isVendor: false,
        homeScroll: true
    })
    .actions(self => ({
        setTitle(title) {
            self.service_title = title;
        },
        setHomescroll() {
            console.log("hi");
            self.homeScroll = !self.homeScroll;
        },
        setKey(key) {
            self.key = key;
        },
        setisVendor(isVendor) {
            self.isVendor = isVendor;
        },
        setServiceInfo(service) {
            self.service_id = service.id;
            self.service_title = service.service_name;
            self.service_slug = service.slug;
            self.service_type = service.service_type;
        },
        setLogInState(state) {
            self.log_in_state = state;
        },
        setServiceLat(lat) {
            self.service_location_lat = lat;
        },
        setServiceLng(lng) {
            self.service_location_lng = lng;
        },
        updateLocation(location) {
            self.service_location = location;
        },
        updateWindowsLocation(location) {
            self.windows_location = location;
        },
        addQuestionSet(seviceDetails) {
            self.service_price = parseInt(seviceDetails.service_price);
            const question = Object.assign({}, seviceDetails.question);
            console.log(question);
            self.root_index = [];
            let id = 0;
            let service_id = "0";
            for (var key of Object.keys(question)) {
                self.questionSet.put(question[key]);
                self.root_index.push(question[key].id);
                id = question[key].id;
                service_id = question[key].service_id;
            }
            self.questionSet.put({
                id: id + 1,
                service_id: service_id,
                question_type: "date",
                is_optional: "false",
                question: "When do u need it?",
                created_at: "",
                updated_at: "",
                answer: "",
                questionsOption: []
            });
            self.root_index.push(id + 1);
        },
        updateCheckStatus(id, option_index) {
            console.log(option_index);
            let question = self.questionSet.get(id);
            if (question.question_type == "checkbox") {
                let option = [...question.questionsOption];
                console.log(option[option_index].checked);
                if (option[option_index].checked == "true") {
                    option[option_index].checked = "false";
                } else {
                    option[option_index].checked = "true";
                }
                console.log(option[option_index].checked);
            } else if (question.question_type == "radio") {
                let option = [...question.questionsOption];
                option.map((opt, index) =>
                    option_index == index
                        ? (option[index].checked = "true")
                        : (option[index].checked = "false")
                );
            }
        },
        updateQuestionAnswer(id, answer) {
            let question = self.questionSet.get(id);
            question.answer = answer;
        },
        updateServiceDate(date) {
            const number = date.getTime();
            self.service_preferred_date = number;
        },
        updateServiceAlternativeDate(date) {
            const number = date.getTime();
            //console.log(new Date(number));
            self.service_alternative_date = number;
        },
        addPrice(cost) {
            self.total_price = self.total_price + parseInt(cost);
        },
        clearStore() {
            self.service_id = 0;
            self.service_title = "";
            self.service_slug = "";
            self.service_type = "";
            self.service_location = "";
            self.service_location_lat = "";
            self.service_location_lng = "";
            self.service_preferred_date = 1603866240000;
            self.service_alternative_date = 1603866240000;
            self.service_price = 0;
            self.questionSet = {};
            self.root_index = [];
        },
        set_current_order_vendor_id(id) {
            self.current_order_vendor_id = id;
        },
        setPaymentProcess(type) {
            self.payment_process = type;
        }
    }))
    .views(self => ({
        getQuestion(id) {
            return self.questionSet.get(id);
        },
        get getTotalPrice() {
            let total_price = self.service_price;
            const arryQuestion = [...self.questionSet];
            for (const [key, value] of Object.entries({ ...arryQuestion })) {
                if (value[1].length != 0) {
                    value[1].questionsOption.map(opt =>
                        opt.checked == "true"
                            ? (total_price =
                                  total_price + parseInt(opt.option_price))
                            : (total_price = total_price + 0)
                    );
                }
            }
            return total_price;
        },
        get getQuestionAnswerSet() {
            let que = [];
            let answer = [];
            const arryQuestion = [...self.questionSet];
            for (const [key, value] of Object.entries({ ...arryQuestion })) {
                que.push(value[1].question);
                if (
                    value[1].question_type == "checkbox" ||
                    value[1].question_type == "radio"
                ) {
                    let option = [];
                    value[1].questionsOption.map(opt => {
                        if (opt.checked == "true") {
                            option.push(opt.option_title);
                            return null;
                        }
                    });
                    answer.push(option);
                } else if (value[1].question_type == "date") {
                    let option = [];
                    option.push(
                        new Date(self.service_preferred_date).toString()
                    );
                    answer.push(option);
                } else {
                    let option = [];
                    option.push(value[1].answer);
                    answer.push(option);
                }
            }
            let set = [];
            set[0] = que;
            set[1] = answer;
            return set;
        },
        get getServiceDate() {
            //return new Date(self.service_preferred_date).toString();
            //return new Date(self.service_preferred_date).toLocaleString();
            return self.service_preferred_date;
        },
        get getUserLoginState() {
            return self.log_in_state;
        },
        get getCurOrderVenId() {
            return self.current_order_vendor_id;
        },
        get getPaymentProcess() {
            return self.payment_process;
        }
    }));

export default RootStore;
