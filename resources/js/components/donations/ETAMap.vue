<template>
    <div class="row d-flex justify-content-center">
        <div class="col-md-8">
            <gmap-map
                :center="center"
                :zoom="12"
                style="width:100%;  height: 400px;"
            >
                <gmap-marker
                    :key="index"
                    v-for="(marker, index) in markers"
                    :position="marker.position"
                ></gmap-marker>
            </gmap-map>
        </div>
    </div>
</template>

<script>
export default {
    name: "ETAMap",
    props: ["donation"],
    mounted() {
        this.center = {
            lat: this.patient?.location.lat,
            lng: this.patient?.location.lng
        };
    },
    data() {
        return {
            center: { lat: 0.18702, lng: 5.55602 },
            donor: toCamelCase(_.cloneDeep(this.donation?.donor)),
            patient: toCamelCase(_.cloneDeep(this.donation?.patient))
        };
    },
    computed: {
        markers() {
            return [
                {
                    position: {
                        lat: this.donor?.location.lat,
                        lng: this.donor?.location.lng
                    },
                    title: "Donor location",
                    label: {
                        text: this.donor?.profile.fullName,
                        color: "black",
                        fontWeight: "bold",
                        fontSize: "12px"
                    }
                },
                {
                    position: {
                        lat: this.patient?.location.lat,
                        lng: this.patient?.location.lng
                    },
                    title: "Patient location",
                    label: {
                        text: this.patient?.profile.fullName,
                        color: "green",
                        fontWeight: "bold",
                        fontSize: "12px"
                    }
                }
            ];
        }
    }
};
</script>
