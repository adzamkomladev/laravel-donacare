<template>
    <div class="card">
        <div class="card-body px-4">
            <h3 class="card-title mb-5">Create profile</h3>
            <transition name="fade" mode="out-in">
                <router-view></router-view>
            </transition>
        </div>
    </div>
</template>

<script>
import VueRouter from "vue-router";

import store from "../store";

import PersonalForm from "../components/profiles/PersonalForm.vue";
import MedicalForm from "../components/profiles/MedicalForm.vue";
import ContactForm from "../components/profiles/ContactForm.vue";

export default {
    name: "CreateProfile",
    router: new VueRouter({
        mode: "history",
        base: "/profiles/",
        routes: [
            {
                path: "/personal",
                name: "personal",
                component: PersonalForm
            },
            {
                path: "/",
                redirect: { name: "personal" }
            },
            {
                path: "/medical",
                name: "medical",
                component: MedicalForm
            },
            {
                path: "/contact",
                name: "contact",
                component: ContactForm
            }
        ]
    }),
    store
};
</script>

<style lang="scss" scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active in <2.1.8 */ {
    opacity: 0;
}
</style>
