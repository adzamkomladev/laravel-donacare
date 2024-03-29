import Vue from "vue";
import Vuex from "vuex";

import profile from "./modules/profile";
import donation from "./modules/donation";
import hospitals from "./modules/hospitals";

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        profile,
        donation,
        hospitals
    }
});
