<script setup>
import { reactive, ref } from "vue";
import { usePage } from "@inertiajs/vue3";
import AuthenticatedLayout from "../../../Layouts/AuthenticatedLayout.vue";
import ProposalHeader from "../../../Components/ProposalForm/ProposalHeader.vue";
import ProposalDetails from "../../../Components/ProposalForm/ProposalDetails.vue";
import ActivityDetails from "../../../Components/ProposalForm/ActivityDetails.vue";
import ActivityCard from "../../../Components/ProposalForm/ActivityCard.vue";
import axios from "axios";
import "@/css/ProposalForm.css";

const { proposal: serverProposal, activities: serverActivities = [] } = usePage().props;

const proposal = reactive(serverProposal);
const activities = ref(serverActivities);

// Create a new activity
function createActivity() {
  axios
    .post(`/proposals/${proposal.id}/activities`, {
      title: null,
      dateRange: null,
      venue: null,
    })
    .then((response) => {
      const newActivity = response.data?.activity;
      if (newActivity) {
        activities.value.push(newActivity);
      }
    })
    .catch((error) => {
      console.error("Error creating activity:", error);
    });
}

// Delete activity data
function deleteActivity(activityId) {
  axios
    .delete(`/proposals/${proposal.id}/activities/${activityId}`)
    .then(() => {
      // Remove the activity from the list
      activities.value = activities.value.filter((activity) => activity.id !== activityId);
    })
    .catch((error) => {
      console.error("Error deleting activity:", error);
    });
}
</script>


<template>
  <AuthenticatedLayout page-title="Proposal">
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

          <!-- Display Activities -->
          <div v-if="activities.length > 0">
            <div v-for="(activity, index) in activities" :key="activity.id || index" class="activity-card-wrapper">
              <ActivityCard
                :activity="activity"
                :proposal-id="proposal.id"
                @delete-activity="deleteActivity"
              />
            </div>
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
