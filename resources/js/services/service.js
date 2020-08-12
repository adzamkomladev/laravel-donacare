export default class Service {
    static toggleAvailability(serviceId) {
        return axios.patch(
            `/api/v1/services/${serviceId}/toggle-availability`,
            {}
        );
    }
}
