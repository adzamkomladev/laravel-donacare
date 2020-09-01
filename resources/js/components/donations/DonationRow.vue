<template>
    <transition name="fade">
        <tr v-if="canShow">
            <td class="text-left">{{ donation.value }}</td>
            <td class="text-left">{{ displayName }}</td>
            <td class="text-left">
                <span v-if="isLow" class="badge badge-pill badge-danger">
                    {{ donation.status }}
                </span>
                <span v-if="isMedium" class="badge badge-pill badge-info">
                    {{ donation.status }}
                </span>
                <span v-if="isHigh" class="badge badge-pill badge-success">
                    {{ donation.status }}
                </span>
            </td>
            <td>
                {{ donation.created_at | formatDate }}
            </td>
            <td class="td-actions text-left">
                <a :href="showDonationUrl" class="btn btn-primary btn-round">
                    View
                </a>
            </td>
        </tr>
    </transition>
</template>

<script>
import Auth from "../../services/auth";

export default {
    name: "DonationRow",
    props: ["rowDonation"],
    data() {
        return {
            canShow: true,
            donation: this.rowDonation
        };
    },
    computed: {
        showDonationUrl() {
            return `/donations/${this.donation.id}`;
        },
        displayName() {
            const isDonor = Auth.currentUser().role === "donor";

            return isDonor
                ? this.donation.patient?.profile?.full_name
                : this.donation.donor?.profile?.full_name;
        },
        isLow() {
            return (
                this.donation.status === "incomplete" ||
                this.donation.status === "pending"
            );
        },
        isMedium() {
            return (
                this.donation.status === "assigned" ||
                this.donation.status === "initiated"
            );
        },
        isHigh() {
            return (
                this.donation.status === "done" ||
                this.donation.status === "completed"
            );
        },
        donationCost() {
            return this.donation.payment_status === "free"
                ? 0.0
                : this.donation.cost || "N/A";
        }
    },
    filters: {
        formatDate(date) {
            return new Date(date)
                .toISOString()
                .replace(/T.*/, "")
                .split("-")
                .join("-");
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
