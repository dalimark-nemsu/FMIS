<script setup>
    const props = defineProps({
        id: {
            type: String,
            required: true,
        },
        title: {
            type: String,
            default: '',
        },
        position: {
            type: String,
            default: 'offcanvas-end', // Can be 'offcanvas-start', 'offcanvas-top', etc.
        },
        color: {
            type: String,
            default: '', // Can be 'offcanvas-start', 'offcanvas-top', etc.
        },
        backdrop: {
            type: Boolean,
            default: true,
        },
        width: {
            type: String,
            default: '600px',
        },
    });
</script>
<template>
    <div :class="`offcanvas ${position} ${color}`" :tabindex="-1" :id="id" :aria-labelledby="`${id}Label`" :style="{ width }">
        <div class="offcanvas-header">
            <h5 :id="`${id}Label`" class="fw-bold">{{ title }}</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <slot/>
    </div>
</template>
<style scoped>

</style>