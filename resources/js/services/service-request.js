export default class ServiceRequest {
    static selectDonor(serviceRequestId, data) {
        return axios.patch(
            `/api/v1/service-requests/${serviceRequestId}/select-donor`,
            data
        );
    }
    static updateStatus(serviceRequestId, data) {
        return axios.patch(
            `/api/v1/service-requests/${serviceRequestId}/update-status`,
            data
        );
    }
}
