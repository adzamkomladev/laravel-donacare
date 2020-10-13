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

import { ProfileService } from "../../common/api.service";

export default {
    name: "UpdateJurisdiction",
    components: { JurisdictionForm, DisplayJurisdiction },
    props: ["selectedProfile"],
    data() {
        return {
            profile: this.toCamelCase(_.cloneDeep(this.selectedProfile))
        };
    },
    methods: {
        async onUpdateJurisdiction(jurisdiction) {
            try {
                const { data } = await ProfileService.updateJurisdiction(
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
        }
    }
};
</script>
