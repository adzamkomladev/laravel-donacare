<template>
    <transition name="fade" mode="out-in">
        <router-view></router-view>
    </transition>
</template>

<script>
import VueRouter from "vue-router";

import store from "../store";

import HospitalForm from "../components/donations/HospitalForm.vue";
import MedicalForm from "../components/donations/MedicalForm.vue";
import PaymentForm from "../components/donations/PaymentForm.vue";

export default {
    name: "CreateDonation",
    router: new VueRouter({
        mode: "history",
        base: "/donations/",
        routes: [
            {
                path: "/hospital",
                name: "hospital",
                component: HospitalForm
            },
            {
                path: "/",
                redirect: { name: "hospital" }
            },
            {
                path: "/medical",
                name: "medical",
                component: MedicalForm
            },
            {
                path: "/payment",
                name: "payment",
                component: PaymentForm
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
