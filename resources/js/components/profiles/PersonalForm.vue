<template>
    <form @submit.prevent="onSubmit()">
        <div class="card-header">
            <h6 class="title">Personal Details</h6>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3 form-group required">
                <label for="first-name">First name</label>
                <div class="input-group">
                    <input
                        id="first-name"
                        type="text"
                        class="form-control"
                        name="firstName"
                        required
                        autocomplete="given-name"
                        autofocus
                        placeholder="Your first name"
                        :value="personalDetails.firstName"
                        @input="onInput($event, 'firstName')"
                    />
                </div>
            </div>
            <div class="col-md-6 mb-3 form-group required">
                <label for="last-name">Last name</label>
                <div class="input-group">
                    <input
                        id="last-name"
                        type="text"
                        class="form-control"
                        name="lastName"
                        required
                        autocomplete="family-name"
                        autofocus
                        placeholder="Your last name"
                        :value="personalDetails.lastName"
                        @input="onInput($event, 'lastName')"
                    />
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 mb-3 form-group">
                <label for="other-names">Other names</label>
                <div class="input-group">
                    <input
                        id="other-names"
                        type="text"
                        class="form-control"
                        name="otherNames"
                        autocomplete="additional-name"
                        placeholder="Your other names"
                        :value="personalDetails.otherNames"
                        @input="onInput($event, 'otherNames')"
                    />
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3 form-group required">
                <label>Gender</label>
                <br />
                <div class="form-check form-check-radio form-check-inline">
                    <label class="form-check-label">
                        <input
                            class="form-check-input"
                            type="radio"
                            name="gender"
                            id="male"
                            value="male"
                            :checked="isMale"
                            @input="onInput($event, 'gender')"
                        />
                        Male
                        <span class="form-check-sign"></span>
                    </label>
                </div>
                <div class="form-check form-check-radio form-check-inline">
                    <label class="form-check-label">
                        <input
                            class="form-check-input"
                            type="radio"
                            name="gender"
                            id="female"
                            value="female"
                            :checked="!isMale"
                            @input="onInput($event, 'gender')"
                        />
                        Female
                        <span class="form-check-sign"></span>
                    </label>
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
    name: "PersonalForm",
    methods: {
        onInput({ target: { value } }, property) {
            this.$store.commit("profile/UPDATE_PROFILE", {
                property,
                value
            });
        },
        onSubmit() {
            if (!this.personalDetails.firstName) {
                this.showNotification(
                    "fas fa-times",
                    "Your first name is required!",
                    "danger"
                );
            } else if (!this.personalDetails.lastName) {
                this.showNotification(
                    "fas fa-times",
                    "Your last name is required!",
                    "danger"
                );
            } else if (!this.personalDetails.gender) {
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
        ...mapGetters("profile", ["personalDetails", "isMale"])
    }
};
</script>

<style></style>
