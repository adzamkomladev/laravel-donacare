/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");

/**
 * Initialize google maps
 */
import * as VueGoogleMaps from "vue2-google-maps";

Vue.use(VueGoogleMaps, {
    load: {
        key: "AIzaSyC3bknNVeAMEeU6JHH-3DthopwZFJ15LYw",
        libraries: "places" // necessary for places input
    }
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component("user-row", require("./components/users/UserRow.vue").default);
Vue.component("show-user", require("./pages/users/ShowUser.vue").default);
Vue.component(
    "service-row",
    require("./components/services/ServiceRow.vue").default
);
Vue.component(
    "service-details-modal",
    require("./components/services/ServiceDetailsModal.vue").default
);
Vue.component(
    "service-update-modal",
    require("./components/services/ServiceUpdateModal.vue").default
);
Vue.component(
    "complaint-row",
    require("./components/complaints/ComplaintRow.vue").default
);
Vue.component(
    "complaint-update-modal",
    require("./components/complaints/ComplaintUpdateModal.vue").default
);
Vue.component(
    "donor-proximity-map",
    require("./components/service-requests/DonorProximityMap.vue").default
);
Vue.component(
    "obtain-current-location",
    require("./components/auth/ObtainCurrentLocation.vue").default
);
Vue.component(
    "service-request-row",
    require("./components/service-requests/ServiceRequestRow.vue").default
);
Vue.component(
    "update-status-form",
    require("./components/service-requests/UpdateStatusForm.vue").default
);
Vue.component(
    "navbar-actions",
    require("./components/layouts/NavbarActions.vue").default
);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app"
});
