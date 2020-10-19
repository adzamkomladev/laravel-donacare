import { Auth, ProfileService } from "../../common/api.service";

const state = () => ({
    profile: { gender: "male", role: "patient", bloodGroup: "O+" }
});

const getters = {
    personalDetails(state) {
        return {
            firstName: state.profile.firstName,
            lastName: state.profile.lastName,
            otherNames: state.profile.otherNames,
            gender: state.profile.gender
        };
    },
    medicalDetails(state) {
        return {
            role: state.profile.role,
            bloodGroup: state.profile.bloodGroup,
            medicalDetails: state.profile.medicalDetails
        };
    },
    contactDetails(state) {
        return {
            mobileMoneyName: state.profile.mobileMoneyName,
            mobileMoneyNumber: state.profile.mobileMoneyNumber,
            homeAddress: state.profile.homeAddress,
            email: state.profile.email
        };
    },
    isMale(state) {
        return state.profile.gender === "male";
    },
    isPatient(state) {
        return state.profile.role === "patient";
    }
};

const mutations = {
    UPDATE_PROFILE(state, { property, value }) {
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
