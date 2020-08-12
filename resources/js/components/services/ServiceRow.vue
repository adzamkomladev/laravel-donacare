<template>
    <transition name="fade">
        <tr v-if="canShow">
            <td class="text-left">{{ service.name }}</td>
            <td class="text-left">{{ service.price }}</td>
            <td class="text-left">
                <div v-if="isAdmin" class="form-check">
                    <label class="form-check-label">
                        <input
                            @click="onToggleAvailability"
                            class="form-check-input"
                            type="checkbox"
                            v-model="service.available"
                        />
                        <span class="form-check-sign"></span>
                    </label>
                </div>
            </td>
            <td class="text-left">
                <span v-if="isLow" class="badge badge-pill badge-danger">
                    4 requests
                </span>
                <span v-if="isMedium" class="badge badge-pill badge-warning">
                    8 requests
                </span>
                <span v-if="isHigh" class="badge badge-pill badge-success">
                    38 requests
                </span>
            </td>
            <td class="td-actions text-left">
                <div class="btn-group dropdown">
                    <button
                        type="button"
                        class="btn btn-info btn-round btn-icon btn-icon-mini btn-neutral"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                    >
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a
                            @click.prevent="onShowServiceDetails"
                            class="dropdown-item"
                            data-toggle="modal"
                            data-target="#service-details-modal"
                        >
                            Details
                        </a>
                        <a
                            v-if="isAdmin"
                            class="dropdown-item"
                            :href="updateServiceRoute"
                        >
                            Update
                        </a>
                    </div>
                </div>
                <div class="btn-group dropleft">
                    <button
                        :disabled="!isAdmin"
                        type="button"
                        class="btn btn-danger btn-round btn-icon btn-icon-mini btn-neutral"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                    >
                        <i
                            class="now-ui-icons ui-1_simple-remove"
                            title="Terminate this service"
                        ></i>
                    </button>
                    <div class="dropdown-menu p-2">
                        <small>
                            <strong>
                                Are you sure you want to terminate this service?
                            </strong>
                        </small>
                        <div class="d-flex justify-content-between p-2">
                            <button
                                @click.prevent="onTerminateservice"
                                class="btn btn-success btn-fab btn-icon btn-icon-mini btn-round"
                            >
                                <i class="fas fa-check"></i>
                            </button>
                            <button
                                class="btn btn-light btn-fab btn-icon btn-icon-mini btn-round"
                            >
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    </transition>
</template>

<script>
import { eventBus } from "../../events/event-bus.js";

import Auth from "../../services/auth.js";
import Service from "../../services/service.js";

export default {
    name: "ServiceRow",
    props: ["rowService"],
    data() {
        return {
            canShow: true,
            service: this.rowService
        };
    },
    computed: {
        isAdmin() {
            return Auth.currentUser().role === "admin";
        },
        updateServiceRoute() {
            return `/services/${this.service.id}/edit`;
        },
        isLow() {
            return this.service.id < 5;
        },
        isMedium() {
            return !this.isLow && this.service.id < 15;
        },
        isHigh() {
            return !this.isLow && !this.isMedium;
        }
    },
    methods: {
        onShowServiceDetails() {
            eventBus.$emit("showServiceDetails", this.service);
        },
        async onToggleAvailability() {
            try {
                await Service.toggleAvailability(this.service.id);

                this.showNotification(
                    "fas fa-check",
                    `Service made ${
                        this.service.available ? "available" : "unavailable"
                    }!`,
                    "primary"
                );
            } catch (error) {
                this.service.available = !this.service.available;

                this.showNotification(
                    "fas fa-times",
                    `Failed to make service ${
                        this.service.available ? "unavailable" : "available"
                    }!`,
                    "danger"
                );
            }
        },
        onTerminateService() {
            this.showNotification(
                "fas fa-check",
                "Service terminated successfully!",
                "primary"
            );

            this.canShow = false;
        },
        showNotification(icon, message, type) {
            $.notify({ icon, message }, { type, timer: 3000 });
        }
    }
};
</script>
<style lang="scss" scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.8s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
    opacity: 0;
}
</style>
