<template>
    <form @submit.prevent="onSubmit()">
        <div class="card-header">
            <h6 class="title">Hospital Details</h6>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3 px-1 form-group required">
                <label for="hospital-name">Hospital</label>
                <input
                    id="hospital-name"
                    type="text"
                    list="hospitals"
                    class="form-control"
                    placeholder="Hospital"
                    required
                    :value="hospitalDetails.hospitalName"
                    @input="onInput($event, 'hospitalName')"
                />
                <datalist id="hospitals">
                    <option
                        v-for="(address, name) in hospitals"
                        :value="name"
                        :key="address"
                    >
                    </option>
                </datalist>
            </div>

            <div class="col-md-6 mb-3 form-group pl-1">
                <label for="hospital-location">Location</label>
                <input
                    id="hospital-location"
                    type="text"
                    class="form-control"
                    placeholder="Location"
                    required
                    :value="hospitalDetails.hospitalLocation"
                />
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3 form-group required">
                <label for="share-location">Share Location</label>
                <select
                    id="share-location"
                    class="form-control"
                    :value="hospitalDetails.shareLocation"
                    @input="onInput($event, 'shareLocation')"
                    disabled
                >
                    <option id="jui" value="">-- share location --</option>
                    <option id="jui" value="1">yes</option>
                    <option id="jui" value="0">no</option>
                </select>
            </div>

            <div class="col-md-6 mb-3 form-group pr-1">
                <label>Prescription images</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input
                            type="file"
                            class="custom-file-input"
                            id="prescription-images"
                            @change="onChange"
                            multiple
                        />
                        <label
                            class="custom-file-label"
                            for="prescription-images"
                        >
                            {{ hospitalDetails.prescriptions | uploadText }}
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-round">
            Next
        </button>
    </form>
</template>

<script>
import { mapGetters } from "vuex";

export default {
    name: "HospitalForm",
    methods: {
        onInput({ target: { value } }, property) {
            this.$store.commit("donation/UPDATE_DONATION", {
                property,
                value
            });
        },
        onChange({ target: { files } }) {
            this.$store.commit("donation/UPDATE_DONATION_PRESCRIPTIONS", {
                files
            });
        },
        onSubmit() {
            if (!this.hospitalDetails.hospitalName) {
                this.showNotification(
                    "fas fa-times",
                    "The hospital is required!",
                    "danger"
                );
            } else if (!this.hospitalDetails.hospitalLocation) {
                this.showNotification(
                    "fas fa-times",
                    "The location is required!",
                    "danger"
                );
            } else if (!this.hospitalDetails.) {
                this.showNotification(
                    "fas fa-times",
                    "Select a gender!",
                    "danger"
                );
            } else {
                this.$router.push("medical");
            }
        }
    },
    computed: {
        ...mapGetters("donation", ["hospitalDetails", "hospitals"])
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

<style></style>
