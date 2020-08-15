<template>
    <transition name="fade">
        <tr v-if="canShow">
            <td class="text-left">complaint name</td>
            <td class="text-left">
<!--                <template v-if="isAdmin">-->
                    <a
                        @click.prevent="onSelectComplaint"
                        class="btn btn-round btn-primary"
                        data-toggle="modal"
                        data-target="#complaint-update-modal"
                    >
                        {{ complaint.title }}(click to take action)
                    </a>
               <!-- </template>
                <template v-else class="form-check">
                    {{ complaint.title }}
                </template>-->
            </td>
            <td class="text-left">
                <span v-if="isAddressed" class="text-success">{{ complaint.status }}</span>
                <span v-else class="text-danger">{{ complaint.status }}</span>
            </td>
            <td class="text-right">{{ complaint.log_date }}</td>
            <td class="text-right">{{ complaint.address_date }}</td>
        </tr>
    </transition>
</template>

<script>
    import {eventBus} from "../../events/event-bus";
    import Auth from "../../services/auth";

    export default {
        name: "ComplaintRow",
        props: ["rowComplaint"],
        created() {
            eventBus.$on("updatedComplaint", complaint => {
                if (this.complaint.id === complaint.id) {
                    this.complaint = { ...complaint };
                }
            });
        },
        data() {
            return {
                complaint: this.rowComplaint
            };
        },
        computed: {
            isAdmin() {
                return Auth.currentUser().role === "admin";
            },
            canShow() {
                return Auth.currentUser().role === "admin" || this.rowComplaint.id === Auth.currentUser().id;
            },
            isAddressed() {
                return this.complaint.status === "addressed";
            },
        },
        methods: {
            onSelectComplaint() {
                eventBus.$emit("selectedComplaint", { ...this.complaint });
                console.log('clicked')
            },
        }
    }
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
