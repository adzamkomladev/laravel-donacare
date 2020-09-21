<template>
    <div class="modal fade" id="donation-summary" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="card modal-content">
                <div class="card-body">
                    <h4 class="text-center">Verify request</h4>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="hospital-name">Hospital name</label>
                            <p id="hospital-name">
                                {{ donationSummary.hospitalName }}
                            </p>
                        </div>
                        <div class="col-md-4">
                            <label for="hospital-location"
                                >Hospital location</label
                            >
                            <p id="hospital-location">
                                {{ donationSummary.hospitalLocation }}
                            </p>
                        </div>
                        <div class="col-md-4">
                            <label for="blood-unit-name">Blood unit name</label>
                            <p id="bloodUnit-name">
                                {{ donationSummary.bloodUnitName }}
                            </p>
                        </div>
                        <div class="col-md-4">
                            <label for="blood-unit-location"
                                >Blood unit location</label
                            >
                            <p id="blood-unit-location">
                                {{ donationSummary.bloodUnitLocation }}
                            </p>
                        </div>
                        <div class="col-md-4">
                            <label for="share-location">Share location</label>
                            <p id="share-location">
                                {{
                                    donationSummary.shareLocation
                                        | shareLocationText
                                }}
                            </p>
                        </div>
                        <div class="col-md-4">
                            <label for="date-needed">Date needed</label>
                            <p id="date-needed">
                                {{ donationSummary.dateNeeded }}
                            </p>
                        </div>
                        <div class="col-md-4">
                            <label for="value">Donation item</label>
                            <p id="value">{{ donationSummary.value }}</p>
                        </div>
                        <div class="col-md-4">
                            <label for="value-type">Blood type</label>
                            <p id="value-type">
                                {{ donationSummary.valueType }}
                            </p>
                        </div>
                        <div class="col-md-4">
                            <label for="quantity">Quantity</label>
                            <p id="quantity">{{ donationSummary.quantity }}</p>
                        </div>
                        <div class="col-md-4">
                            <label for="payment-status">Payment Status</label>
                            <p id="payment-status">
                                {{ donationSummary.paymentStatus }}
                            </p>
                        </div>
                        <div
                            v-if="donationSummary.paymentMethod"
                            class="col-md-4"
                        >
                            <label
                                for="payment-method
                            "
                                >Payment method</label
                            >
                            <p
                                id="payment-method
                            "
                            >
                                {{ donationSummary.paymentMethod }}
                            </p>
                        </div>
                        <div class="col-md-4">
                            <label for="cost">Cost (in GHc) </label>
                            <p id="cost">
                                {{ costText }}
                            </p>
                        </div>
                    </div>
                    <label for="prescriptions" class="mb-2 font-weight-bold"
                        >Prescriptions</label
                    >
                    <div class="row mb-3" id="prescriptions">
                        <img
                            v-for="(image, index) in donationSummary.images"
                            :key="index"
                            :src="image"
                            alt="Prescription image"
                            class="col-md-6"
                        />
                    </div>
                    <button
                        @click.prevent="onSubmit"
                        class="btn btn-success btn-round"
                    >
                        <i
                            v-if="isLoading"
                            class="now-ui-icons loader_refresh spin"
                        ></i>
                        Make donation request
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { eventBus } from "../../events/event-bus";

export default {
    name: "DonationFormSummary",
    created() {
        eventBus.$on(
            "openDonationSummaryModal",
            summary => (this.donationSummary = { ...summary })
        );

        eventBus.$on("donationFormSubmitted", () =>
            $("#donation-summary").modal("hide")
        );
    },
    data() {
        return {
            donationSummary: {},
            isLoading: false
        };
    },
    methods: {
        onSubmit() {
            this.isLoading = true;
            eventBus.$emit("submitDonationForm");
        }
    },
    computed: {
        costText() {
            return this.donationSummary.paymentStatus === "free"
                ? "Free"
                : (
                      Math.round(
                          this.donationSummary?.service?.price *
                              this.donationSummary.quantity *
                              100
                      ) / 100
                  ).toFixed(2);
        }
    },
    filters: {
        shareLocationText(shareLocation) {
            return shareLocation ? "Yes" : "No";
        }
    }
};
</script>
