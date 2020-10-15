<template>
    <form @submit.prevent="onSubmit()">
        <div class="card-header">
            <h6 class="title">Contact Details</h6>
        </div>

        <div v-if="!isPatient" class="row">
            <div class="col-md-6 mb-3 form-group required">
                <label for="mobile-money-name">Mobile number name</label>
                <div class="input-group">
                    <input
                        id="mobile-money-name"
                        type="text"
                        class="form-control"
                        name="mobileMoneyName"
                        required
                        placeholder="Your mobile money name"
                        :value="contactDetails.mobileMoneyName"
                        @input="onInput($event, 'mobileMoneyName')"
                    />
                </div>
            </div>

            <div class="col-md-6 mb-3 form-group required">
                <label for="mobile-money-number">Mobile money number</label>
                <div class="input-group">
                    <input
                        id="mobile-money-number"
                        type="text"
                        class="form-control"
                        name="mobileMoneyNumber"
                        required
                        placeholder="Eg. +233553884561"
                        :value="contactDetails.mobileMoneyNumber"
                        @input="onInput($event, 'mobileMoneyNumber')"
                    />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-3 form-group">
                <label for="home-address">Home address</label>
                <div class="input-group">
                    <input
                        id="home-address"
                        type="text"
                        class="form-control"
                        name="homeAddress"
                        autocomplete="street-address"
                        placeholder="Your home address"
                        :value="contactDetails.homeAddress"
                        @input="onInput($event, 'homeAddress')"
                    />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3 form-group">
                <label for="email">Email address</label>
                <div class="input-group">
                    <input
                        id="email"
                        type="email"
                        class="form-control"
                        name="email"
                        autocomplete="email"
                        placeholder="Your email address"
                        :value="contactDetails.email"
                        @input="onInput($event, 'email')"
                    />
                </div>
            </div>
        </div>
        <div class="row">
            <router-link
                :to="{ name: 'medical' }"
                class="btn btn-primary btn-round"
                >Back</router-link
            >
            <button type="submit" class="btn btn-primary btn-round">
                <i
                    v-if="isLoading"
                    class="now-ui-icons loader_refresh spin"
                ></i>
                Save
            </button>
        </div>
    </form>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
    name: "ContactForm",
    data() {
        return {
            isLoading: false
        };
    },
    methods: {
        onInput({ target: { value } }, property) {
            this.$store.commit("profile/UPDATE_PROFILE", {
                property,
                value
            });
        },
        async onSubmit() {
            if (!this.isPatient) {
                if (!this.contactDetails.mobileMoneyName) {
                    this.showNotification(
                        "fas fa-times",
                        "Your mobile money name is required!",
                        "danger"
                    );
                    return;
                }

                if (!this.contactDetails.mobileMoneyNumber) {
                    this.showNotification(
                        "fas fa-times",
                        "Your mobile money number is required!",
                        "danger"
                    );
                    return;
                }
            }

            this.isLoading = true;

            try {
                await this.create();

                this.showNotification(
                    "fas fa-check",
                    "Profile saved!",
                    "primary"
                );

                _.delay(() => {
                    window.location.href = "/home";
                }, 3000);

            } catch (error) {
                console.log({ error });
                const errors = error?.response?.data?.errors;

                const [errorMessage] = Object.values(errors || {})[0] || [
                    "Failed to save profile!"
                ];

                this.showNotification("fas fa-times", errorMessage, "danger");
            } finally {
                this.isLoading = false;
            }
        },
        ...mapActions("profile", ["create"])
    },
    computed: {
        ...mapGetters("profile", ["contactDetails", "isPatient"])
    }
};
</script>

<style></style>
