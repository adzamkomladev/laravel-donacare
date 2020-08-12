<template>
    <!-- Modal -->
    <div
        class="modal fade"
        id="service-details-modal"
        tabindex="-1"
        role="dialog"
    >
        <div class="modal-dialog" role="document">
            <div class="card card-user">
                <div class="image">
                    <img
                        src="/img/service-backdrop.jpg"
                        alt="Service backdrop"
                    />
                </div>
                <div class="card-body">
                    <div class="author mt-3">
                        <a>
                            <h5 class="title">{{ service.name }}</h5>
                        </a>
                        <p class="description">
                            <span>{{ formattedPrice }}</span>
                            <span
                                class="badge badge-pill"
                                :class="availabilityClass"
                            >
                                {{ availabilityText }}
                            </span>
                        </p>
                    </div>
                    <p class="description text-center mt-5">
                        {{ service.description }}
                    </p>
                </div>
                <hr />
                <div class="button-container">
                    <button
                        class="btn btn-neutral btn-icon btn-round btn-lg"
                        data-dismiss="modal"
                    >
                        <i class="fas fa-times fa-lg"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { eventBus } from "../../events/event-bus.js";

export default {
    name: "ServiceDetailsModal",
    created() {
        eventBus.$on("showServiceDetails", service => (this.service = service));
    },
    data() {
        return {
            service: {}
        };
    },
    computed: {
        formattedPrice() {
            return `GH₵ ${this.service.price}`;
        },
        availabilityClass() {
            return this.service.available ? "btn-success" : "btn-danger";
        },
        availabilityText() {
            return this.service.available ? "Available" : "Unavailable";
        }
    }
};
</script>

<style lang="scss">
p.description.text-center {
    font-size: 16px;
}
</style>
