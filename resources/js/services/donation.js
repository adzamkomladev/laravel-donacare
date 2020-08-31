export default class Donation {
    static selectDonor(donationId, data) {
        return axios.patch(
            `/api/v1/donations/${donationId}/select-donor`,
            data
        );
    }

    static deselectDonor(donationId, data) {
        return axios.patch(
            `/api/v1/donations/${donationId}/deselect-donor`,
            data
        );
    }

    static updateStatus(donationId, data) {
        return axios.patch(
            `/api/v1/donations/${donationId}/update-status`,
            data
        );
    }

    static donationWithinJurisdiction(jurisdiction = null) {
        let url = "/api/v1/donations";

        if (jurisdiction) {
            url += "?jurisdiction=" + jurisdiction;
        }

        return axios.get(url);
    }

    static userDonations(userId) {
        return axios.get(`/api/v1/users/${userId}/donations`);
    }

    static save(data) {
        return axios.post("/api/v1/donations", data, {
            headers: { "content-type": "multipart/form-data" }
        });
    }
}
