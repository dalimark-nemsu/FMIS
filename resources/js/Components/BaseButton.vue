<script setup>
    defineProps({
        type: {
            type: String,
            default: 'button' // Can be 'button', 'submit', or 'reset'
        },
        variant: {
            type: String,
            default: 'primary' // Use Bootstrap variants like 'primary', 'secondary', 'success', etc.
        },
        customClasses: {
            type: String,
            default: '' // Additional custom classes for more styling flexibility
        },
        disabled: {
            type: Boolean,
            default: false
        },
        icon: {
            type: String,
            default: '' // Icon class, e.g., 'bi bi-star' or 'fa fa-check'
        }
    });

    // Emit click event
    const emit = defineEmits(['click']);
    function handleClick(event) {
        if (!disabled) {
            emit('click', event);
        }
    }
</script>
<template>
    <button
        :class="['btn', `btn-${variant}`, customClasses]"
        :type="type"
        :disabled="disabled">
        <slot></slot>
    </button>
</template>