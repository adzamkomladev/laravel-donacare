<template>
    <form>
        <div class="row">
            <div class="col-md-6 pr-1">
                <div class="form-group">
                    <label>First name</label>
                    <input
                        type="text"
                        class="form-control"
                        v-model="profile.first_name"
                        placeholder="Your first name"
                        required
                    />
                </div>
            </div>
            <div class="col-md-6 pl-1">
                <div class="form-group">
                    <label>Last name</label>
                    <input
                        type="text"
                        class="form-control"
                        v-model="profile.last_name"
                        placeholder="Your last name"
                        required
                    />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Other names</label>
                    <input
                        type="text"
                        class="form-control"
                        v-model="profile.other_names"
                        placeholder="Your other names"
                        required
                    />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 pr-1">
                <div class="form-group">
                    <label>Date of birth</label>
                    <input
                        type="date"
                        class="form-control"
                        placeholder="Your date of birth"
                    />
                </div>
            </div>
            <div class="col-md-8 px-1">
                <div class="form-group">
                    <label>Home address</label>
                    <input
                        type="text"
                        class="form-control"
                        placeholder="Your home address"
                    />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>About Me</label>
                    <textarea
                        rows="4"
                        cols="80"
                        class="form-control"
                        placeholder="Here can be your description"
                        value="Mike"
                    >
                    </textarea>
                </div>
            </div>
        </div>

        <button
            @click.prevent="onUpdateProfile()"
            class="btn btn-primary btn-round"
        >
            Update
        </button>
    </form>
</template>

<script>
export default {
    props: ["selectedProfile"],
    data() {
        return {
            profile: this.selectedProfile
        };
    },
    methods: {
        onUpdateProfile() {
            this.$emit("updateProfile", this.profile);
        }
    }
};
</script>

<style></style>
