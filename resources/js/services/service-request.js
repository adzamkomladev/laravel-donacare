export default class ServiceRequest {
    static selectProvider(serviceRequestId, data) {
        return axios.patch(
            `/api/v1/service-requests/${serviceRequestId}/select-provider`,
            data
        );
    }
}