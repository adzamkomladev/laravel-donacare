export default class User {
    static toggleActivation(userId) {
        return axios.patch(`/api/v1/users/${userId}/toggle-activation`, {});
    }
}
