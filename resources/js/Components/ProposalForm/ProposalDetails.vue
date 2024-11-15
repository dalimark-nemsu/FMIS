<template>
    <div class="proposal-details-card">
      <div class="field-container" v-for="(field, index) in fields" :key="index">
        <label>{{ field.label }}</label>
        <QuillEditor v-model="proposal[field.key]" class="quill-editor" />
      </div>
    </div>
  </template>

  <script setup>
  import { defineProps } from 'vue';
  import { QuillEditor } from '@vueup/vue-quill';

  const props = defineProps({
    proposal: Object,
  });

  const fields = [
    { label: "Proposal Description", key: "proposal_description" },
    { label: "Proposal Purpose", key: "proposal_purpose" },
    { label: "Participants & Beneficiaries", key: "proposal_participants_beneficiaries" },
    { label: "Expected Output", key: "proposal_expected_output" }
  ];
  </script>
