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
                    <strong
                        v-for="donation in donationsToDisplay"
                        class="dropdown-item"
                        :key="donation.id"
                    >
                        <button
                            @click.prevent="onAddToDonorDonations(donation)"
                            id="ad"
                            class="now-ui-icons ui-1_simple-add"
                        ></button>
                        <span>{{ donation | donationText }}</span>
                    </strong>
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
        const user_id = this.user.id;
        const { data } = await Notification.newDonations(user_id);

        this.notifications = data || [];
        this.donations = this.notifications.map(
            notification => notification.data.donation
        );
    },
    data() {
        return {
            user: Auth.currentUser(),
            myDonations: this.userDonations,
            donations: [],
            notifications: []
        };
    },
    methods: {
        async onAddToDonorDonations(donation) {
            try {
                const { data } = await Donation.selectDonor(donation.id, {
                    donor_id: this.user.id
                });

                console.log(data, "success");
                this.myDonations.push(data);

                this.donations = this.donations.filter(
                    myDonation => myDonation.id !== donation.id
                );
            } catch (error) {
                const { data } = error;

                console.log(error, "failed");
            }
        },
        async onRemoveFromDonorDonations(donation) {
            try {
                const { data } = await Donation.deselectDonor(donation.id, {
                    donor_id: this.user.id
                });

                console.log(data, "success");

                this.myDonations = this.myDonations.filter(
                    myDonation => myDonation.id !== donation.id
                );
            } catch (error) {
                const { data } = error;

                console.log(error, "failed");
            }
        }
    },
    computed: {
        myDonationsToDisplay() {
            return (
                this.myDonations.filter(
                    donation => donation.status === "assigned"
                ) || []
            );
        },
        donationsToDisplay() {
            return (
                this.donations.filter(
                    donation => donation.status === "initiated"
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
