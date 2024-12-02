<script setup>
import { defineProps, defineEmits, watch, ref } from "vue";

const props = defineProps({
  activity: Object,
});

const emit = defineEmits(["save-activity", "close-default"]);

// Local state for activity data (editable in the component)
const activityData = ref({ ...props.activity });

// Watch for changes in props.activity and update local state
watch(
  () => props.activity,
  (newVal) => {
    activityData.value = { ...newVal };
  },
  { immediate: true }
);

function saveActivity() {
  emit("save-activity", activityData.value); // Emit updated data to the parent
}

function closeDefaultCard() {
  emit("close-default"); // Notify parent to delete the card
}
</script>

<template>
  <div class="activity-card">
    <!-- Add Icon Above Title -->
    <div class="action-icons">
      <i class="fas fa-save save-icon" @click="saveActivity"></i>
      <i class="fas fa-times close-icon" @click="closeDefaultCard"></i>
    </div>

    <!-- Activity Fields -->
    <div class="activity-field">
      <label for="title" class="field-label">Title</label>
      <input
        type="text"
        id="title"
        v-model="activityData.title"
        placeholder="Enter Activity Title"
        class="input-field"
      />
    </div>

    <div class="activity-field">
      <label class="field-label">Schedule</label>
      <div class="date-range">
        <input
          type="date"
          v-model="activityData.startDate"
          class="input-field date-input"
          placeholder="Start Date"
        />
        <span class="date-separator">to</span>
        <input
          type="date"
          v-model="activityData.endDate"
          class="input-field date-input"
          placeholder="End Date"
        />
      </div>
    </div>

    <div class="activity-field">
      <label for="venue" class="field-label">Venue</label>
      <input
        type="text"
        id="venue"
        v-model="activityData.venue"
        placeholder="Enter Venue"
        class="input-field"
      />
    </div>
  </div>
</template>
