<template>
    <!-- Modal -->
    <div
        class="modal fade"
        id="service-update-modal"
        tabindex="-1"
        role="dialog"
    >
        <div class="modal-dialog" role="document">
            <div class="card modal-content">
                <form>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="service.name"
                                        required
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea
                                        rows="4"
                                        cols="80"
                                        class="form-control"
                                        v-model="service.description"
                                        required
                                    >
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 pr-1">
                                <div class="form-group">
                                    <label>Price (GH₵)</label>
                                    <input
                                        type="number"
                                        class="form-control"
                                        v-model="service.price"
                                        step=".01"
                                        min="0"
                                        placeholder="Service price"
                                        required
                                    />
                                </div>
                            </div>
                            <div class="col-md-6 pl-1">
                                <div class="form-group">
                                    <label>Availability</label>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input
                                                class="form-check-input"
                                                type="checkbox"
                                                v-model="service.available"
                                            />
                                            <span
                                                class="form-check-sign"
                                            ></span>
                                            Available
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr />
                    <p class="my-3 text-danger font-weight-bold text-center">
                        {{ errorMessage }}
                    </p>
                    <div class="button-container text-center">
                        <button
                            @click.prevent="onUpdate"
                            class="btn btn-success btn-icon btn-round btn-lg"
                        >
                            <i class="fas fa-lg" :class="submitStateClass"></i>
                        </button>
                        <button
                            class="btn btn-danger btn-icon btn-round btn-lg"
                            data-dismiss="modal"
                        >
                            <i class="fas fa-times fa-lg"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import { eventBus } from "../../events/event-bus";

import { Service } from "../../common/api.service";

export default {
    name: "ServiceUpdateModal",
    created() {
        eventBus.$on(
            "selectedService",
            service => (this.service = _.deepClone(service))
        );
    },
    data() {
        return {
            service: {},
            submitting: false,
            errorMessage: ""
        };
    },
    computed: {
        submitStateClass() {
            return this.submitting ? "fa-spinner" : "fa-check";
        }
    },
    methods: {
        async onUpdate() {
            this.submitting = true;
            this.errorMessage = "";

            try {
                const { data } = await Service.update(
                    this.service.id,
                    this.service
                );

                this.service = _.deepClone(data);

                eventBus.$emit("updatedService", this.service);
            } catch (error) {
                const errors = error?.response?.data?.errors;

                [this.errorMessage] = Object.values(errors || {})[0] || [
                    "Failed to update service!"
                ];
            } finally {
                this.submitting = false;
            }
        }
    }
};
</script>

<style lang="scss">
p.description.text-center {
    font-size: 16px;
}
</style>
