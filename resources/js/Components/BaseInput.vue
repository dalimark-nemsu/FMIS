<script setup>
    defineProps({
        id: {
            type: String,
            required: true,
        },
        type: {
            type: String,
            default: 'text',
        },
        placeholder: {
            type: String,
            default: '',
        },
        modelValue: {
            type: String,
            default: '',
        },
        label: {
            type: String,
            default: '',
        },
        classes: {
            type: String,
            default: 'form-control',
        },
    });
</script>
<template>
        <input
            :id="id"
            :type="type"
            :placeholder="placeholder"
            :class="classes"
            :value="modelValue"
        />
        <label :for="id">{{ label }}</label>

</template>