<template>
    <div class="activity-card">
      <h3>Activity Details</h3>
      <div class="activity-field" v-for="(field, index) in fields" :key="index">
        <label :for="field.id" class="field-label">{{ field.label }}</label>
        <input v-if="field.type !== 'date-range'" :type="field.type" :id="field.id" v-model="activity[field.key]" :placeholder="field.placeholder" class="input-field" />
        <div v-else class="date-range">
          <input type="date" v-model="activity.startDate" class="input-field date-input" />
          <span class="date-separator">to</span>
          <input type="date" v-model="activity.endDate" class="input-field date-input" />
        </div>
      </div>
      <button @click="$emit('create-activity')" class="create-button">New Activity</button>
    </div>
  </template>

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
