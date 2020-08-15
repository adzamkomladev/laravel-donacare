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
                    v-for="(m, index) in providersMarkers"
                    :position="m.position"
                    @click="onClickMarker(index)"
                    :clickable="true"
                ></gmap-marker>
            </gmap-map>
        </div>
        <div class="col-md-4">
            <UserDetailsCard v-if="selectedProvider" :user="selectedProvider" />
            <button
                v-if="selectedProvider"
                @click.prevent="onSelectProvider"
                class="btn btn-primary btn-round mt-3"
            >
                Select provider
            </button>
        </div>
    </div>
</template>

<script>
import UserDetailsCard from "../../components/users/UserDetailsCard.vue";

import Auth from "../../services/auth";
import ServiceRequest from "../../services/service-request";

export default {
    name: "GoogleMap",
    components: { UserDetailsCard },
    props: ["allProviders", "serviceRequest"],
    data() {
        return {
            center: { lat: 0.18702, lng: 5.55602 },
            providers: this.allProviders,
            selectedProvider: null
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
            this.selectedProvider = {
                ...this.providers[index],
                profile: { ...this.providers[index].profile },
                location: { ...this.providers[index].location }
            };
        },
        geolocate() {
            this.center = {
                lat: Auth.currentUser().location.lat,
                lng: Auth.currentUser().location.lng
            };
        },
        async onSelectProvider() {
            try {
                await ServiceRequest.selectProvider(this.serviceRequest.id, {
                    provider_id: this.selectedProvider.id
                });

                this.showNotification(
                    "fas fa-check",
                    "You have selected a provider!",
                    "primary"
                );
            } catch (error) {
                const errors = error?.response?.data?.errors;

                const [message] = Object.values(errors || {})[0] || [
                    "Failed to select provider! Try again."
                ];

                this.showNotification("fas fa-times", message, "danger");
            }
        }
    },
    computed: {
        providersMarkers() {
            return this.providers.map(provider => ({
                position: {
                    lat: provider.location.lat,
                    lng: provider.location.lng
                }
            }));
        }
    }
};
</script>
