<script setup>
import { defineProps } from 'vue';

const props = defineProps({
activity: Object,
});

const fields = [
{ label: "Title", key: "title", id: "title1", type: "text", placeholder: "Enter Activity Title" },
{ label: "Schedule", key: "schedule", id: "schedule", type: "date-range" },
{ label: "Venue", key: "venue", id: "venue1", type: "text", placeholder: "Enter Venue" }
];
</script>

<template>
    <div class="activity-header-card">
      <div class="activity-header">
        <h3 class="activity-title">List of Activities</h3>
      </div>
    </div>
</template>


