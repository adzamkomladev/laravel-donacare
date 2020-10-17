import { Auth, ProfileService } from "../../common/api.service";

const state = () => ({
    services: [],
    hospitals: {
        "Kaneshie Polyclinic": "Palace St, Accra",
        "Korle Bu Hospital": "Guggisberg Ave, Korlebu",
        "Amasaman Gen. Hospital": " Hospital Road, Amasaman, Amasaman",
        "Komfo Anokye Hospital": "Okomfo Anokye Road, Kumasi",
        "Holy Trinity Hospital": "Amar Koranten St, Accra",
        "Ridge Hospital": "Castle Rd, Accra"
    },
    donation: { prescriptions: [], quantity: 1, bloodGroup: "O+" }
});

const getters = {
    hospitalDetails(state) {
        return {
            hospitalName: state.donation.hospitalName,
            hospitalLocation: state.donation.hospitalLocation,
            shareLocation: state.donation.shareLocation,
            prescriptions: state.donation.prescriptions
        };
    },
    medicalDetails(state) {
        return {
            type: state.donation.type,
            value: state.donation.value,
            valueType: state.donation.valueType,
            serviceId: state.donation.serviceId,
            description: state.donation.description,
            quantity: state.donation.quantity
        };
    },
    paymentDetails(state) {
        return {
            paymentStatus: state.donation.paymentStatus,
            paymentMethod: state.donation.paymentMethod,
            cost: state.donation.cost
        };
    },
    hospitals(state) {
        return _.clone(state.hospitals);
    }
};

const mutations = {
    UPDATE_DONATION(state, { property, value }) {
        const profile = { ...state.profile };
        profile[property] = value;

        state.profile = { ...profile };
    },
    SET_PROFILE(state, profile) {
        state.profile = _.cloneDeep(profile);
    }
};

const actions = {
    async create({ state, commit }) {
        try {
            const { data } = await ProfileService.create(
                Auth.currentUser().id,
                _.clone(state.profile)
            );

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
