<template>
    <form>
        <div class="form-group">
            <label for="status">Status</label>
            <div class="input-group">
                <select
                    id="status"
                    class="form-control"
                    required
                    v-model="selectedStatus"
                >
                    <option
                        value="initiated"
                        :selected="selectedStatus === 'initiated'"
                        >Initiated</option
                    >
                    <option
                        value="incomplete"
                        :selected="selectedStatus === 'incomplete'"
                        >Incomplete</option
                    >
                    <option
                        value="assigned"
                        :selected="selectedStatus === 'assigned'"
                        >Assigned</option
                    >
                    <option
                        value="completed"
                        :selected="selectedStatus === 'completed'"
                        >Completed</option
                    >
                    <option value="done" :selected="selectedStatus === 'done'"
                        >Done</option
                    >
                    <option
                        value="pending"
                        :selected="selectedStatus === 'pending'"
                        >Pending</option
                    >
                </select>
            </div>
        </div>
        <button
            @click.prevent="onUpdateStatus"
            class="btn btn-primary btn-round mt-3"
        >
            Update status
        </button>
    </form>
</template>

<script>
import Auth from "../../services/auth";
import Donation from "../../services/donation";

export default {
    name: "UpdateStatusForm",
    props: ["donation"],
    data() {
        return {
            selectedStatus: this.donation.status
        };
    },
    methods: {
        async onUpdateStatus() {
            try {
                await Donation.updateStatus(this.donation.id, {
                    status: this.selectedStatus
                });
                this.showNotification(
                    "fas fa-check",
                    "Update status successfully!",
                    "primary"
                );
            } catch (error) {
                console.log(error);
                this.showNotification(
                    "fas fa-times",
                    "Failed to update status!",
                    "danger"
                );
            }
        },
        showNotification(icon, message, type) {
            $.notify({ icon, message }, { type, timer: 3000 });
        }
    }
};
</script>

<style></style>
