<template>
    <div class="row">
        <p class="text-center" v-if="isEmpty">
            Found no donor match!!
            <button @click.prevent="onReset()" class="btn btn-primary btn-round">Reset search</button>
        </p>
        <template v-else>
            <div
                v-for="donor in donors"
                :key="donor.id"
                class="font-icon-list col-lg-2 col-md-3 col-sm-4 col-xs-6 col-xs-6"
            >
                <div class="font-icon-detail">
                    <i class="now-ui-icons users_single-02"></i>
                    <p>
                        <a
                            :href="donor | donorUrl"
                            class="btn btn-round btn-primary"
                            >{{ donor.profile.fullName }}</a
                        >
                    </p>
                </div>
            </div>
        </template>
    </div>
</template>

<script>
import { eventBus } from "../../events/event-bus";

export default {
    name: "DisplayDonors",
    props: ["allDonors"],
    mounted() {
        eventBus.$on("searchText", searchText => {
            this.donors = this.donors.filter(donor =>
                donor.profile.fullName.includes(searchText)
            );
        });
    },
    data() {
        return {
            donors: this.allDonors.map(donor => this.toCamelCase(donor))
        };
    },
    methods: {
        onReset() {
            this.donors = this.allDonors;
        }
    },
    computed: {
        isEmpty() {
            return !this.donors || !this.donors.length;
        }
    },
    filters: {
        donorUrl(donor) {
            return `/users/${donor.id}`;
        }
    }
};
</script>

<style></style>
