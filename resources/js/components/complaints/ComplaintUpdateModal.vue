<template>
    <div
        class="modal fade"
        id="complaint-update-modal"
        tabindex="-1"
        role="dialog"
    >
        <div class="modal-dialog" role="document">
            <div class="card modal-content">
                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Complaint</label>
                                    <textarea
                                        rows="4"
                                        cols="80"
                                        class="form-control"
                                        v-model="complaint.description"
                                        disabled
                                        required
                                    >
                                    </textarea>
                                </div>
                            </div>
                            <div class="col-md-12 pr-1">
                                <div class="form-group">
                                    <label>Response</label>
                                    <textarea
                                        rows="4"
                                        cols="80"
                                        class="form-control"
                                        v-model="complaint.response"
                                        required
                                    >
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <p
                            class="my-3 text-danger font-weight-bold text-center"
                        >
                            {{ errorMessage }}
                        </p>
                        <div class="row" v-if="isAdmin">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <!--                                    <input type="submit" id="sbmt" class="form-control s" value="add">-->
                                    <button
                                        @click.prevent="onUpdate"
                                        class="btn btn-success btn-round btn-lg"
                                        data-dismiss="modal"
                                    >
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { eventBus } from "../../events/event-bus";
import { Auth, ComplaintService } from "../../common/api.service";

export default {
    name: "ComplaintUpdateModal",
    created() {
        eventBus.$on(
            "selectedComplaint",
            complaint => (this.complaint = _.deepClone(complaint))
        );
    },
    data() {
        return {
            complaint: {},
            submitting: false,
            errorMessage: ""
        };
    },
    computed: {
        isAdmin() {
            return Auth.currentUser().role === "admin";
        }
    },
    methods: {
        async onUpdate() {
            this.submitting = true;
            this.errorMessage = "";

            try {
                const { data } = await ComplaintService.update(
                    this.complaint.id,
                    thi.complaint
                );

                this.complaint = _.deepClone(data);

                eventBus.$emit("updatedComplaint", this.complaint);
            } catch (error) {
                const errors = error?.response?.data?.errors;

                [this.errorMessage] = Object.values(errors || {})[0] || [
                    "Failed to update complaint!"
                ];
            } finally {
                this.submitting = false;
            }
        }
    }
};
</script>

<style scoped></style>
