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
    static serviceRequestWithinJurisdiction(jurisdiction=null) {
        let url = '/api/v1/service-requests';

        if (jurisdiction) {
            url += '?jurisdiction='+jurisdiction;
        }

        return axios.get(url);
    }

    static userServiceRequests(userId) {
        return axios.get(
            `/api/v1/users/${userId}/service-requests`,
        );
    }
}
