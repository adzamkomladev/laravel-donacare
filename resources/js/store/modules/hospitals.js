import { HospitalService, LocationService } from "../../common/api.service";

const state = () => ({
    hospitals: [],
    hospital: {},
    suggestedHospitals: {
        "Kaneshie Polyclinic": "Palace St, Accra",
        "Korle Bu Hospital": "Guggisberg Ave, Korlebu",
        "Amasaman Gen. Hospital": " Hospital Road, Amasaman, Amasaman",
        "Komfo Anokye Hospital": "Okomfo Anokye Road, Kumasi",
        "Holy Trinity Hospital": "Amar Koranten St, Accra",
        "Ridge Hospital": "Castle Rd, Accra"
    }
});

const getters = {
    hospital(state) {
        return _.clone(state.hospital);
    },
    hospitals(state) {
        return _.cloneDeep(state.hospitals);
    },
    suggestedHospitals(state) {
        return _.clone(state.suggestedHospitals);
    }
};

const mutations = {
    SET_HOSPITALS(state, hospitals) {
        state.hospitals = _.cloneDeep(hospitals);
    },
    SET_HOSPITAL(state, hospital) {
        state.hospital = _.cloneDeep(hospital);
    },
    UPDATE_HOSPITAL(state, { property, value }) {
        const hospital = _.cloneDeep(state.hospital);
        hospital[property] = value;

        state.hospital = hospital;
    },
    UPDATE_HOSPITALS(state, hospital) {
        const hospitals = [
            _.cloneDeep(hospital),
            ..._.cloneDeep(state.hospitals)
        ];

        state.hospitals = hospitals;
    }
};

const actions = {
    async initializeState({ state, commit }) {
        try {
            const { data } = await HospitalService.findAll();
            commit("SET_HOSPITALS", data);

            navigator.geolocation.getCurrentPosition(position => {
                commit("UPDATE_HOSPITAL", {
                    property: "lng",
                    value: position.coords.longitude || 0.0
                });
                commit("UPDATE_HOSPITAL", {
                    property: "lat",
                    value: position.coords.latitude || 0.0
                });
            });
        } catch (error) {
            console.log({ error }, "Hey");
        }
    },
    async create({ state, commit }) {
        try {
            const hospital = _.clone(state.hospital);

            const { data } = await HospitalService.create(hospital);
            console.log(data);
            commit("UPDATE_HOSPITALS", data);
            commit("SET_HOSPITAL", {});
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
