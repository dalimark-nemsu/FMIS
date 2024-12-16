<script setup>
import { defineProps, ref, watch, computed, onMounted } from "vue";
import axios from "axios";
import debounce from "lodash/debounce";
import Swal from "sweetalert2";
import "flatpickr/dist/flatpickr.css";
import Flatpickr from "vue-flatpickr-component";
import ShoppingFormOffcanvas from "../ShoppingFormOffcanvas.vue";

const shoppingOffcanvas = ref(null);

// Props and Emits
const props = defineProps({
  activity: Object,
  proposalId: Number,
});

const emit = defineEmits(["delete-activity"]);

// Reactive Data
const activityData = ref({
  title: props.activity.activity_title,
  dateRange: props.activity.activity_date_schedule,
  venue: props.activity.activity_venue,
});

const showBudgetary = ref(false);

const budgetaryRequirements = ref([
  {
    general_description: "",
    uom: "",
    quantity: null,
    unit_cost: null,
    procurement_mode_id: "",
    editable: true,
  },
]);

const openDropdownIndex = ref(null);

// Computed Properties
const shouldShowBudgetaryButton = computed(() => {
  const { title, dateRange, venue } = activityData.value;
  return title && dateRange && venue;
});

const selectedItems = computed(() =>
  budgetaryRequirements.value.filter((item, index) => index !== 0 && item.selected)
);

// Functions
const toggleBudgetary = () => (showBudgetary.value = !showBudgetary.value);

const saveField = debounce(async (field, value) => {
  try {
    await axios.put(`/proposals/${props.proposalId}/activities/${props.activity.id}`, {
      [field]: value,
    });
  } catch (error) {
    console.error(`Error updating ${field}:`, error);
  }
}, 500);

const confirmDeleteActivity = () => {
  Swal.fire({
    title: "Are you sure?",
    text: `Do you really want to delete the activity "${activityData.value.title}"?`,
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Yes, delete it!",
  }).then((result) => {
    if (result.isConfirmed) {
      emit("delete-activity", props.activity.id);
      Swal.fire("Deleted!", `The activity has been deleted.`, "success");
    }
  });
};

const loadBudgetaryRequirements = async () => {
  try {
    const response = await axios.get(`/activities/${props.activity.id}/budgetary-requirements`);
    budgetaryRequirements.value = [
      budgetaryRequirements.value[0],
      ...response.data.budgetaryRequirements.map((item) => ({
        ...item,
        editable: false,
        selected: false,
      })),
    ];
  } catch (error) {
    console.error("Error fetching budgetary requirements:", error);
    Swal.fire("Error", "Failed to load budgetary requirements.", "error");
  }
};

const toggleEdit = (index) => {
  budgetaryRequirements.value[index].editable = !budgetaryRequirements.value[index].editable;
  openDropdownIndex.value = null;
};

const saveRow = async (index) => {
  const row = budgetaryRequirements.value[index];
  if (!row.general_description || !row.uom || !row.quantity || !row.unit_cost) {
    Swal.fire("Error", "All fields are required.", "error");
    return;
  }

  try {
    const endpoint = `/activities/${props.activity.id}/budgetary-requirements`;
    const response = await axios.post(endpoint, {
      id: row.id || null,
      general_description: row.general_description,
      uom: row.uom,
      quantity: row.quantity,
      unit_cost: row.unit_cost,
    });

    if (index === 0) {
      budgetaryRequirements.value.push({
        ...response.data.budgetaryRequirement,
        editable: false,
        selected: false,
      });
      budgetaryRequirements.value[0] = {
        general_description: "",
        uom: "",
        quantity: null,
        unit_cost: null,
        procurement_mode_id: "",
        editable: true,
      };
    } else {
      budgetaryRequirements.value[index] = {
        ...response.data.budgetaryRequirement,
        editable: false,
      };
    }
    Swal.fire("Success", response.data.message, "success");
  } catch (error) {
    console.error("Error saving row:", error);
    Swal.fire("Error", "Failed to save. Please try again.", "error");
  }
};

const confirmDeleteRow = (index) => {
  const row = budgetaryRequirements.value[index];
  Swal.fire({
    title: "Are you sure?",
    text: `Do you want to delete "${row.general_description}"?`,
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Yes, delete it!",
  }).then((result) => {
    if (result.isConfirmed) {
      deleteRow(index);
    }
  });
};

const deleteRow = async (index) => {
  const row = budgetaryRequirements.value[index];
  try {
    await axios.delete(`/activities/${props.activity.id}/budgetary-requirements/${row.id}`);
    budgetaryRequirements.value.splice(index, 1);
    Swal.fire("Deleted!", `"${row.general_description}" has been deleted.`, "success");
  } catch (error) {
    console.error("Error deleting row:", error);
    Swal.fire("Error", "Failed to delete. Please try again.", "error");
  }
};

const calculateTotal = computed(() => {
  return budgetaryRequirements.value
    .slice(1) // Exclude the default input row
    .reduce((sum, item) => sum + (item.quantity || 0) * (item.unit_cost || 0), 0)
    .toLocaleString("en-US", { style: "currency", currency: "PHP" });
});

// Watchers
watch(() => activityData.value.title, (newValue) => saveField("title", newValue));
watch(() => activityData.value.dateRange, (newValue) => saveField("dateRange", newValue));
watch(() => activityData.value.venue, (newValue) => saveField("venue", newValue));


// Listen for added items
function handleAddItems(items) {
  // Map the selected items to the budgetary requirements structure
  const newRows = items.map((item) => ({
    general_description: item.general_description || item.description,
    uom: item.uom || item.unit,
    quantity: item.quantity || 1, // Default to 1 if no quantity is provided
    unit_cost: item.unit_cost || item.price,
    procurement_mode_id: "", // Default value or empty
    editable: false,
  }));

  // Add the new rows to the budgetaryRequirements array
  budgetaryRequirements.value.push(...newRows);

  // Success feedback
  Swal.fire("Success", "Items added to budgetary requirements table.", "success");
}


console.log("Activity data in ActivityCard:", props.activity);


const openShoppingOffcanvas = (activityId) => {
  console.log("Opening shopping offcanvas with activityId:", activityId);
  if (shoppingOffcanvas.value) {
    shoppingOffcanvas.value.openOffcanvas(activityId); // Pass activityId
  } else {
    console.error("shoppingOffcanvas reference is not defined.");
  }
};

// Lifecycle Hooks
onMounted(loadBudgetaryRequirements);
</script>

<template>
  <div class="activity-card">
    <div class="action-icons">
        <!-- <i class="fas fa-trash delete-icon" @click="$emit('delete-activity')"></i> -->
        <i class="fas fa-trash delete-icon" @click="confirmDeleteActivity"></i>
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
        <div class="accordion-header">
            <!-- Total Section -->
            <div class="total-display">
                <span class="total-label">Total:</span>
                <span class="total-amount">{{ calculateTotal }}</span>
            </div>

            <!-- Buttons Section -->
            <div class="accordion-header-buttons">
                <button class="btn btn-charge-fund" @click="handleChargeFund">
                    <i class="fas fa-wallet"></i> Charge Fund
                </button>
                <!-- Shopping Button -->
                <button class="btn btn-shopping" @click="openShoppingOffcanvas(props.activity.id)">
                <i class="fas fa-shopping-cart"></i> Shopping
                </button>

                <!-- Shopping Form Offcanvas -->
                <ShoppingFormOffcanvas
                ref="shoppingOffcanvas"
                :activity-id="props.activity.id"
                @add-items="handleAddItems"
                />
            </div>
        </div>

      <table class="budget-table">
        <thead>
          <tr>
            <th class="checkbox-column">
                <input
                    type="checkbox"
                />
            </th>
            <th class="description-column">Description</th>
            <th class="uom-column">Unit of Measure</th>
            <th class="quantity-column">Quantity</th>
            <th class="unit-cost-column">Unit Cost</th>
            <th class="procurement-mode-column">Procurement Mode</th>
            <th class="action-column">Action</th>
          </tr>
        </thead>
        <tbody>
          <!-- Default Input Field -->
          <tr>
            <td ></td>
            <td class="description-column">
              <textarea
                v-model="budgetaryRequirements[0].general_description"
                placeholder="Enter Description"
                class="table-textarea"
              ></textarea>
            </td>
            <td class="uom-column">
              <input
                type="text"
                v-model="budgetaryRequirements[0].uom"
                placeholder="Enter Unit"
                class="table-input"
              />
            </td>
            <td class="quantity-column">
              <input
                type="number"
                v-model="budgetaryRequirements[0].quantity"
                placeholder="Qty"
                class="table-input"
              />
            </td>
            <td class="unit-cost-column">
              <input
                type="number"
                v-model="budgetaryRequirements[0].unit_cost"
                placeholder="Cost"
                class="table-input"
              />
            </td>
            <td class="procurement-mode-column">
              <input
                type="text"
                v-model="budgetaryRequirements[0].procurement_mode_id"
                placeholder="Mode"
                class="table-input"
              />
            </td>
            <td class="action-column text-center">
              <button class="action-button" @click="saveRow(0)">
                <i class="fas fa-plus"></i>
              </button>
            </td>
          </tr>

          <!-- Existing Rows -->
          <tr v-for="(budget, index) in budgetaryRequirements.slice(1)" :key="budget.id || index">
            <td class="checkbox-column">
                <input
                    type="checkbox"
                    v-model="budget.selected"
                    :id="'checkbox-' + (budget.id || index)"
                />
            </td>
            <td class="description-column non-editable-cell">
              <template v-if="budget.editable">
                <textarea v-model="budget.general_description" class="table-textarea"></textarea>
              </template>
              <template v-else>
                {{ budget.general_description }}
              </template>
            </td>
            <td class="uom-column non-editable-cell">
              <template v-if="budget.editable">
                <input type="text" v-model="budget.uom" class="table-input" />
              </template>
              <template v-else>
                {{ budget.uom }}
              </template>
            </td>
            <td class="quantity-column non-editable-cell">
              <template v-if="budget.editable">
                <input type="number" v-model="budget.quantity" class="table-input" />
              </template>
              <template v-else>
                {{ budget.quantity }}
              </template>
            </td>
            <td class="unit-cost-column non-editable-cell">
              <template v-if="budget.editable">
                <input type="number" v-model="budget.unit_cost" class="table-input" />
              </template>
              <template v-else>
                {{ budget.unit_cost }}
              </template>
            </td>
            <td class="procurement-mode-column non-editable-cell">
              <template v-if="budget.editable">
                <input type="text" v-model="budget.procurement_mode_id" class="table-input" />
              </template>
              <template v-else>
                {{ budget.procurement_mode_id }}
              </template>
            </td>
            <td class="action-column text-center">
                <div v-if="!budget.editable">
                    <!-- Ellipsis Button (when not editing) -->
                    <div class="dropdown">
                    <button
                        class="btn"
                        type="button"
                        id="dropdownMenuButton"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                    >
                        ⋮
                    </button>
                    <ul
                        class="dropdown-menu dropdown-menu-end shadow"
                        aria-labelledby="dropdownMenuButton"
                        style="min-width: 150px; max-width: 200px;"
                    >
                        <li>
                        <button
                            class="dropdown-item d-flex align-items-center gap-2"
                            @click="toggleEdit(index + 1)"
                        >
                            <i class="fas fa-edit text-secondary"></i> Edit
                        </button>
                        </li>
                        <li>
                        <button
                            class="dropdown-item d-flex align-items-center gap-2"
                            @click="scheduleRow(index + 1)"
                        >
                            <i class="fas fa-calendar-alt text-secondary"></i> Schedule
                        </button>
                        </li>
                        <li>
                        <hr class="dropdown-divider" />
                        </li>
                        <li>
                        <button
                            class="dropdown-item d-flex align-items-center gap-2"
                            @click="confirmDeleteRow(index + 1)"
                        >
                            <i class="fas fa-trash text-secondary"></i> Delete
                        </button>
                        </li>
                    </ul>
                    </div>
                </div>

                <div v-else>
                    <!-- Save Button (when editing) -->
                    <button class="action-button save-button" @click="saveRow(index + 1)">
                    <i class="fas fa-save"></i>
                    </button>
                </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
