export default class Complaint {
    static update(complaintId, data) {
        return axios.put(`/api/v1/complaints/${complaintId}`, data);
    }
}
