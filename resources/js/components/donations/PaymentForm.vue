<template>
    <form @submit.prevent="onSubmit()">
        <div class="card-header">
            <h6 class="title">Payment Details</h6>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3 form-group">
                <label for="payment-status">Status</label>
                <select
                    class="form-control"
                    id="payment-status"
                    :value="paymentDetails.paymentStatus"
                    @input="onInput($event, 'paymentStatus')"
                    required
                >
                    <option id="jui" value="">-- payment_status --</option>
                    <option id="jui" value="free">Free</option>
                    <option id="jui" value="charged">Charged</option>
                </select>
            </div>
            <div v-if="willPay" class="col-md-6 mb-3 form-group">
                <label id="payment-method"
                    >Payment method(if selected Charged as status)</label
                >
                <select
                    id="payment-method"
                    class="form-control"
                    :value="paymentDetails.paymentMethod"
                    @input="onInput($event, 'paymentMethod')"
                    required
                >
                    <option id="jui" value="">-- select method --</option>
                    <option id="jui" value="Mobile money">Mobile money</option>
                    <!-- <option id="jui" value="Debit/Credit card"
                            >Debit/Credit card</option
                        > -->
                    <option id="jui" value="Cash">Cash</option>
                </select>
            </div>
            <div class="col-md-6 mx-3 mb-3">
                <label for="cost">Cost (in GHc) </label>
                <p id="cost">
                    {{ costText }}
                </p>
            </div>
        </div>

        <div class="row">
            <router-link
                :to="{ name: 'medical' }"
                class="mx-3 btn btn-primary btn-round"
                >Back</router-link
            >
            <button type="submit" class="mx-3 btn btn-primary btn-round">
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
    name: "PaymentForm",
    data() {
        return {
            isLoading: false
        };
    },
    methods: {
        onInput({ target: { value } }, property) {
            this.$store.commit("donation/UPDATE_DONATION", {
                property,
                value
            });
        },
        async onSubmit() {
            if (!this.paymentDetails.paymentStatus) {
                this.showNotification(
                    "fas fa-times",
                    "Select a payment status!",
                    "danger"
                );
                return;
            }
            if (this.willPay) {
                if (!this.paymentDetails.paymentMethod) {
                    this.showNotification(
                        "fas fa-times",
                        "Select a payment method!",
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
                    "Donation requested!",
                    "primary"
                );

                _.delay(() => {
                    window.location.href = "/home";
                }, 3000);
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
        ...mapActions("donation", ["create"])
    },
    computed: {
        willPay() {
            return this.paymentDetails.paymentStatus === "charged";
        },
        costText() {
            return !this.willPay
                ? "Free"
                : this.paymentDetails.cost;
        },
        ...mapGetters("donation", ["paymentDetails"])
    }
};
</script>
