<template>
    <div></div>
</template>

<script>
import Auth from "../../services/auth.js";
import Location from "../../services/location.js";

export default {
    mounted() {
        navigator.geolocation.getCurrentPosition(async position => {
            const data = {
                lat: position.coords.latitude,
                lng: position.coords.longitude,
                user_id: Auth.currentUser().id
            };

            const response = await Location.save(data);

            console.log(response, "first Location polling");
        });

        this.polling = setInterval(async () => {
            await navigator.geolocation.getCurrentPosition(async position => {
                const data = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude,
                    user_id: Auth.currentUser().id
                };

                const response = await Location.save(data);
            });
        }, 60000);
    },
    beforeDestroy() {
        clearInterval(this.polling);
    },
    data() {
        return {
            polling: null
        };
    }
};
</script>

<style></style>
