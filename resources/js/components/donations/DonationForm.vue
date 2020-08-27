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
                        class="form-control"
                        placeholder="Hospital"
                        required
                        v-model="hospital_name"
                    />
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
                    <label for="exampleInputEmail1">Share Location</label>
                    <select class="form-control" id="" v-model="share_location">
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
                    <label>Dotors Name</label>
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
        <template>
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
        </template>
        <div v-if="willPay" class="card-header">
            <h6 class="title">Payment details</h6>
        </div>
        <div v-if="willPay" class="row">
            <div class="col-md-6 pr-1">
                <div class="form-group">
                    <label>Payment method(if selected Charged as status)</label>
                    <input
                        type="text"
                        class="form-control"
                        disabled=""
                        placeholder="momo NO, bank account etc"
                    />
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-round">
            Make request
        </button>
    </form>
</template>

<script>
export default {
    name: "DonationForm",
    props: ["donationType"],
    data() {
        return {
            full_name: "",
            hospital_name: "",
            hospital_location: "",
            share_location: "",
            status: "",
            date_needed: "",
            doctor_name: "",
            doctor_staff_id: "",
            doctor_phone: "",
            value: "",
            images: []
        };
    },
    methods: {
        onSubmit() {
            console.log(this.status);
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
            return this.donationType === "blood";
        },
        isOrgan() {
            return this.donationType === "organ";
        },
        isFunds() {
            return this.donationType === "funds";
        },
        valueHeader() {
            this.isBlood
                ? "Blood group"
                : this.isOrgan
                ? "Specify Organ"
                : "Purpose";
        },
        valueLabel() {
            this.isBlood
                ? "Blood group"
                : this.isOrgan
                ? "Organ"
                : "Enter Purpose for fund";
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
