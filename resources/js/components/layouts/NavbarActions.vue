<template>
    <div>
        <PatientActions :user-donations="userDonations" v-if="isPatient" />
        <DonorActions :user-donations="userDonations" v-if="isDonor" />
    </div>
</template>

<script>
import PatientActions from "./PatientActions";
import DonorActions from "./DonorActions";

import Auth from "../../services/auth";
import Donation from "../../services/donation";

export default {
    name: "NavbarActions",
    components: { PatientActions, DonorActions },
    async mounted() {
        await this.pollData();
    },
    beforeDestroy() {
        clearInterval(this.polling);
    },
    data() {
        return {
            currentUser: Auth.currentUser(),
            userDonations: [],
            polling: null
        };
    },
    methods: {
        async getUserDonations() {
            try {
                const { data } = await Donation.userDonations(
                    this.currentUser.id
                );
                this.userDonations = data;
                console.log(data);
            } catch (error) {
                console.log({ error });
            }
        },
        async pollData() {
            await this.getUserDonations();

            this.polling = setInterval(async () => {
                await this.getUserDonations();
            }, 30000);
        }
    },

    computed: {
        isPatient() {
            return this.currentUser.role === "patient";
        },
        isDonor() {
            return this.currentUser.role === "donor";
        }
    }
};
</script>

<style></style>
