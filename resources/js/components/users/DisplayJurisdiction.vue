<template>
    <div class="card card-user">
        <div class="card-body">
            <table class="table">
                <thead class=" text-primary">
                <th>Working Jurisdiction</th>
                </thead>
                <tbody>
                <tr>
                    <td>{{ jurisdiction }}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <hr>
        <div class="button-container">
            <button class="btn btn-neutral btn-icon btn-round btn-lg" href="#">
                <i class="fab fa-facebook-f"></i>
            </button>
            <button class="btn btn-neutral btn-icon btn-round btn-lg" href="#">
                <i class="fab fa-twitter"></i>
            </button>
            <button class="btn btn-neutral btn-icon btn-round btn-lg" href="#">
                <i class="fab fa-google-plus-g"></i>
            </button>
        </div>
    </div>
</template>

<script>
export default {
    name: "DisplayJurisdiction",
    props: ['jurisdiction']
}
</script>

<style scoped>

</style>
