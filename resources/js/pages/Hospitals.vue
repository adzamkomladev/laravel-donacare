<template>
    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">All Hospitals</h5>
                </div>
                <div class="card-body">
                    <AllHospitals />
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <CreateForm />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import store from "../store";

import AllHospitals from "../components/hospitals/AllHospitals";
import CreateForm from "../components/hospitals/CreateForm";

export default {
    name: "Hospitals",
    components: { AllHospitals, CreateForm },
    store,
    mounted() {
        store.dispatch("hospitals/initializeState");
    }
};
</script>
