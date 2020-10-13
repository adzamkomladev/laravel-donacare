<template>
    <transition name="fade">
        <tr v-if="canShow">
            <td class="text-left text-muted">
                <div v-if="isAdmin">
                    <i class="fas fa-user-cog fa-lg"></i>
                    <small>Admin</small>
                </div>
            </td>
            <td class="text-left">{{ user.profile.fullName }}</td>
            <td class="text-left">{{ user.telephone }}</td>
            <td>
                <div v-if="!isAdmin" class="form-check">
                    <label class="form-check-label">
                        <input
                            @click="onActivateUser"
                            class="form-check-input"
                            type="checkbox"
                            v-model="user.activated"
                        />
                        <span class="form-check-sign"></span>
                    </label>
                </div>
            </td>
            <td>
                <span class="badge badge-pill badge-success">Online</span>
            </td>
            <td class="td-actions text-right">
                <button
                    type="button"
                    rel="tooltip"
                    title=""
                    class="btn btn-info btn-round btn-icon btn-icon-mini btn-neutral"
                    data-original-title="View user"
                >
                    <a :href="showUserRoute">
                        <i class="now-ui-icons users_circle-08"></i>
                    </a>
                </button>
                <div class="btn-group dropleft">
                    <button
                        :disabled="isAdmin"
                        type="button"
                        class="btn btn-danger btn-round btn-icon btn-icon-mini btn-neutral"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                    >
                        <i
                            class="now-ui-icons ui-1_simple-remove"
                            title="Terminate this user"
                        ></i>
                    </button>
                    <div class="dropdown-menu p-2">
                        <small>
                            <strong>
                                Are you sure you want to terminate this user?
                            </strong>
                        </small>
                        <div class="d-flex justify-content-between p-2">
                            <button
                                @click.prevent="onTerminateUser"
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
import { UserService } from "../../common/api.service";

export default {
    props: ["rowUser"],
    data() {
        return {
            canShow: true,
            user: this.toCamelCase(_.cloneDeep(this.rowUser))
        };
    },
    computed: {
        isAdmin() {
            return this.user.role === "admin";
        },
        showUserRoute() {
            return `/users/${this.user.id}`;
        }
    },
    methods: {
        async onActivateUser() {
            try {
                await UserService.toggleActivation(this.user.id);

                this.showNotification(
                    "fas fa-check",
                    `User ${
                        this.user.activated ? "activated" : "deactivated"
                    } successfully!`,
                    "primary"
                );
            } catch (error) {
                this.user.activated = !this.user.activated;

                this.showNotification(
                    "fas fa-times",
                    `Failed to  ${
                        this.user.activated ? "deactivate" : "activate"
                    } user!`,
                    "danger"
                );
            }
        },
        onTerminateUser() {
            this.showNotification(
                "fas fa-check",
                "User terminated successfully!",
                "primary"
            );

            this.canShow = false;
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
