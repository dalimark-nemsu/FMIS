<script setup>
import { defineProps, ref, watch, computed } from "vue";
import axios from "axios"; // Import Axios for API requests
import debounce from "lodash/debounce"; // Import debounce for optimized API calls
import "flatpickr/dist/flatpickr.css";
import Swal from "sweetalert2"; // Import SweetAlert2
import Flatpickr from "vue-flatpickr-component";

const props = defineProps({
  activity: Object, // Activity data from the parent
  proposalId: Number, // The associated proposal ID
});

const emit = defineEmits(["delete-activity"]); // Use emit for event handling

const activityData = ref({
  title: props.activity.activity_title,
  dateRange: props.activity.activity_date_schedule,
  venue: props.activity.activity_venue,
});

const showBudgetary = ref(false);

function toggleBudgetary() {
  showBudgetary.value = !showBudgetary.value;
}

// Watch for changes in props.activity and update local state
watch(props.activity, (newVal) => {
  activityData.value = { ...newVal };
});

// Computed property to check if the Budgetary Requirements button should be shown
const shouldShowBudgetaryButton = computed(() => {
  return (
    activityData.value.title !== null &&
    activityData.value.dateRange !== null &&
    activityData.value.venue !== null
  );
});

// Debounced function to save a single field to the server
const saveField = debounce((field, value) => {
  axios
    .put(`/proposals/${props.proposalId}/activities/${props.activity.id}`, { [field]: value })
    .catch((error) => {
      console.error(`Error updating ${field}:`, error);
    });
}, 500); // Adjust debounce delay as needed

// Watch for changes in each field and save updates to the server
watch(
  () => activityData.value.title,
  (newTitle) => saveField("title", newTitle)
);

watch(
  () => activityData.value.dateRange,
  (newDateRange) => saveField("dateRange", newDateRange)
);

watch(
  () => activityData.value.venue,
  (newVenue) => saveField("venue", newVenue)
);

// Function to confirm deletion
function confirmDelete() {
  Swal.fire({
    title: "Are you sure?",
    text: `Do you really want to delete the activity "${activityData._rawValue.title}"?`,
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Yes, delete it!",
  }).then((result) => {
    if (result.isConfirmed) {
      // Emit the delete event to the parent
      emit("delete-activity", props.activity.id);

      // Display success message
      Swal.fire({
        title: "Deleted!",
        text: `The activity "${activityData._rawValue.title}" has been deleted.`,
        icon: "success",
        timer: 1500,
        showConfirmButton: false,
      });
    }
  });
}

function autoResize(event) {
  const textarea = event.target;
  textarea.style.height = 'auto'; // Reset height
  textarea.style.height = `${textarea.scrollHeight}px`; // Adjust height based on content
}
</script>

<template>
  <div class="activity-card">
    <div class="action-icons">
        <!-- <i class="fas fa-trash delete-icon" @click="$emit('delete-activity')"></i> -->
        <i class="fas fa-trash delete-icon" @click="confirmDelete"></i>
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

    <!-- Date Range Picker -->
    <div class="activity-field">
      <label class="field-label">Schedule</label>
      <Flatpickr
        v-model="activityData.dateRange"
        :config="{
          mode: 'range',
          dateFormat: 'm/d/Y',
          locale: {
            rangeSeparator: ' - ',
          },
        }"
        class="input-field"
      />
    </div>

    <!-- Venue Field -->
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

    <!-- Budgetary Requirements Button -->
    <button
      v-if="shouldShowBudgetaryButton"
      class="accordion-button"
      :class="{ collapsed: !showBudgetary }"
      type="button"
      @click="toggleBudgetary"
      aria-expanded="showBudgetary"
      aria-controls="budgetary-content"
    >
      Budgetary Requirements
    </button>

    <!-- Accordion Content -->
    <div v-if="showBudgetary" class="accordion-content" id="budgetary-content">
        <table class="budget-table">
        <thead>
            <tr>
            <th class="description-column">Description</th>
            <th class="uom-column">Unit of Measure</th>
            <th class="quantity-column">Quantity</th>
            <th class="unit-cost-column">Unit Cost</th>
            <th class="procurement-mode-column">Procurement Mode</th>
            <th class="action-column">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <td><textarea placeholder="Enter Description" class="table-textarea" rows="1" @input="autoResize"></textarea></td>
            <td><input type="text" placeholder="Enter Unit" class="table-input" /></td>
            <td><input type="number" placeholder="Qty" class="table-input" /></td>
            <td><input type="number" placeholder="Cost" class="table-input" /></td>
            <td><input type="text" placeholder="Enter Mode" class="table-input" /></td>
            <td><button class="action-button"><i class="fas fa-plus"></i></button></td>
            </tr>
        </tbody>
        </table>
    </div>

  </div>
</template>
