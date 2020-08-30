export default class Complaint {
    static newDonations(user_id) {
        return axios.get(`/api/v1/notifications/donations/${user_id}/new`);
    }
}
