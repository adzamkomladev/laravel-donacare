export const Auth = {
    currentUser() {
        return window.authState.user || {};
    }
};

export const ComplaintService = {
    update(complaintId, data) {
        return axios.put(`/api/v1/complaints/${complaintId}`, data);
    }
};

export const DonationService = {
           selectDonor(data) {
               return axios.post("/api/v1/donation-donors", data);
           },

           deselectDonor(donationDonorId) {
               return axios.delete(
                   `/api/v1/donation-donors/${donationDonorId}`
               );
           },

           updateStatus(donationId, data) {
               return axios.patch(
                   `/api/v1/donations/${donationId}/update-status`,
                   data
               );
           },

           donationWithinJurisdiction(jurisdiction = null) {
               let url = "/api/v1/donations";

               if (jurisdiction) {
                   url += "?jurisdiction=" + jurisdiction;
               }

               return axios.get(url);
           },

           userDonations(userId) {
               return axios.get(`/api/v1/users/${userId}/donations`);
           },

           save(data) {
               return axios.post("/api/v1/donations", data, {
                   headers: { "content-type": "multipart/form-data" }
               });
           }
       };

export const LocationService = {
    save(data) {
        return axios.post(`/api/v1/locations`, data);
    },

    findByUserId(userId) {
        return axios.get(`/api/v1/locations/${userId}`);
    },

    async currentLocation() {
        let location;

        navigator.geolocation.getCurrentPosition(position => {
            location = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
        });

        return location;
    }
};

export const NotificationService = {
    newDonations(user_id) {
        return axios.get(`/api/v1/notifications/donations/${user_id}/new`);
    }
};

export const ProfileService = {
    create(userId, data) {
        return axios.post("/api/v1/profiles/user/" + userId, data);
    },

    update(profileId, data) {
        return axios.patch(`/api/v1/profiles/${profileId}`, data);
    },

    updateJurisdiction(profileId, data) {
        return axios.patch(`/api/v1/profile-jurisdictions/${profileId}`, data);
    }
};

export const Service = {
    toggleAvailability(serviceId) {
        return axios.patch(
            `/api/v1/services/${serviceId}/toggle-availability`,
            {}
        );
    },

    update(serviceId, data) {
        return axios.put(`/api/v1/services/${serviceId}`, data);
    }
};

export const SettingService = {
    create(data) {
        return axios.post("/api/v1/settings", data);
    },
    current() {
        return axios.get("/api/v1/settings/current");
    }
};

export const UserService = {
    toggleActivation(userId) {
        return axios.patch(`/api/v1/users/${userId}/toggle-activation`, {});
    }
};

export const HospitalService = {
    findAll() {
        return axios.get("/api/v1/all-hospitals");
    },
    create(data) {
        return axios.post("/api/v1/hospitals", data);
    }
};
