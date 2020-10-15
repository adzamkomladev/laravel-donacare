<template>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="title text-capitalize">{{ user.role }} Account Details</h5>
                </div>
                <div class="card-body">
                    <ProfileForm
                        @updateProfile="onUpdateProfile($event)"
                        :selected-profile="user.profile"
                        :can-update-profile="canUpdateProfile"
                    />
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <UserDetailsCard :user="user" />
        </div>
    </div>
</template>

<script>
import ProfileForm from "../../components/users/ProfileForm.vue";
import UserDetailsCard from "../../components/users/UserDetailsCard.vue";

import { ProfileService, Auth } from '../../common/api.service';

export default {
    components: { ProfileForm, UserDetailsCard },
    props: ["selectedUser"],
    data() {
        return {
            user: this.toCamelCase(_.cloneDeep(this.selectedUser))
        };
    },
    methods: {
        onUpdateProfile(profile) {
            ProfileService.update(profile.id, _.clone(profile))
                .then(response => {
                    const { data } = response;

                    this.user.profile = _.cloneDeep(data);

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
        }
    },
    computed: {
        canUpdateProfile() {
            return Auth.currentUser().id === this.user.id;
        }
    }
};
</script>

<style></style>
