<template>
    <div>
        <PatientActions
            :service-requests="userServiceRequests"
            v-if="isPatient"
        />
        <DonorActions
            :user-service-requests="userServiceRequests"
            v-if="isDonor"
        />
    </div>
</template>

<script>
import PatientActions from "./PatientActions";
import DonorActions from "./DonorActions";

import Auth from "../../services/auth";
import ServiceRequest from "../../services/service-request";

export default {
    name: "NavbarActions",
    components: { PatientActions, DonorActions },
    async mounted() {
        await this.getUserServiceRequests();
    },
    data() {
        return {
            currentUser: Auth.currentUser(),
            userServiceRequests: []
        };
    },
    methods: {
        async getUserServiceRequests() {
            try {
                const { data } = await ServiceRequest.userServiceRequests(
                    this.currentUser.id
                );
                this.userServiceRequests = data;
                console.log({ data });
            } catch (error) {
                console.log({ error });
            }
        }
    },
    computed: {
        isPatient() {
            console.log(this.currentUser);
            return this.currentUser.role === "patient";
        },
        isDonor() {
            return this.currentUser.role === "donor";
        }
    }
};
</script>

<style></style>
