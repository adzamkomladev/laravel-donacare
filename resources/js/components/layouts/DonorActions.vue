<template>
    <div>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link">
                    <p>
                        <span class="d-lg-none d-md-block">Stats</span>
                    </p>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a
                    class="nav-link dropdown-toggle"
                    id="navbarDropdownMenuLink"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                >
                    <i class="now-ui-icons media-1_button-power"></i>
                    <p>
                        <span class="d-lg-none d-md-block">visibility</span>
                    </p>
                </a>
                <div
                    class="dropdown-menu dropdown-menu-right"
                    aria-labelledby="navbarDropdownMenuLink"
                >
                    <!-- <a class="dropdown-item" unction()">Toggle online/offline</a> -->
                    <button
                        class="dropdown-item"
                        id="tgl"
                        onclick="togglefunction()"
                    >
                        Toggle online/offline
                    </button>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a
                    class="nav-link dropdown-toggle"
                    id="navbarDropdownMenuLink"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                >
                    <i class="now-ui-icons ui-1_bell-53"></i>
                    <p>
                        <span class="d-lg-none d-md-block">visibility</span>
                    </p>
                </a>
                <div
                    class="dropdown-menu dropdown-menu-right"
                    aria-labelledby="navbarDropdownMenuLink"
                >
                    <div class="dropdown-item" v-if="isNotificationsEmpty">
                        <span>No items here</span>
                    </div>

                    <template v-else>
                        <strong
                            v-for="notification in notificationsToDisplay"
                            class="dropdown-item"
                            :key="notification.id"
                        >
                            <button
                                @click.prevent="
                                    onAddToDonorDonations(notification)
                                "
                                id="ad"
                                class="now-ui-icons ui-1_simple-add"
                            ></button>
                            <span>{{
                                notification.data.donation | donationText
                            }}</span>
                        </strong>
                    </template>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a
                    class="nav-link dropdown-toggle"
                    id="navbarDropdownMenuLink"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                >
                    <i class="now-ui-icons shopping_cart-simple"></i>
                    <p>
                        <span class="d-lg-none d-md-block">visibility</span>
                    </p>
                </a>
                <div
                    class="dropdown-menu dropdown-menu-right"
                    aria-labelledby="navbarDropdownMenuLink"
                >
                    <div class="dropdown-item" v-if="isMyDonationsEmpty">
                        <span>No items here</span>
                    </div>

                    <template v-else>
                        <strong
                            v-for="donation in myDonationsToDisplay"
                            class="dropdown-item"
                            :key="donation.id"
                        >
                            <button
                                @click.prevent="
                                    onRemoveFromDonorDonations(donation)
                                "
                                id="rm"
                                class="now-ui-icons ui-1_simple-delete"
                            ></button>
                            <span>{{ donation | donationText }}</span>
                            <br />
                            <button class="dropdown-item" id="ord">
                                <a
                                    :href="getUrl(donation.id)"
                                    id="ordd"
                                    class="btn btn-round btn-primary col-lg-4"
                                    title="click to view profile"
                                    >details</a
                                >
                                <a
                                    id="ordd"
                                    class="btn btn-round btn-primary col-lg-4"
                                    >map</a
                                >
                                <a
                                    id="ordd"
                                    class="btn btn-round btn-primary col-lg-4"
                                    >payments</a
                                >
                            </button>
                        </strong>
                    </template>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
import Donation from "../../services/donation";
import Notification from "../../services/notification";
import Auth from "../../services/auth";

export default {
    name: "DonorActions",
    props: ["userDonations"],
    async mounted() {
        this.pollNotifications();
    },
    beforeDestroy() {
        clearInterval(this.polling);
    },
    data() {
        return {
            user: Auth.currentUser(),
            notifications: [],
            polling: null
        };
    },
    methods: {
        async getNotifications() {
            const user_id = this.user.id;
            const { data } = await Notification.newDonations(user_id);

            console.log(data, "Polled notifications");

            this.notifications = data || [];
        },
        async pollNotifications() {
            await this.getNotifications();

            this.polling = setInterval(async () => {
                await this.getNotifications();
            }, 60000);
        },
        getUrl(donationId) {
            return `/donations/${donationId}`;
        },
        async onAddToDonorDonations(notification) {
            const { donation } = notification.data;

            try {
                const { data } = await Donation.selectDonor(donation.id, {
                    donor_id: this.user.id
                });

                this.userDonations.push(data);

                this.notifications = this.notifications.filter(
                    myNotification => myNotification.id !== notification.id
                );

                this.showNotification(
                    "fas fa-check",
                    "Donation request has been added!",
                    "primary"
                );
            } catch (error) {
                this.showNotification(
                    "fas fa-times",
                    "Failed to add donation request, It is either taken or unavailable!",
                    "danger"
                );
            }
        },
        async onRemoveFromDonorDonations(donation) {
            try {
                const { data } = await Donation.deselectDonor(donation.id, {
                    donor_id: this.user.id
                });

                this.userDonations = this.userDonations.filter(
                    myDonation => myDonation.id !== donation.id
                );

                this.$emit("removeDonation");

                this.showNotification(
                    "fas fa-check",
                    "Donation request has been removed!",
                    "primary"
                );
            } catch (error) {
                this.showNotification(
                    "fas fa-times",
                    "Failed to remove donation request",
                    "danger"
                );
            }
        },
        showNotification(icon, message, type) {
            $.notify({ icon, message }, { type, timer: 2500 });
        }
    },
    computed: {
        isNotificationsEmpty() {
            return !this.notifications || !this.notifications.length;
        },
        isMyDonationsEmpty() {
            console.log('How is this possilbe', this.userDonations);
            return !this.userDonations || !this.userDonations.length;
        },
        myDonationsToDisplay() {
            return (
                this.userDonations.filter(
                    donation => donation.status === "assigned"
                ) || []
            );
        },
        notificationsToDisplay() {
            return (
                this.notifications.filter(
                    notification =>
                        notification.data.donation.status === "initiated"
                ) || []
            );
        }
    },
    filters: {
        donationText(donation) {
            const patientName = donation.patient?.profile?.first_name;
            const serviceType = donation.type;
            const hospitalName = donation.hospital_name;
            const value = donation.value;
            const patientBloodType = donation.patient?.profile?.blood_group;

            return `${patientName} needs ${serviceType} (${value}) ${patientBloodType} @${hospitalName}`;
        }
    }
};
</script>

<style></style>
