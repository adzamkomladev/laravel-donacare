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
                    >
                        <button
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
                        v-for="donation in donationsToDisplay"
                        class="dropdown-item"
                        id=""
                    >
                        <button
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

export default {
    name: "DonorActions",
    props: ["userDonations"],
    async onMounted() {
        await this.initializeDonations();
    },
    data() {
        return {
            myDonations: this.userDonations,
            donations: []
        };
    },
    method: {
        async initializeDonations() {
            const { data } = await Donation.all();

            this.donations = data;
        },
        onAddToDonorDonations(donation) {
            console.log(donation, "addtodonorrequest");
        },
        onRemoveFromDonorDonations(donation) {
            console.log(donation, "removefromdonorrequest");
        }
    },
    computed: {
        myDonationsToDisplay() {
            return this.myDonations
                .filter(donation => donation.status === "assigned")
                .sort((a, b) => {
                    const dateA = new Date(a.updated_at);
                    const dateB = new Date(b.updated_at);

                    if (a < b) return -1;

                    if (a > b) return 1;

                    return 0;
                });
        },
        donationsToDisplay() {
            return this.donations
                .filter(donation => donation.status === "requested")
                .sort((a, b) => {
                    const dateA = new Date(a.updated_at);
                    const dateB = new Date(b.updated_at);

                    if (a < b) return -1;

                    if (a > b) return 1;

                    return 0;
                });
        }
    },
    filters: {
        donationText(donation) {
            const patientName = donation.patient.profile.first_name;
            const serviceType = donation.service.name;
            const hospitalName = donation.hospital_name;
            const value = donation.value;
            const patientBloodType = donation.patient.profile.bloodType;

            return `${patientName} needs ${serviceType} (${value}) ${patientBloodType} @${hospitalName}`;
        }
    }
};
</script>

<style></style>
