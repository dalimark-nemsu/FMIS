<script setup>
    import { Link } from '@inertiajs/vue3';
    const props = defineProps({
        href:{
            type: String,
        }
    });
</script>
<template>
    <li class="nav-item">
        <Link class="nav-link" :href="href">
            <slot/>
        </Link>
    </li>
</template>