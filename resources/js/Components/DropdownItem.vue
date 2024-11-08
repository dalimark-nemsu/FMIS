<script setup>
    const props = defineProps({
        text: {
            type: String,
        },
    });
</script>
<template>
    <li>
        <a class="dropdown-item" href="#">{{ text }}</a>
    </li>
</template>