<template>
    <div>
        {{ notification.data.message }}
    </div>
</template>
<script>
export default {
    props: ['notification']
}
</script>
