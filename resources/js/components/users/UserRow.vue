<template>
    <tr>
        <td class="text-left text-muted">
            <i class="fas fa-user-cog fa-lg"></i>
            <small>Admin</small>
        </td>
        <td class="text-left">Account name</td>
        <td class="text-left"></td>
        <td>
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" checked />
                    <span class="form-check-sign"></span>
                </label>
            </div>
        </td>
        <td>
            <span class="badge badge-pill badge-success">Online</span>
        </td>
        <td class="td-actions text-right">
            <button
                type="button"
                rel="tooltip"
                title=""
                class="btn btn-info btn-round btn-icon btn-icon-mini btn-neutral"
                data-original-title="Edit Task"
            >
                <a href="user.html"
                    ><i class="now-ui-icons users_circle-08"></i
                ></a>
            </button>
            <button
                type="button"
                rel="tooltip"
                title=""
                class="btn btn-danger btn-round btn-icon btn-icon-mini btn-neutral"
                data-original-title="Remove"
            >
                <i
                    class="now-ui-icons ui-1_simple-remove"
                    title="delete this user"
                ></i>
            </button>
        </td>
    </tr>
</template>

<script>
export default {
    mounted() {
        console.log("Component mounted.");
    }
};
</script>
