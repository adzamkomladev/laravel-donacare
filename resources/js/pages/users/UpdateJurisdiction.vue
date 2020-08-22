<template>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">Set Working Jurisdiction</h5>
                </div>
                <div class="card-body">
                    <JurisdictionForm
                        :selected-jurisdiction="profile.jurisdiction"
                        @updateJurisdiction="onUpdateJurisdiction($event)"
                    />
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <DisplayJurisdiction :jurisdiction="profile.jurisdiction" />
        </div>
    </div>
</template>

<script>
import JurisdictionForm from "../../components/users/JurisdictionForm";
import DisplayJurisdiction from "../../components/users/DisplayJurisdiction";

import Profile from "../../services/profile";

export default {
    name: "UpdateJurisdiction",
    components: { JurisdictionForm, DisplayJurisdiction },
    props: ["selectedProfile"],
    data() {
        return {
            profile: this.selectedProfile
        };
    },
    methods: {
        async onUpdateJurisdiction(jurisdiction) {
            try {
                const { data } = await Profile.updateJurisdiction(
                    this.profile.id,
                    { jurisdiction }
                );
                this.profile.jurisdiction = jurisdiction;
                this.showNotification(
                    "fas fa-check",
                    "Your jurisdiction has been updated!",
                    "primary"
                );
            } catch (error) {
                const errors = error?.response?.data?.errors;

                const [message] = Object.values(errors || {})[0] || [
                    "Failed to set jurisdiction!"
                ];

                this.showNotification("fas fa-times", message, "danger");
            }
        },
        showNotification(icon, message, type) {
            $.notify({ icon, message }, { type, timer: 3000 });
        }
    }
};
</script>
