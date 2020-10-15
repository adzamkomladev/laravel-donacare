<template>
    <div>
        <ObtainCurrentLocation />
        <PatientActions :user-donations="userDonations" v-if="isPatient" />
        <DonorActions
            :user-donations="userDonations"
            @removeDonation="onRemoveDonation"
            v-if="isDonor"
        />
    </div>
</template>

<script>
import PatientActions from "./PatientActions";
import DonorActions from "./DonorActions";
import ObtainCurrentLocation from "../auth/ObtainCurrentLocation";

import { Auth, DonationService } from "../../common/api.service";

export default {
    name: "NavbarActions",
    components: { PatientActions, DonorActions, ObtainCurrentLocation },
    async mounted() {
        await this.pollData();
    },
    beforeDestroy() {
        clearInterval(this.polling);
    },
    data() {
        return {
            currentUser: this.toCamelCase(_.cloneDeep(Auth.currentUser())),
            userDonations: [],
            polling: null
        };
    },
    methods: {
        async getUserDonations() {
            try {
                const { data } = await DonationService.userDonations(
                    this.currentUser.id
                );
                this.userDonations = [...data];
            } catch (error) {
                console.log({ error }, 'No');
            }
        },
        async pollData() {
            await this.getUserDonations();

            this.polling = setInterval(async () => {
                await this.getUserDonations();
            }, 60000);
        },
        async onRemoveDonation() {
            await this.getUserDonations();
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
