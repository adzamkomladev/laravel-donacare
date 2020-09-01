<template>
    <form @submit.prevent>
        <div class="input-group no-border">
            <input
                type="text"
                v-model="searchText"
                class="form-control"
                placeholder="Search..."
                @keyup.enter="onSearch()"
            />
            <div class="input-group-append">
                <div class="input-group-text">
                    <i class="now-ui-icons ui-1_zoom-bold"></i>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
import { eventBus } from "../../events/event-bus";

export default {
    name: "SearchBox",
    data() {
        return {
            searchText: ""
        };
    },
    methods: {
        onSearch() {
            eventBus.$emit("searchText", this.searchText);
        }
    }
};
</script>

<style></style>
