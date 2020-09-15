export default class Location {
    static save(data) {
        return axios.post(`/api/v1/locations`, data);
    }

    static findByUserId(userId) {
        return axios.get(`/api/v1/locations/${userId}`);
    }
}
