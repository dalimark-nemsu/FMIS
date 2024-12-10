<script setup>
import { ref, defineProps, defineEmits, watch } from "vue";
import 'flatpickr/dist/flatpickr.css';
import Flatpickr from "vue-flatpickr-component";

const props = defineProps({
  activity: Object,
});

const emit = defineEmits(["save-activity", "close-default"]);

// Local state for activity data
const activityData = ref({ ...props.activity });

// Watch for changes in props.activity and update local state
watch(
  () => props.activity,
  (newVal) => {
    activityData.value = { ...newVal };
  },
  { immediate: true }
);

// Emit the updated activity
function saveActivity() {
  emit("save-activity", activityData.value);
}

// Emit to close the default card
function closeDefaultCard() {
  emit("close-default");
}
</script>

<template>
  <div class="activity-card">
    <!-- Action Icons -->
    <div class="action-icons">
      <i class="fas fa-save save-icon" @click="saveActivity"></i>
      <i class="fas fa-times close-icon" @click="closeDefaultCard"></i>
    </div>

    <!-- Activity Title -->
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

    <!-- Date Range Picker -->
    <div class="activity-field">
      <label class="field-label">Schedule</label>
      <Flatpickr
        v-model="activityData.dateRange"
        :config="{
          mode: 'range',
          dateFormat: 'm/d/Y',
        }"
        class="input-field"
      />
    </div>

    <!-- Activity Venue -->
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
