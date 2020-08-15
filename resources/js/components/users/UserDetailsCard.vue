<template>
    <div class="card card-user">
        <div class="image">
            <img src="/img/avatar-backdrop.jpg" alt="Avatar backdrop" />
        </div>
        <div class="card-body">
            <div class="author">
                <a :href="avatarUrl">
                    <img
                        class="avatar border-gray"
                        :src="avatarUrl"
                        :alt="avatarAlt"
                    />
                    <h5 class="title">{{ user.profile.full_name }}</h5>
                </a>
                <p class="description text-capitalize">
                    <i class="fas fa-user-tag"></i>
                    {{ user.role }}
                </p>
                <p class="text-muted location-text">
                    <i class="fas fa-map-marker-alt"></i>
                    Recent location: Accra old Essuman road, 134.
                </p>
            </div>
        </div>
        <hr />
        <div class="button-container">
            <button href="#" class="btn btn-neutral btn-icon btn-round btn-lg">
                <i class="fab fa-facebook-f"></i>
            </button>
            <button href="#" class="btn btn-neutral btn-icon btn-round btn-lg">
                <i class="fab fa-twitter"></i>
            </button>
            <button href="#" class="btn btn-neutral btn-icon btn-round btn-lg">
                <i class="fab fa-google-plus-g"></i>
            </button>
        </div>
    </div>
</template>

<script>
export default {
    props: ["user"],
    computed: {
        avatarUrl() {
            return (
                this.user.profile.avatar_image_url || "/img/avatar-default.png"
            );
        },
        avatarAlt() {
            return `${this.user.profile.full_name}'s avatar`;
        }
    }
};
</script>

<style lang="scss">
.location-text {
    font-size: 14px;
}
</style>
