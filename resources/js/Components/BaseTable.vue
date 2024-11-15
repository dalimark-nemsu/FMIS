<script setup>
    import { ref } from 'vue';

    // Define props for dynamic table configuration
    const props = defineProps({
        headers: {
            type: Array,
            required: true,
        },
        data: {
            type: Array,
            required: true,
        },
        striped: {
            type: Boolean,
            default: false,
        },
        hover: {
            type: Boolean,
            default: false,
        }
    });
</script>
<template>
        <table class="table" :class="{'table-striped': striped, 'table-hover': hover}">
            <thead>
                <tr>
                    <th v-for="(header, index) in headers" :key="index" :class="header.class">{{ header.label }}</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(row, index) in data" 
                    :key="index" 
                    :class="{ 'active-row': selectedRow === index }" 
                    @click="selectRow(index)">
                    <td v-for="(header, colIndex) in headers" :key="colIndex">
                        {{ row[header.key] }}
                    </td>
                </tr>
            </tbody>
        </table>
</template>