<template>
    <form @submit.prevent="onSubmit">
        <div class="row">
            <div class="col-md-4 pr-1">
                <div class="form-group">
                    <label>System charge (GHc)</label>
                    <input
                        type="number"
                        step="0.1"
                        min="0"
                        class="form-control"
                        placeholder="System charge"
                        v-model="systemCharge"
                    />
                </div>
            </div>
            <div class="col-md-4 px-1">
                <div class="form-group">
                    <label>Percentage charge (%)</label>
                    <input
                        type="number"
                        step="1"
                        min="0"
                        max="100"
                        class="form-control"
                        placeholder="Percentage charge"
                        v-model="settingData.percentageCharge"
                    />
                </div>
            </div>
            <div class="col-md-4 px-1">
                <div class="form-group">
                    <label>Duration between donations (days)</label>
                    <input
                        type="number"
                        step="1"
                        min="0"
                        class="form-control"
                        placeholder="Duration between donations"
                        v-model="settingData.durationBetweenDonation"
                    />
                </div>
            </div>
            <div class="col-md-4 pl-1">
                <button type="submit" class="btn btn-primary btn-round">
                    Save
                </button>
            </div>
        </div>
    </form>
</template>

<script>
import {Auth, SettingService} from '../../common/api.service';

export default {
    name: "UpdateSetting",
    props: ["setting"],
    data() {
        return {
            settingData: {
                systemCharge: this.setting.system_charge,
                percentageCharge: this.setting.percentage_charge,
                durationBetweenDonation: this.setting
                    .duration_between_donation
            }
        };
    },
    methods: {
        async onSubmit() {
            try {
                const { data } = await SettingService.create({
                    userId: Auth.currentUser().id,
                    ...this.settingData
                });
                this.settingData = this.toCamelCase(_.cloneDeep(JSON.parse(data.data)));

                this.showNotification(
                    "fas fa-check",
                    "Updated settings successfully!",
                    "primary"
                );
            } catch (error) {
                const errors = error?.response.data.errors;

                const [errorMessage] = Object.values(errors || {})[0] || [
                    "Failed to update settings!"
                ];

                this.showNotification("fas fa-times", errorMessage, "danger");
            }
        }
    },
    computed: {
        systemCharge: {
            get() {
                return (this.settingData.systemCharge / 100).toFixed(2);
            },
            set(value) {
                this.settingData.systemCharge = value * 100;
            }
        }
    }
};
</script>
