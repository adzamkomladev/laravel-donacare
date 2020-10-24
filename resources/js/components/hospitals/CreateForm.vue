<template>
    <form @submit.prevent="onSubmit()">
        <div class="card-header">
            <h6 class="title">Create Hospitals</h6>
        </div>
        <div class="row">
            <div class="col-md-12 mb-3 px-1 form-group required">
                <label for="hospital-name">Name</label>
                <input
                    id="hospital-name"
                    type="text"
                    list="hospitals"
                    class="form-control"
                    placeholder="Name"
                    required
                    :value="hospital.locationName"
                    @input="onInput($event, 'locationName')"
                />
                <datalist id="hospitals">
                    <option
                        v-for="(address, name) in suggestedHospitals"
                        :value="name"
                        :key="address"
                    >
                    </option>
                </datalist>
            </div>

            <div class="col-md-12  mb-3 form-group pl-1">
                <label for="hospital-location">Address</label>
                <input
                    id="hospital-location"
                    type="text"
                    class="form-control"
                    placeholder="Address"
                    required
                    :value="hospital.locationAddress"
                    @input="onInput($event, 'locationAddress')"
                />
                <datalist id="hospitals">
                    <option
                        v-for="(address, name) in suggestedHospitals"
                        :value="address"
                        :key="name"
                    >
                    </option>
                </datalist>
            </div>
        </div>

        <button type="submit" class=" mx-3 btn btn-primary btn-round">
            Save
        </button>
    </form>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
    name: "CreateForm",
    data() {
        return { isLoading: false };
    },
    methods: {
        onInput({ target: { value } }, property) {
            this.$store.commit("hospitals/UPDATE_HOSPITAL", {
                property,
                value
            });
        },
        async onSubmit() {
            if (!this.hospital.locationName) {
                this.showNotification(
                    "fas fa-times",
                    "The hospital name is required!",
                    "danger"
                );
                return;
            }

            if (!this.hospital.locationAddress) {
                this.showNotification(
                    "fas fa-times",
                    "The hospital address is required!",
                    "danger"
                );
                return;
            }

            const isDuplicate = !!this.hospitals.find(hospital => {
                return (
                    hospital.location.name.includes(
                        this.hospital.locationName
                    ) ||
                    hospital.location.address.includes(
                        this.hospital.locationAddress
                    )
                );
            });

            if (isDuplicate) {
                this.showNotification(
                    "fas fa-times",
                    "Hospital is present already!",
                    "danger"
                );
                return;
            }

            this.isLoading = true;

            try {
                await this.create();

                this.showNotification(
                    "fas fa-check",
                    "Hospital has been create successfully!",
                    "primary"
                );
            } catch (error) {
                console.log({ error });
                const errors = error?.response?.data?.errors;

                const [errorMessage] = Object.values(errors || {})[0] || [
                    "Failed to save donation!"
                ];

                this.showNotification("fas fa-times", errorMessage, "danger");
            } finally {
                this.isLoading = false;
            }
        },
        ...mapActions("hospitals", ["create"])
    },
    computed: {
        ...mapGetters("hospitals", [
            "hospital",
            "hospitals",
            "suggestedHospitals"
        ])
    },
    filters: {
        uploadText(images) {
            return images.length === 0
                ? "Choose images"
                : `${images.length} image(s) uploaded!`;
        }
    }
};
</script>
