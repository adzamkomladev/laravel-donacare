<template>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">User Account Details</h5>
                </div>
                <div class="card-body">
                    <ProfileForm />
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <UserDetailsCard />
        </div>
    </div>
</template>

<script>
import ProfileForm from "../../components/users/ProfileForm.vue";
import UserDetailsCard from "../../components/users/UserDetailsCard.vue";

export default {
    components: { ProfileForm, UserDetailsCard }
};
</script>

<style></style>
