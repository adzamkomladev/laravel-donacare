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
        libraries: "places,directions" // necessary for places input
    }
});

Vue.mixin({
    methods: {
        showNotification(icon, message, type) {
            $.notify({ icon, message }, { type, timer: 3000 });
        },
        toCamelCase(obj) {
            const traverseArr = arr => {
                arr.forEach(v => {
                    if (v) {
                        if (v.constructor === Object) {
                            this.toCamelCase(v);
                        } else if (v.constructor === Array) {
                            traverseArr(v);
                        }
                    }
                });
            };

            Object.keys(obj).forEach(k => {
                if (obj[k]) {
                    if (obj[k].constructor === Object) {
                        this.toCamelCase(obj[k]);
                    } else if (obj[k].constructor === Array) {
                        traverseArr(obj[k]);
                    }
                }

                const sck = _.camelCase(k);
                if (sck !== k) {
                    obj[sck] = obj[k];
                    delete obj[k];
                }
            });

            return obj;
        }
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
    require("./components/donations/DonorProximityMap.vue").default
);
Vue.component(
    "obtain-current-location",
    require("./components/auth/ObtainCurrentLocation.vue").default
);
Vue.component(
    "donation-row",
    require("./components/donations/DonationRow.vue").default
);
Vue.component(
    "update-status-form",
    require("./components/donations/UpdateStatusForm.vue").default
);
Vue.component(
    "navbar-actions",
    require("./components/layouts/NavbarActions.vue").default
);
Vue.component(
    "update-jurisdiction",
    require("./pages/users/UpdateJurisdiction.vue").default
);
Vue.component("create-donation", require("./pages/CreateDonation.vue").default);
Vue.component(
    "display-donors",
    require("./components/users/DisplayDonors.vue").default
);
Vue.component(
    "search-box",
    require("./components/layouts/SearchBox.vue").default
);
Vue.component("eta-map", require("./components/donations/ETAMap.vue").default);
Vue.component(
    "update-setting",
    require("./components/settings/UpdateSetting.vue").default
);
Vue.component("create-profile", require("./pages/CreateProfile.vue").default);
Vue.component("hospitals", require("./pages/Hospitals.vue").default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app"
});
