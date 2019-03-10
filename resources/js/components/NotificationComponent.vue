<template>
    <div class="d-flex align-items-center justify-content-between">
        <b>{{ notification.data.message }}</b>
        <button @click="markAsRead" class="ml-2 btn btn-danger btn-sm">
            <span v-if="!loading">&times;</span>
            <div v-else class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </button>
    </div>
</template>
<script>
import axios from 'axios';
export default {
    props: ['notification'],
    data() {
        return {
            loading: false
        }
    },
    methods: {
        markAsRead() {
            this.loading = true;
            axios.post('/notifications/read', {id: this.notification.id})
                .then(({data}) => {
                    this.loading = false;
                    this.$emit('read');
                });
        }
    }
}
</script>
