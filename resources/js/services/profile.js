export default class Profile {
    static update(profileId, data) {
        return axios.patch(`/api/v1/profiles/${profileId}`, data);
    }

    static updateJurisdiction(profileId, data) {
        return axios.patch(`/api/v1/profiles/${profileId}/jurisdiction`, data);
    }
}
