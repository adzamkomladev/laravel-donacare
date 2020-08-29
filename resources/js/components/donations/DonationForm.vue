<template>
    <form @submit.prevent="onSubmit">
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
                    <label for="status">Status</label>
                    <select class="form-control" id="status" v-model="status">
                        <option id="jui" value="">-- status --</option>
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
                        type="date"
                        class="form-control"
                        placeholder="content"
                        v-model="date_needed"
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
                    >
                        <option id="jui" value="">-- share location --</option>
                        <option id="jui" value="yes">yes</option>
                        <option id="jui" value="no">no</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="card-header">
            <h6 class="title">Doctors details</h6>
        </div>
        <div class="row">
            <div class="col-md-3 pr-1">
                <div class="form-group">
                    <label>Hospital</label>
                    <input
                        type="text"
                        class="form-control"
                        placeholder="hospital"
                        readonly
                        v-model="hospital_name"
                    />
                </div>
            </div>
            <div class="col-md-3 px-1">
                <div class="form-group">
                    <label>Doctors Name</label>
                    <input
                        type="text"
                        class="form-control"
                        placeholder="doctors name"
                        v-model="doctor_name"
                    />
                </div>
            </div>
            <div class="col-md-3 pl-1">
                <div class="form-group">
                    <label for="exampleInputEmail1">Doc. Staff ID</label>
                    <input
                        type="text"
                        class="form-control"
                        placeholder="doctors staff ID"
                        v-model="doctor_staff_id"
                    />
                </div>
            </div>
            <div class="col-md-3 pl-1">
                <div class="form-group">
                    <label for="doctor-phone">Doctors Phone Number</label>
                    <input
                        id="doctor-phone"
                        type="tel"
                        class="form-control"
                        placeholder="doctors phone number"
                        v-model="doctor_phone"
                    />
                </div>
            </div>
        </div>
        <div class="card-header">
            <h6 class="title">{{ valueHeader }}</h6>
        </div>
        <div class="row">
            <div class="col-md-12 pr-1">
                <div class="form-group">
                    <label> {{ valueLabel }} </label>
                    <input
                        type="text"
                        class="form-control"
                        placeholder="Donation item"
                        v-model="value"
                    />
                </div>
            </div>
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
                    >
                        <option id="jui" value="">-- select method --</option>
                        <option id="jui" value="Mobile money"
                            >Mobile money</option
                        >
                        <option id="jui" value="Debit/Credit card"
                            >Debit/Credit card</option
                        >
                        <option id="jui" value="Cash">Cash</option>
                    </select>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-round">
            Make request
        </button>
    </form>
</template>

<script>
import Auth from "../../services/auth";

export default {
    name: "DonationForm",
    props: ["type"],
    mounted() {
        this.value = this.initialValue;
    },
    data() {
        return {
            user: Auth.currentUser(),
            full_name: Auth.currentUser().profile.full_name,
            hospital_name: "",
            hospital_location: "",
            share_location: "",
            status: "",
            date_needed: "",
            doctor_name: "",
            doctor_staff_id: "",
            doctor_phone: "",
            value: "",
            payment_method: "",
            images: []
        };
    },
    methods: {
        onSubmit() {
            console.log(this.images);
            const donationData = new FormData();
            donationData.append("patient_id", this.user_id);
            donationData.append("hospital_name", this.hospital_name);
            donationData.append("hospital_location", this.hospital_location);
            donationData.append("status", this.status);
            donationData.append("date_needed", this.date_needed);
            donationData.append("doctor_name", this.doctor_name);
            donationData.append("doctor_staff_id", this.doctor_staff_id);
            donationData.append("doctor_phone", this.doctor_phone);
            donationData.append("value", this.value);
            donationData.append("type", this.type);
            donationData.append("payment_method", this.payment_method);
            this.images.forEach(image => donationData.append("images", image));

            console.log({ donationData });
        },
        onUpload(event) {
            this.images = event.target.files;
        }
    },
    computed: {
        willPay() {
            return this.status === "charged";
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
        }
    },
    filters: {
        uploadText(images) {
            return images.length === 0
                ? "Choose images"
                : `${images.length} images uploaded!`;
        }
    }
};
</script>

<style></style>
