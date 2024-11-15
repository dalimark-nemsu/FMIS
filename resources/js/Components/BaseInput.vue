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

    // defineEmits(['update:modelValue']);
    const emit = defineEmits(['update:modelValue', 'input']);
</script>
<template>
        <input
            :id="id"
            :type="type"
            :placeholder="placeholder"
            :class="classes"
            :value="modelValue"
           @input="$emit('update:modelValue', $event.target.value); $emit('input', $event)"
        />
        <label :for="id">{{ label }}</label>

</template>