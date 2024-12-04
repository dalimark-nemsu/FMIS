<script setup>
import { reactive, ref } from "vue";
import { usePage } from "@inertiajs/vue3";
import AuthenticatedLayout from "../../../Layouts/AuthenticatedLayout.vue";
import ProposalHeader from "../../../Components/ProposalForm/ProposalHeader.vue";
import ProposalDetails from "../../../Components/ProposalForm/ProposalDetails.vue";
import ActivityDetails from "../../../Components/ProposalForm/ActivityDetails.vue";
import ActivityCard from "../../../Components/ProposalForm/ActivityCard.vue";
import ActivityDefaultCard from "../../../Components/ProposalForm/ActivityDefaultCard.vue";
import "@/css/ProposalForm.css";

// Get proposal data from Inertia
const { proposal: serverProposal } = usePage().props;

// Make the proposal data reactive
const proposal = reactive(serverProposal);

// Activities list
const activities = ref([]);

// Methods for handling activities
function createActivity() {
  activities.value.unshift({
    id: Date.now(), // Unique ID for the activity
    title: "",
    startDate: "",
    endDate: "",
    venue: "",
    isDefault: true, // Tracks whether the card is a default card
  });
}

function editActivity(activityId, updatedData) {
  const activity = activities.value.find((a) => a.id === activityId);
  if (activity) {
    Object.assign(activity, updatedData); // Update the activity with new data
    activity.isDefault = false; // Transform into a full Activity Card
  }
}

function deleteActivity(activityId) {
  activities.value = activities.value.filter((a) => a.id !== activityId);
}

function submitProposal() {
  console.log("Submitting Proposal", proposal, activities.value);
}
</script>

<template>
  <AuthenticatedLayout page-title="Proposals and Regular Expenses">
    <div class="proposal-form-container">
      <div class="grid-layout">
        <!-- First Column: Proposal Details -->
        <div class="proposal-form">
          <ProposalHeader :proposal="proposal" />
          <ProposalDetails :proposal="proposal" />
        </div>

        <!-- Second Column: Activity Details -->
        <div class="activity-details-card">
          <ActivityDetails @create-activity="createActivity" />
          <div v-for="activity in activities" :key="activity.id">
            <template v-if="activity.isDefault">
              <ActivityDefaultCard
                :activity="activity"
                @save-activity="(updatedData) => editActivity(activity.id, updatedData)"
                @close-default="deleteActivity(activity.id)"
              />
            </template>
            <template v-else>
              <ActivityCard
                :activity="activity"
                @edit-activity="(updatedData) => editActivity(activity.id, updatedData)"
                @delete-activity="deleteActivity(activity.id)"
              />
            </template>
          </div>
          <!-- New Activity Button -->
          <button @click="createActivity" class="create-button">
            <i class="fas fa-plus"></i> New Activity
          </button>
        </div>
        <!-- Submit Button -->
        <button @click="submitProposal" class="submit-button">
            Submit Proposal
        </button>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
