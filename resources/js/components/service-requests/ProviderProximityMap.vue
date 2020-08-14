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
            {{ selectedProvider }}
        </div>
    </div>
</template>

<script>
import Auth from "../../services/auth.js";

export default {
    name: "GoogleMap",
    props: ["allProviders"],
    data() {
        return {
            // default to Montreal to keep it simple
            // change this to whatever makes sense
            center: { lat: 45.508, lng: -73.587 },
            providers: this.allProviders,
            markers: [],
            places: [],
            currentPlace: null,
            selectedProvider: {}
        };
    },

    mounted() {
        this.geolocate();
    },

    methods: {
        // receives a place object via the autocomplete component
        setPlace(place) {
            this.currentPlace = place;
        },
        addMarker() {
            if (this.currentPlace) {
                const marker = {
                    lat: this.currentPlace.geometry.location.lat(),
                    lng: this.currentPlace.geometry.location.lng()
                };
                this.markers.push({ position: marker });
                this.places.push(this.currentPlace);
                this.center = marker;
                this.currentPlace = null;
            }
        },
        onClickMarker(index) {
            console.log(index);
            this.selectedProvider = this.providers[index];
        },
        geolocate: function() {
            this.center = {
                lat: Auth.currentUser().location.lat,
                lng: Auth.currentUser().location.lng
            };
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
