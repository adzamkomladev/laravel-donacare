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

            console.log({ response });
        });
    }
};
</script>

<style></style>
