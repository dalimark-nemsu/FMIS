<script setup>
import { update } from 'lodash';
import { ref } from 'vue';

    const props = defineProps({
        id: { type: String, required: true },
        options: { type: Array, required: true }, // Array of objects with { value: '', text: '' }
        placeholder: { type: String, default: 'Select an option' },
        label: { type: String, required: true },
        classes: { type: String, default: '' },
        modelValue: {
            type: String,
            required: true
        }
    });

    defineEmits(['update:modelValue']);

</script>
<template>
    <select :id="id" class="form-select" :class="classes" aria-label="select input" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)">
        <option v-if="placeholder" disabled value="">{{ placeholder }}</option>
        <option v-for="option in options" :key="option.value" :value="option.value">
            {{ option.text }}
        </option>
    </select>
    <label :for="id">{{ label }}</label>
</template>