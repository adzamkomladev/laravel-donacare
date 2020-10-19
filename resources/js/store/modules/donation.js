import {
    Auth,
    DonationService,
    SettingService
} from "../../common/api.service";

const toCamelCase = obj => {
    const traverseArr = arr => {
        arr.forEach(v => {
            if (v) {
                if (v.constructor === Object) {
                    this.toCamelCase(v);
                } else if (v.constructor === Array) {
                    traverseArr(v);
                }
            }
        });
    };

    Object.keys(obj).forEach(k => {
        if (obj[k]) {
            if (obj[k].constructor === Object) {
                this.toCamelCase(obj[k]);
            } else if (obj[k].constructor === Array) {
                traverseArr(obj[k]);
            }
        }

        const sck = _.camelCase(k);
        if (sck !== k) {
            obj[sck] = obj[k];
            delete obj[k];
        }
    });

    return obj;
};

const state = () => ({
    settings: {},
    service: {},
    hospitals: {
        "Kaneshie Polyclinic": "Palace St, Accra",
        "Korle Bu Hospital": "Guggisberg Ave, Korlebu",
        "Amasaman Gen. Hospital": " Hospital Road, Amasaman, Amasaman",
        "Komfo Anokye Hospital": "Okomfo Anokye Road, Kumasi",
        "Holy Trinity Hospital": "Amar Koranten St, Accra",
        "Ridge Hospital": "Castle Rd, Accra"
    },
    bloodGroups: [
        { name: "O positive", value: "O+" },
        { name: "O negative", value: "O-" },
        { name: "A positive", value: "A+" },
        { name: "A negative", value: "A-" },
        { name: "AB positive", value: "AB+" },
        { name: "AB negative", value: "AB-" },
        { name: "B positive", value: "B+" },
        { name: "B negative", value: "B-" }
    ],
    bloodTypes: [
        "Whole blood donation",
        "Power red donation",
        "Platelet donation",
        "Plasma donation"
    ],
    donation: { type: "blood", prescriptions: [], quantity: 1 }
});

const getters = {
    hospitalDetails(state) {
        return {
            hospitalName: state.donation.hospitalName,
            hospitalLocation: state.donation.hospitalLocation,
            shareLocation: state.donation.shareLocation,
            prescriptions: [...state.donation.prescriptions],
            dateNeeded: state.donation.dateNeeded
        };
    },
    medicalDetails(state) {
        return {
            type: state.donation.type,
            value: state.donation.value,
            valueType: state.donation.valueType,
            description: state.donation.description,
            quantity: state.donation.quantity
        };
    },
    paymentDetails(state) {
        return {
            paymentStatus: state.donation.paymentStatus,
            paymentMethod: state.donation.paymentMethod,
            cost: (state.donation.cost / 100.0).toFixed(2)
        };
    },
    hospitals(state) {
        return _.clone(state.hospitals);
    },
    bloodGroups(state) {
        return _.cloneDeep(state.bloodGroups);
    },
    bloodTypes(state) {
        return _.clone(state.bloodTypes);
    },
    servicePrice(state) {
        return (state.service?.price / 100.0).toFixed(2);
    }
};

const mutations = {
    UPDATE_DONATION(state, { property, value }) {
        const donation = _.cloneDeep(state.donation);
        donation[property] = value;

        state.donation = donation;
    },
    UPDATE_DONATION_PRESCRIPTIONS(state, files) {
        const donation = _.cloneDeep(state.donation);
        donation.prescriptions = Array.from(files);

        state.donation = donation;
    },
    UPDATE_DONATION_HOSPITAL(state, value) {
        const donation = _.cloneDeep(state.donation);
        donation.hospitalName = value;
        donation.hospitalLocation = state.hospitals[value];

        state.donation = donation;
    },
    UPDATE_COST(state) {
        const donation = _.cloneDeep(state.donation);
        const amount = donation.quantity * state.service.price;
        const percentageAmount =
            amount * (state.settings.percentageCharge / 100.0);
        donation.cost = amount + percentageAmount + state.settings.systemCharge;
        console.log({ amount, percentageAmount, donationCost: donation.cost });
        state.donation = donation;
    },
    SET_SETTINGS(state, settings) {
        state.settings = _.cloneDeep(settings);
    },
    SET_SERVICE(state, service) {
        state.service = _.cloneDeep(service);
    },
    SET_DONATION(state, donation) {
        state.donation = _.cloneDeep(donation);
    }
};

const actions = {
    async initializeState({ state, commit }, service) {
        try {
            const { data } = await SettingService.current();
            const settings = toCamelCase(JSON.parse(data.data));
            commit("SET_SETTINGS", settings);
        } catch (error) {
            console.log({ error }, "Hey");
        }

        commit("SET_DONATION", {
            type: "blood",
            serviceId: service.id,
            value: Auth.currentUser().profile.blood_group,
            valueType: "Whole blood donation",
            quantity: 1,
            prescriptions: [],
            shareLocation: 1
        });

        commit("SET_SERVICE", service);
    },
    async create({ state, commit }) {
        const formData = new FormData();

        for (let key in state.donation) {
            if (key === "prescriptions") {
                continue;
            }
            formData.append(_.snakeCase(key), state.donation[key]);
        }

        Array.from(state.donation.prescriptions).forEach(prescription =>
            formData.append("images[]", prescription)
        );
        formData.append("user_id", Auth.currentUser().id);

        try {
            const { data } = await DonationService.save({
                doNotUseInterceptors: true,
                formData
            });

            commit("SET_PROFILE", data);
        } catch (error) {
            throw error;
        }
    }
};

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
};
