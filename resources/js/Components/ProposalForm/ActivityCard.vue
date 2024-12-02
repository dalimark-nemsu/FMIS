<script setup>
    import { defineProps, ref, watch } from 'vue';

    const props = defineProps({
        activity: Object,
    });

    // Local state for activity data (editable in the component)
    const activityData = ref({
        title: props.activity.title,
        startDate: props.activity.startDate,
        endDate: props.activity.endDate,
        venue: props.activity.venue
    });

    const showBudgetary = ref(false);

    function toggleBudgetary() {
        showBudgetary.value = !showBudgetary.value;
    }

    // Watch for changes in props.activity and update local state
    watch(props.activity, (newVal) => {
        activityData.value = { ...newVal };
    });
</script>

<template>
    <div class="activity-card">
      <!-- Edit and Delete Icons in Top-Right Corner -->
      <div class="action-icons">
        <i class="fas fa-edit edit-icon" @click="$emit('edit-activity')"></i>
        <i class="fas fa-trash delete-icon" @click="$emit('delete-activity')"></i>
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

      <button
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
              <th>Description</th>
              <th>Unit of Measure</th>
              <th>Quantity</th>
              <th>Unit Cost</th>
              <th>Procurement Mode</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><input type="text" placeholder="Enter Description" class="table-input" /></td>
              <td><input type="text" placeholder="Enter Unit" class="table-input" /></td>
              <td><input type="number" placeholder="Qty" class="table-input" /></td>
              <td><input type="number" placeholder="Cost" class="table-input" /></td>
              <td><input type="text" placeholder="Enter Mode" class="table-input" /></td>
              <td><button class="action-button">Add</button></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
</template>
