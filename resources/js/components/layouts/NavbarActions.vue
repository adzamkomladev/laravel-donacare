<template>
    <div>
        <PatientActions v-if="isPatient" />
        <DonorActions v-if="isDonor" />
    </div>
</template>

<script>
import Auth from "../../services/auth";

import PatientActions from "./PatientActions";
import DonorActions from "./DonorActions";

export default {
    name: "NavbarActions",
    components: { PatientActions, DonorActions },
    data() {
        return {
            currentUser: Auth.currentUser()
        };
    },
    computed: {
        isPatient() {
            return this.currentUser.role === "patient";
        },
        isDonor() {
            return this.currentUser.role === "donor";
        }
    }
};
</script>

<style></style>
