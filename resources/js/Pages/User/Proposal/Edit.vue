<template>
    <AuthenticatedLayout page-title="Proposals and Regular Expenses">
      <div class="proposal-form-container">
        <div class="grid-layout">
          <!-- First Column: Proposal Title and Proposal Details -->
          <div class="proposal-form">
            <ProposalHeader :proposal="proposal" @edit-header="editHeader" />
            <ProposalDetails :proposal="proposal" />
          </div>

          <!-- Second Column: Activity Details -->
          <div class="activity-details-card">
            <ActivityDetails :activity="activity" @create-activity="createActivity" />
            <ActivityCard :activity="activity" @edit-activity="editActivity" @delete-activity="deleteActivity" />
          </div>

          <!-- Submit Button positioned at the bottom, spanning both columns -->
          <button @click="submitProposal" class="submit-button">Submit Proposal</button>
        </div>
      </div>
    </AuthenticatedLayout>
  </template>




<script setup>
import AuthenticatedLayout from '../../../Layouts/AuthenticatedLayout.vue';
import { reactive, computed } from 'vue';
import Quill from 'quill';
import QuillBetterTable from 'quill-better-table';
import { ref } from 'vue';
import ProposalHeader from '../../../Components/ProposalForm/ProposalHeader.vue';
import ProposalDetails from '../../../Components/ProposalForm/ProposalDetails.vue';
import ActivityDetails from '../../../Components/ProposalForm/ActivityDetails.vue';
import ActivityCard from '../../../Components/ProposalForm/ActivityCard.vue';
// import 'assets/layouts/vendor/bootstrap/js/bootstrap.bundle.min.js';
import '@/css/ProposalForm.css';

// Register `quill-better-table` with Quill
Quill.register({
  'modules/better-table': QuillBetterTable,
}, true);

// Proposal data
const proposal = reactive({
  proposal_title: 'Sample Proposal Title',
  proposal_type: 'Project',
  unit_budget_ceiling_id: 'PAP12345',
  mfo: 'Major Output Example',
  available_funds: 80000,
  total_funds: 100000,
  proposal_description: '',
  proposal_purpose: '',
  proposal_participants_beneficiaries: '',
  proposal_expected_output: '',
});

// Computed value for fund percentage
const fundPercentage = computed(() => {
  return (proposal.available_funds / proposal.total_funds) * 100;
});

// Toggle edit state
function editHeader() {
  isEditingHeader.value = !isEditingHeader.value;
}

// Submit form
function submitProposal() {
  console.log(proposal);
}

// Define reactive `activity` object
const activity = ref({
    title: "",
    schedule: "",
    venue: ""
});

// Define methods for handling button actions
function createActivity() {
    console.log("Activity Created:", activity.value);
}

// Toggle state for Budgetary Requirements section
const showBudgetary = ref(false);

function toggleBudgetary() {
    showBudgetary.value = !showBudgetary.value;
}
</script>




