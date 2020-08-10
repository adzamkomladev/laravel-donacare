<template>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">User Account Details</h5>
                </div>
                <div class="card-body">
                    <ProfileForm
                        @updateProfile="onUpdateProfile($event)"
                        :selected-profile="user.profile"
                    />
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <UserDetailsCard :selected-user="user" />
        </div>
    </div>
</template>

<script>
import ProfileForm from "../../components/users/ProfileForm.vue";
import UserDetailsCard from "../../components/users/UserDetailsCard.vue";

import Profile from "../../services/profile";

export default {
    components: { ProfileForm, UserDetailsCard },
    props: ["selectedUser"],
    data() {
        return {
            user: this.selectedUser
        };
    },
    methods: {
        onUpdateProfile(profile) {
            Profile.update(profile.id, { ...profile })
                .then(response => {
                    const { data } = response;

                    this.user.profile = { ...data };

                    this.showNotification(
                        "fas fa-check",
                        "Your profile has been updated!",
                        "primary"
                    );
                })
                .catch(error => {
                    const errors = error?.response?.data?.errors;

                    const [message] = Object.values(errors || {})[0] || [
                        "Failed to update profile!"
                    ];

                    this.showNotification("fas fa-times", message, "danger");
                });
        },
        showNotification(icon, message, type) {
            $.notify({ icon, message }, { type, timer: 3000 });
        }
    }
};
</script>

<style></style>
