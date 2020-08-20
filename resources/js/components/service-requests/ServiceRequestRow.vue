<template>
    <transition name="fade">
        <tr v-if="canShow">
            <td class="text-left">{{ serviceRequest.service.name }}</td>
            <td class="text-left">{{ serviceRequest.service.price }}</td>
            <td class="text-left">{{ displayName }}</td>
            <td class="text-left">
                <span v-if="isLow" class="badge badge-pill badge-danger">
                    {{ serviceRequest.status }}
                </span>
                <span v-if="isMedium" class="badge badge-pill badge-info">
                    {{ serviceRequest.status }}
                </span>
                <span v-if="isHigh" class="badge badge-pill badge-success">
                    {{ serviceRequest.status }}
                </span>
            </td>
            <td class="td-actions text-left">
                <a
                    :href="showServiceRequestUrl"
                    class="btn btn-primary btn-round"
                >
                    View
                </a>
            </td>
        </tr>
    </transition>
</template>

<script>
import Auth from "../../services/auth";

export default {
    name: "ServiceRequestRow",
    props: ["rowServiceRequest"],
    data() {
        return {
            canShow: true,
            serviceRequest: this.rowServiceRequest
        };
    },
    computed: {
        showServiceRequestUrl() {
            return `/service-requests/${this.serviceRequest.id}`;
        },
        displayName() {
            const isDonor = Auth.currentUser().role === "donor";

            return isDonor
                ? this.serviceRequest.patient.profile.full_name
                : this.serviceRequest.donor.profile.full_name;
        },
        isLow() {
            return (
                this.serviceRequest.status === "incomplete" ||
                this.serviceRequest.status === "pending"
            );
        },
        isMedium() {
            return (
                this.serviceRequest.status === "assigned" ||
                this.serviceRequest.status === "initiated"
            );
        },
        isHigh() {
            return (
                this.serviceRequest.status === "done" ||
                this.serviceRequest.status === "completed"
            );
        }
    }
};
</script>
<style lang="scss" scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.8s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
    opacity: 0;
}
</style>
