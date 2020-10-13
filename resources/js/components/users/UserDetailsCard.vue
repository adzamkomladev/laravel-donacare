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
                    <h5 class="title">{{ user.profile.fullName }}</h5>
                </a>
                <p class="description text-capitalize">
                    <i class="fas fa-user-tag"></i>
                    {{ user.role }}
                </p>
                <p
                    v-if="user.profile.homeAddress"
                    class="text-muted location-text"
                >
                    <i class="fas fa-map-marker-alt"></i>
                    Home address: {{ user.profile.homeAddress }}
                </p>
                <p class="text-muted location-text">
                    Blood group: {{ user.profile.bloodAroup }}
                </p>
                <p class="text-muted location-text">
                    Mobile money number: {{ user.profile.mobileMoneyNumber }}
                </p>
                <p class="text-muted location-text">
                    Mobile money name: {{ user.profile.mobileMoneyName }}
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
                this.user.profile.avatarImageUrl || "/img/avatar-default.png"
            );
        },
        avatarAlt() {
            return `${this.user.profile.fullName}'s avatar`;
        }
    }
};
</script>

<style lang="scss">
.location-text {
    font-size: 14px;
}
</style>
