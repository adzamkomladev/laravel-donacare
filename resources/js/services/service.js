export default class Service {
    static toggleAvailability(serviceId) {
        return axios.patch(
            `/api/v1/services/${serviceId}/toggle-availability`,
            {}
        );
    }

    static update(serviceId, data) {
        return axios.put(`/api/v1/services/${serviceId}`, data);
    }
}
