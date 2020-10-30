<template>
    <form @submit.prevent="onSubmit()">
        <div class="card-header">
            <h6 class="title">Medical Details</h6>
        </div>
        <div class="row">
            <template v-if="isBlood">
                <div class="col-md-6 mb-3 form-group required">
                    <label for="blood-group">Blood group</label>
                    <div class="input-group">
                        <select
                            id="blood-group"
                            class="form-control"
                            name="value"
                            @input="onInput($event, 'value')"
                            required
                        >
                            <option
                                v-for="(bloodGroup, index) in bloodGroups"
                                :value="bloodGroup.value"
                                :selected="
                                    medicalDetails.value ===
                                        bloodGroup.value
                                "
                                :key="index"
                            >
                                {{ bloodGroup.name }}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 mb-3 form-group">
                    <label for="value-type">Blood type</label>
                    <div class="input-group">
                        <select
                            id="value-type"
                            class="form-control"
                            @input="onInput($event, 'valueType')"
                            required
                        >
                            <option
                                v-for="(bloodType, index) in bloodTypes"
                                :key="index"
                                :value="bloodType"
                                :selected="
                                    bloodType === medicalDetails.valueType
                                "
                                >{{ bloodType }}</option
                            >
                        </select>
                    </div>
                </div>
            </template>

            <div v-else class="col-md-6 mb-3 form-group">
                <label>Other donation </label>
                <input
                    type="text"
                    class="form-control"
                    placeholder="Donation item"
                    :value="medicalDetails.value"
                        @input="onInput($event, 'value')"
                        required
                />
            </div>
            <div class="col-md-6 mb-3 form-group">
                <label for="quantity">Quantity</label>
                <input
                    id="quantity"
                    type="number"
                    min="1"
                    class="form-control"
                    placeholder="Quantity"
                    required
                    :value="medicalDetails.quantity"
                    @input="onInput($event, 'quantity')"
                />
            </div>
            <div class="col-md-4 px-3">
                <div class="form-group">
                    <label for="price">Price per bag</label>
                    <p id="price">{{ priceText }}</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 mb-3 form-group">
                <label for="description">Description</label>
                <div class="input-group">
                    <textarea
                        rows="4"
                        cols="80"
                        id="description"
                        class="form-control"
                        name="description"
                        placeholder="Your medical details"
                        :value="medicalDetails.description"
                        @input="onInput($event, 'description')"
                    ></textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <router-link
                :to="{ name: 'hospital' }"
                class="mx-3 btn btn-primary btn-round"
                >Back</router-link
            >
            <button type="mx-3 submit" class="btn btn-primary btn-round">
                Next
            </button>
        </div>
    </form>
</template>

<script>
import { mapGetters } from "vuex";

export default {
    name: "MedicalForm",
    methods: {
        onInput({ target: { value } }, property) {
            this.$store.commit("donation/UPDATE_DONATION", {
                property,
                value
            });
        },
        onSubmit() {
            console.log({dd: this.medicalDetails});
            if (!this.medicalDetails.valueType) {
                this.showNotification(
                    "fas fa-times",
                    "Select a type of blood!",
                    "danger"
                );
            } else if (!this.medicalDetails.value) {
                this.showNotification(
                    "fas fa-times",
                    "Select your blood group!",
                    "danger"
                );
            } else if (!this.medicalDetails.quantity) {
                this.showNotification(
                    "fas fa-times",
                    "Enter a valid quantity!",
                    "danger"
                );
            } else {
                this.$store.commit("donation/UPDATE_COST");
                this.$router.push("payment");
            }
        }
    },
    computed: {
        priceText() {
            return `GHc ${this.servicePrice}`;
        },
        isBlood() {
            return this.medicalDetails.type === "blood";
        },
        ...mapGetters("donation", [
            "medicalDetails",
            "bloodGroups",
            "bloodTypes",
            "servicePrice"
        ])
    }
};
</script>
