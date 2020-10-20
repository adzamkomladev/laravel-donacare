<template>
    <div>
        <GmapMap :center="{ lat: 0, lng: 0 }" ref="mapRef"></GmapMap>
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a
                    aria-expanded="false"
                    aria-haspopup="true"
                    class="nav-link dropdown-toggle"
                    data-toggle="dropdown"
                    id="navbarDropdownMenuLink"
                >
                    <i class="now-ui-icons health_ambulance"></i>
                    <p>
                        <span class="d-lg-none d-md-block" title="make request">
                            Make Request
                        </span>
                    </p>
                </a>
                <div
                    aria-labelledby="navbarDropdownMenuLink"
                    class="dropdown-menu dropdown-menu-right"
                >
                    <strong class="dropdown-item">
                        <i class="now-ui-icons media-2_sound-wave"></i>
                        <span> Make request</span>
                    </strong>
                    <button class="dropdown-item" id="ord">
                        <a
                            href="/donations/create?type=blood"
                            class="btn btn-round btn-primary col-md-4"
                        >
                            Blood
                        </a>
                        <a
                            href="/donations/create?type=organ"
                            class="btn btn-round btn-primary col-md-4"
                        >
                            Organ
                        </a>
                        <a
                            href="/donations/create?type=funds"
                            class="btn btn-round btn-primary col-md-4"
                        >
                            Funds
                        </a>
                    </button>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a
                    aria-expanded="false"
                    aria-haspopup="true"
                    class="nav-link dropdown-toggle"
                    data-toggle="dropdown"
                >
                    <i class="now-ui-icons design_bullet-list-67"></i>
                    <p>
                        <span class="d-lg-none d-md-block">
                            Incomming requests
                        </span>
                    </p>
                </a>
                <div
                    aria-labelledby="navbarDropdownMenuLink"
                    class="dropdown-menu dropdown-menu-right"
                >
                    <div class="dropdown-item" v-if="isEmpty">
                        <span>No items here</span>
                    </div>
                    <template v-else>
                        <strong class="dropdown-item">
                            <i class="now-ui-icons business_bulb-63"></i>
                            <span>Active request</span>
                        </strong>
                        <a
                            class="dropdown-item"
                            :href="getUrl(donation.id)"
                            v-for="donation in topFourDonations"
                            :key="donation.id"
                        >
                            <span>
                                {{ donation | activeRequestText }}
                            </span>
                        </a>
                    </template>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a
                    aria-expanded="false"
                    aria-haspopup="true"
                    class="nav-link dropdown-toggle"
                    data-toggle="dropdown"
                >
                    <i class="now-ui-icons location_pin"></i>
                    <p>
                        <span class="d-lg-none d-md-block">Active request</span>
                    </p>
                </a>
                <div
                    aria-labelledby="navbarDropdownMenuLink"
                    class="dropdown-menu dropdown-menu-right"
                >
                    <template v-if="!isEmpty && activeDonation">
                        <strong class="dropdown-item">
                            <i class="now-ui-icons location_map-big"></i>
                            <span class="text-danger">ETA</span>
                        </strong>
                        <a
                            v-for="(etaData, index) in eta"
                            :key="index"
                            class="dropdown-item"
                            href="#"
                        >
                            <i class="now-ui-icons location_pin"></i>
                            help for
                            <span class="text-success">{{
                                activeDonation.value
                            }}</span>
                            arrives in
                            <span class="text-danger">{{
                                etaData.duration
                            }}</span
                            >. Donor is
                            <span class="text-info">
                                {{ etaData.distance }} </span
                            >away. Donation from
                            <span class="text-secondary"
                                >{{ etaData.name }}
                            </span>
                        </a>
                    </template>
                    <div class="dropdown-item" v-else>
                        <span>No active request</span>
                    </div>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a
                    aria-expanded="false"
                    aria-haspopup="true"
                    class="nav-link dropdown-toggle"
                    data-toggle="dropdown"
                >
                    <i class="now-ui-icons education_paper"></i>
                    <p>
                        <span class="d-lg-none d-md-block">News Feeds</span>
                    </p>
                </a>
                <div
                    aria-labelledby="navbarDropdownMenuLink"
                    class="dropdown-menu dropdown-menu-right"
                >
                    <strong class="dropdown-item">
                        <i class="now-ui-icons location_bookmark"></i>
                        <span> News Feeds</span>
                    </strong>
                    <a class="dropdown-item" href="#">Feed 1</a>
                    <a class="dropdown-item" href="#">Feed 1</a>
                    <a class="dropdown-item" href="#">Feed 1</a>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
import { gmapApi } from "vue2-google-maps";

import ObtainCurrentLocation from "../auth/ObtainCurrentLocation";

import { Auth, LocationService } from "../../common/api.service";

export default {
    name: "PatientActions",
    props: ["userDonations"],
    async mounted() {
        this.$refs.mapRef.$mapPromise.then(map => {
            this.map = map;
            this.init();
        });
        await this.pollEta();
    },
    beforeDestroy() {
        clearInterval(this.polling);
    },
    data() {
        return {
            eta: [],
            polling: null,
            map: null
        };
    },
    methods: {
        init() {
            new this.google.maps.Marker({
                position: {
                    lat: 0,
                    lng: 0
                },
                map: this.map
            });
        },
        getUrl(donationId) {
            return `/donations/${donationId}`;
        },
        async durationToDestination(donationDonor) {
            const [currentLocation, targetLocation] = await Promise.all([
                LocationService.findByUserId(Auth.currentUser().id),
                LocationService.findByUserId(donationDonor.userId)
            ]);
            // const origin = new gmapApi.LatLng(
            //     currentLocation.data.lat,
            //     currentLocation.data.lng
            // ); // using google.maps.LatLng class

            const origin =
                currentLocation.data.lat + ", " + currentLocation.data.lng; // using string

            const destination =
                targetLocation.data.lat + ", " + targetLocation.data.lng; // using string

            const directionsService = new this.google.maps.DirectionsService();
            const request = {
                origin: origin, // LatLng|string
                destination: destination, // LatLng|string
                travelMode: this.google.maps.DirectionsTravelMode.WALKING
            };

            directionsService.route(request, (response, status) => {
                if (status === "OK") {
                    const point = response.routes[0].legs[0];
                    this.eta.push({
                        distance: point.distance.text,
                        duration: point.duration.text,
                        donor: "My name is donor"
                    });
                }
            });
        },
        async obtainEtaInformation() {
            const donation = this.activeDonation;

            if (donation) {
            console.log("donors", donation.donationDonors);
                this.eta = [];
                donation.donationDonors.forEach(
                    async donationDonor =>
                        await this.durationToDestination(donationDonor)
                );
            }
        },
        async pollEta() {
            await this.obtainEtaInformation();

            this.polling = setInterval(async () => {
                await this.obtainEtaInformation();
            }, 60000);
        }
    },
    computed: {
        isEmpty() {
            return !this.userDonations || !this.userDonations.length;
        },
        topFourDonations() {

            return this.userDonations.slice(0, 4);
        },
        activeDonation() {
            console.log(this.topFourDonations);
            const [donation] = this.topFourDonations.filter(
                donation => donation?.donationDonors.length > 0
            );
            return donation;
        },
        google: gmapApi
    },
    filters: {
        activeRequestText(donation) {
            const typeName =
                donation.type === "blood" ? "Blood Group" : "Organ";
            return `(${typeName} ${donation?.value}) - ${donation?.quantity} bag(s)`;
        }
    }
};
</script>

<style lang="scss" scoped>
@media only screen and (max-width: 768px) {
    #ord {
        display: flex;
        flex-direction: column;
    }
}
</style>
