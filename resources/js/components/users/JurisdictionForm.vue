<template>
    <form>
        <div class="row">
            <div class="col-md-12 pr-1">
                <div class="form-group">
                    <label for="jurisdiction">Select Jurisdiction</label>
                    <select class="form-control" id="jurisdiction" v-model="jurisdiction">
                        <option value="Tema">Tema</option>
                        <option value="Dansoman">Dansoman</option>
                        <option value="Ashaiman">Ashaiman</option>
                        <option value="Achimota">Achimota</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <button @click.prevent="onUpdateJurisdiction" class="form-control s" id="sbmt" role="button"
                    >Set jurisdiction
                    </button>
                </div>
            </div>
        </div>
    </form>
</template>
<script>
export default {
    name: "JurisdictionForm",
    props: ["selectedJurisdiction"],
    data() {
        return {
            jurisdiction: this.selectedJurisdiction
        };
    },
    methods: {
        onUpdateJurisdiction() {
            this.$emit('updateJurisdiction', this.jurisdiction);
        }
    }
}
</script>
