export default class Complaint {
    static update(serviceId, data) {
        return axios.put(`/api/v1/complaints/${complaint}`, data);
    }
}
