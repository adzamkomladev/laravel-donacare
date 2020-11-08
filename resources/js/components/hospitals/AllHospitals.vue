<template>
    <div class="table-responsive">
        <table class="table">
            <thead class="text-primary">
                <th>Name</th>
                <th>Address</th>
                <th>Activated</th>
            </thead>
            <tbody>
                <tr v-for="(hospital, index) in hospitals" :key="index">
                    <td>{{ hospital.location.name }}</td>
                    <td>{{ hospital.location.address }}</td>
                    <td>
                        {{ hospital.activated ? "Activated" : "Unactivated" }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import { mapGetters } from "vuex";
export default {
    name: "AllHospitals",
    computed: {
        ...mapGetters("hospitals", ["hospitals"])
    }
};
</script>

<style></style>
