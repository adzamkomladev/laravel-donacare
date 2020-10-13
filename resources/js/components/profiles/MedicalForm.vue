<template>
    <form @submit.prevent="onSubmit()">
        <div class="card-header">
            <h6 class="title">Medical Details</h6>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3 form-group required">
                <label for="role">Purpose</label>
                <div class="input-group">
                    <select
                        id="role"
                        class="form-control"
                        name="role"
                        @input="onInput($event, 'role')"
                        required
                    >
                        <option value="patient" :selected="isPatient"
                            >Patient</option
                        >
                        <option value="donor" :selected="!isPatient"
                            >Donor</option
                        >
                    </select>
                </div>
            </div>
            <div class="col-md-6 mb-3 form-group required">
                <label for="blood-group">Blood group</label>
                <div class="input-group">
                    <select
                        id="blood-group"
                        class="form-control"
                        name="bloodGroup"
                        @input="onInput($event, 'bloodGroup')"
                        required
                    >
                        <option
                            v-for="(bloodGroup, index) in bloodGroups"
                            :value="bloodGroup.value"
                            :selected="
                                medicalDetails.bloodGroup === bloodGroup.value
                            "
                            :key="index"
                        >
                            {{ bloodGroup.name }}
                        </option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 mb-3 form-group">
                <label for="medical-details">Medical details</label>
                <div class="input-group">
                    <textarea
                        rows="4"
                        cols="80"
                        id="medical-details"
                        class="form-control"
                        name="medicalDetails"
                        placeholder="Your medical details"
                        :value="medicalDetails.medicalDetails"
                        @input="onInput($event, 'medicalDetails')"
                    ></textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <router-link
                :to="{ name: 'personal' }"
                class="btn btn-primary btn-round"
                >Back</router-link
            >
            <button type="submit" class="btn btn-primary btn-round">
                Next
            </button>
        </div>
    </form>
</template>

<script>
import { mapGetters } from "vuex";

export default {
    name: "MedicalForm",
    data() {
        return {
            bloodGroups: [
                { name: "O positive", value: "O+" },
                { name: "O negative", value: "O-" },
                { name: "A positive", value: "A+" },
                { name: "A negative", value: "A-" },
                { name: "AB positive", value: "AB+" },
                { name: "AB negative", value: "AB-" },
                { name: "B positive", value: "B+" },
                { name: "B negative", value: "B-" }
            ]
        };
    },
    methods: {
        onInput({ target: { value } }, property) {
            this.$store.commit("profile/UPDATE_PROFILE", {
                property,
                value
            });
        },
        onSubmit() {
            if (!this.medicalDetails.role) {
                this.showNotification(
                    "fas fa-times",
                    "Select a purpose!",
                    "danger"
                );
            } else if (!this.medicalDetails.bloodGroup) {
                this.showNotification(
                    "fas fa-times",
                    "Select your blood group!",
                    "danger"
                );
            } else {
                this.$router.push("contact");
            }
        }
    },
    computed: {
        ...mapGetters("profile", ["medicalDetails", "isPatient"])
    }
};
</script>

<style></style>
