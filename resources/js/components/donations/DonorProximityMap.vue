<template>
    <div class="row">
        <div class="col-md-8">
            <gmap-map
                :center="center"
                :zoom="12"
                style="width:100%;  height: 400px;"
            >
                <gmap-marker
                    :key="index"
                    v-for="(m, index) in donorsMarkers"
                    :position="m.position"
                    @click="onClickMarker(index)"
                    :clickable="true"
                ></gmap-marker>
            </gmap-map>
        </div>
        <div class="col-md-4">
            <UserDetailsCard v-if="selectedDonor" :user="selectedDonor" />
            <button
                v-if="selectedDonor"
                @click.prevent="onSelectDonor"
                class="btn btn-primary btn-round mt-3"
            >
                Select donor
            </button>
        </div>
    </div>
</template>

<script>
import UserDetailsCard from "../../components/users/UserDetailsCard.vue";

import Auth from "../../services/auth";
import Donation from "../../services/donation";

export default {
    name: "GoogleMap",
    components: { UserDetailsCard },
    props: ["allDonors", "donation"],
    data() {
        return {
            center: { lat: 0.18702, lng: 5.55602 },
            donors: this.allDonors,
            selectedDonor: null
        };
    },

    mounted() {
        this.geolocate();
    },

    methods: {
        showNotification(icon, message, type) {
            $.notify({ icon, message }, { type, timer: 3000 });
        },

        onClickMarker(index) {
            this.selectedDonor = {
                ...this.donors[index],
                profile: { ...this.donors[index].profile },
                location: { ...this.donors[index].location }
            };
        },
        geolocate() {
            this.center = {
                lat: Auth.currentUser().location.lat,
                lng: Auth.currentUser().location.lng
            };
        },
        async onSelectDonor() {
            try {
                await Donation.selectDonor(this.donation.id, {
                    donor_id: this.selectedDonor.id
                });

                this.showNotification(
                    "fas fa-check",
                    "You have selected a donor!",
                    "primary"
                );
            } catch (error) {
                const errors = error?.response?.data?.errors;

                const [message] = Object.values(errors || {})[0] || [
                    "Failed to select donor! Try again."
                ];

                this.showNotification("fas fa-times", message, "danger");
            }
        }
    },
    computed: {
        donorsMarkers() {
            return this.donors.map(donor => ({
                position: {
                    lat: donor.location.lat,
                    lng: donor.location.lng
                }
            }));
        }
    }
};
</script>
