<template>
    <form>
        <div class="card-header">
            <h6 class="title">General</h6>
        </div>
        <div class="row">
            <div class="col-md-4 pr-1">
                <div class="form-group">
                    <label>Name</label>
                    <input
                        type="text"
                        class="form-control"
                        placeholder="User's name"
                        readonly
                        v-model="full_name"
                    />
                </div>
            </div>
            <div class="col-md-4 px-1">
                <div class="form-group">
                    <label>Hospital</label>
                    <input
                        type="text"
                        list="hospitals"
                        class="form-control"
                        placeholder="Hospital"
                        required
                        v-model="hospital_name"
                        @change="onSelectHospital()"
                    />
                    <datalist id="hospitals">
                        <option value="Kaneshie Polyclinic"> </option>
                        <option value="Korle Bu Hospital"> </option>
                        <option value="Ridge Hospital"> </option>
                        <option value="Amasaman Gen. Hospital"> </option>
                        <option value="Komfo Anokye Hospital"> </option>
                        <option value="Holy Trinity Hospital"> </option>
                    </datalist>
                </div>
            </div>
            <div class="col-md-4 pl-1">
                <div class="form-group">
                    <label for="location">Location</label>
                    <input
                        id="location"
                        type="text"
                        class="form-control"
                        placeholder="location"
                        required
                        v-model="hospital_location"
                    />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 pr-1">
                <div class="form-group">
                    <label>Prescription images</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input
                                type="file"
                                class="custom-file-input"
                                id="prescription-images"
                                @change="onUpload"
                                multiple
                            />
                            <label
                                class="custom-file-label"
                                for="prescription-images"
                            >
                                {{ images | uploadText }}
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 px-1">
                <div class="form-group">
                    <label for="payment-status">Status</label>
                    <select
                        class="form-control"
                        id="payment-status"
                        v-model="payment_status"
                    >
                        <option id="jui" value="">-- payment_status --</option>
                        <option id="jui" value="free">Free</option>
                        <option id="jui" value="charged">Charged</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4 pl-1">
                <div class="form-group">
                    <label for="date-needed">Date Needed</label>
                    <input
                        id="date-needed"
                        :min="currentDate"
                        type="date"
                        class="form-control"
                        placeholder="content"
                        v-model="date_needed"
                        required
                    />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 pl-1">
                <div class="form-group">
                    <label for="share-location">Share Location</label>
                    <select
                        id="share-location"
                        class="form-control"
                        v-model="share_location"
                        disabled
                    >
                        <option id="jui" value="">-- share location --</option>
                        <option id="jui" value="1">yes</option>
                        <option id="jui" value="0">no</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="card-header">
            <h6 class="title">{{ valueHeader }}</h6>
        </div>
        <div class="row">
            <div class="col-md-4 pr-1">
                <div v-if="isBlood" class="form-group">
                    <label for="blood-group">{{ valueLabel }}</label>
                    <div class="input-group">
                        <select
                            id="blood-group"
                            class="form-control"
                            v-model="value"
                        >
                            <option value="O+">O positive</option>
                            <option value="O-">O negative</option>
                            <option value="A+">A positive</option>
                            <option value="A-">A negative</option>
                            <option value="B+">B positive</option>
                            <option value="B-">B negative</option>
                            <option value="AB+">AB positive</option>
                            <option value="AB-">AB negative</option>
                        </select>
                    </div>
                </div>
                <div v-else class="form-group">
                    <label> </label>
                    <input
                        type="text"
                        class="form-control"
                        placeholder="Donation item"
                        v-model="value"
                    />
                </div>
            </div>
            <div class="col-md-4 pl-1">
                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input
                        id="quantity"
                        type="number"
                        min="1"
                        class="form-control"
                        placeholder="Quantity"
                        required
                        v-model="quantity"
                    />
                </div>
            </div>
            <div class="col-md-4 pl-1">
                <div class="form-group">
                    <label for="quantity">Price per bag</label>
                    <p id="price">{{ priceText }}</p>
                </div>
            </div>
            <!-- <div class="col-md-6 pl-1" v-if="!willPay">
                <div class="form-group">
                    <label for="service-id">Select service</label>
                    <select
                        id="service-id"
                        class="form-control"
                        v-model="service_id"
                        disabled
                    >
                        <option id="jui" value="">-- choose service --</option>
                        <option
                            v-for="service in services"
                            :key="service.id"
                            id="jui"
                            :value="service.id"
                            >{{ service | serviceOptionText }}</option
                        >
                    </select>
                </div>
            </div> -->
        </div>
        <div v-if="willPay" class="card-header">
            <h6 class="title">Payment details</h6>
        </div>
        <div v-if="willPay" class="row">
            <div class="col-md-6 pr-1">
                <div class="form-group">
                    <label id="payment-method"
                        >Payment method(if selected Charged as status)</label
                    >
                    <select
                        id="payment-method"
                        class="form-control"
                        v-model="payment_method"
                        required
                    >
                        <option id="jui" value="">-- select method --</option>
                        <option id="jui" value="Mobile money"
                            >Mobile money</option
                        >
                        <!-- <option id="jui" value="Debit/Credit card"
                            >Debit/Credit card</option
                        > -->
                        <option id="jui" value="Cash">Cash</option>
                    </select>
                </div>
            </div>
        </div>
        <button
            @click.prevent="onOpenModal"
            type="submit"
            class="btn btn-primary btn-round"
        >
            <i v-if="isLoading" class="now-ui-icons loader_refresh spin"></i>
            Make request
        </button>
    </form>
</template>

<script>
import { eventBus } from "../../events/event-bus";
import Auth from "../../services/auth";
import Donation from "../../services/donation";

export default {
    name: "DonationForm",
    props: ["type", "services"],
    created() {
        eventBus.$on("submitDonationForm", this.onSubmit);
    },
    mounted() {
        this.value = this.initialValue;
    },
    data() {
        return {
            user: Auth.currentUser(),
            full_name: Auth.currentUser().profile.full_name,
            hospital_name: "",
            hospital_location: "",
            share_location: 1,
            quantity: 1,
            service_id: this.services.find(service =>
                service.name.toLowerCase().includes(this.type)
            )?.id,
            service: this.services.find(service =>
                service.name.toLowerCase().includes(this.type)
            ),
            payment_status: "",
            date_needed: "",
            value: "",
            payment_method: "",
            images: [],
            isLoading: false,
            currentDate: new Date()
                .toISOString()
                .replace(/T.*/, "")
                .split("-")
                .join("-"),
            locations: {
                "Kaneshie Polyclinic": "Palace St, Accra",
                "Korle Bu Hospital": "Guggisberg Ave, Korlebu",
                "Amasaman Gen. Hospital": " Hospital Road, Amasaman, Amasaman",
                "Komfo Anokye Hospital": "Okomfo Anokye Road, Kumasi",
                "Holy Trinity Hospital": "Amar Koranten St, Accra",
                "Ridge Hospital": "Castle Rd, Accra"
            }
        };
    },
    methods: {
        onSelectHospital() {
            this.hospital_location = this.locations[this.hospital_name];
        },
        onOpenModal() {
            $("#donation-summary").modal("show");

            eventBus.$emit("openDonationSummaryModal", {
                fullName: this.full_name,
                hospitalName: this.hospital_name,
                hospitalLocation: this.hospital_location,
                shareLocation: this.share_location,
                quantity: this.quantity,
                value: this.value,
                paymentStatus: this.payment_status,
                paymentMethod: this.payment_method,
                service: this.services.find(
                    service => this.service_id === service.id
                ),
                dateNeeded: this.date_needed,
                images: Array.from(this.images).map(image =>
                    URL.createObjectURL(image)
                )
            });
        },
        async onSubmit() {
            this.isLoading = true;

            const donationData = new FormData();
            donationData.append("patient_id", this.user.id);
            donationData.append("hospital_name", this.hospital_name);
            donationData.append("hospital_location", this.hospital_location);
            donationData.append("share_location", this.share_location);
            donationData.append("payment_status", this.payment_status);
            donationData.append("date_needed", this.date_needed);
            donationData.append("quantity", this.quantity);
            donationData.append("service_id", this.service_id);
            donationData.append("value", this.value);
            donationData.append("type", this.type);
            if (this.willPay) {
                const service = this.services.find(
                    service => service.id === this.service_id
                );
                const cost = service?.price * this.quantity;

                donationData.append("cost", cost);
                donationData.append("payment_method", this.payment_method);
            }
            const urls = await this.getFileUrls();
            donationData.append("images", JSON.stringify(urls));

            try {
                const { data } = await Donation.save(donationData);

                eventBus.$emit("donationFormSubmitted");
                this.showNotification(
                    "fas fa-check",
                    `Donation request has been made!`,
                    "primary"
                );

                setTimeout(() => {
                    this.routeBasedOnPaymentMethod(
                        this.payment_method,
                        data.donation.id
                    );
                }, 3000);
            } catch (error) {
                console.log({ error });

                const errors = error?.response?.data?.errors;

                const [errorMessage] = Object.values(errors || {})[0] || [
                    "Failed to make donation request!"
                ];

                this.showNotification("fas fa-times", errorMessage, "danger");
            } finally {
                this.isLoading = false;
            }
        },
        routeBasedOnPaymentMethod(paymentMethod, donationId) {
            if (paymentMethod === "Cash" || !paymentMethod) {
                window.location.pathname = `/donations/${donationId}`;
                return;
            }

            if (paymentMethod === "Mobile money") {
                window.location.pathname = `/payments/${donationId}`;
                return;
            }
        },
        showNotification(icon, message, type) {
            $.notify({ icon, message }, { type, timer: 2500 });
        },
        onUpload(event) {
            this.images = event.target.files;
        },
        async getFileUrls() {
            const apikey = "Aw7Es3zsBRRuECxYQDkBzz";
            const client = filestack.init(apikey);

            const files = await Promise.all(
                Array.from(this.images).map(image => client.upload(image))
            );

            return files.map(file => file.url);
        }
    },
    computed: {
        willPay() {
            return this.payment_status === "charged";
        },
        isBlood() {
            return this.type === "blood";
        },
        isOrgan() {
            return this.type === "organ";
        },
        isFunds() {
            return this.type === "funds";
        },
        valueHeader() {
            return this.isBlood
                ? "Blood group"
                : this.isOrgan
                ? "Specify Organ"
                : "Purpose";
        },
        valueLabel() {
            return this.isBlood
                ? "Blood group"
                : this.isOrgan
                ? "Organ"
                : "Enter Purpose for fund";
        },
        initialValue() {
            return this.isBlood ? this.user?.profile.blood_group : "";
        },
        priceText() {
            return this.payment_status === "free"
                ? "Free"
                : `GHc ${this.service?.price}`;
        }
    },
    filters: {
        uploadText(images) {
            return images.length === 0
                ? "Choose images"
                : `${images.length} images uploaded!`;
        },
        serviceOptionText(service) {
            return `${service.name} - GHc ${service.price}`;
        }
    }
};
</script>

<style></style>
