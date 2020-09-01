<template>
    <div class="row">
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
                        >{{ donor.profile.full_name }}</a
                    >
                </p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "DisplayDonors",
    props: ["allDonors"],
    data() {
        return {
            donors: this.allDonors
        };
    },
    filters: {
        donorUrl(donor) {
            return `/users/${donor.id}`;
        }
    }
};
</script>

<style></style>
