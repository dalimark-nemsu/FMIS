<script setup>
import { defineProps, onMounted, onBeforeUnmount, ref, nextTick, watch } from 'vue';
import { debounce } from 'lodash'; // Install lodash if not already installed
import $ from 'jquery';
import axios from 'axios'; // Make sure Axios is set up in your project

window.$ = $;
window.jQuery = $;

// Props
const props = defineProps({
  proposal: Object,
});

// References for the editors
const editors = ref({
  proposal_description: null,
  proposal_purpose: null,
  participants_beneficiaries: null,
  expected_output: null,
});

// Debounced function to save updates
const saveUpdate = debounce(async (field, content) => {
  try {
    await axios.post(`/proposals/${props.proposal.id}/update-field`, {
      field,
      content,
    });
  } catch (error) {
    console.error('Error saving update:', error);
  }
}, 500); // Adjust debounce interval as needed

// Initialize Summernote editors
const fields = [
  { id: 'proposal_description', label: 'Proposal Description', placeholder: 'Enter the proposal description...' },
  { id: 'proposal_purpose', label: 'Proposal Purpose', placeholder: 'Describe the purpose of the proposal...' },
  { id: 'participants_beneficiaries', label: 'Participants & Beneficiaries', placeholder: 'List participants and beneficiaries...' },
  { id: 'expected_output', label: 'Expected Output', placeholder: 'Specify the expected outcomes...' },
];

onMounted(async () => {
  await nextTick();
  fields.forEach((field) => initializeEditor(field));
});

function initializeEditor(field) {
  const selector = `#editor-${field.id}`;
  const $editor = $(selector);

  if (!$editor.length) {
    console.error(`Editor reference ${selector} not found.`);
    return;
  }

  $editor.summernote({
    height: 200,
    placeholder: field.placeholder,
    toolbar: [
      ['style', ['style']],
      ['font', ['bold', 'italic', 'underline', 'clear']],
      ['fontname', ['fontname']],
      ['color', ['color']],
      ['para', ['ul', 'ol', 'paragraph']],
      ['table', ['table']],
      ['insert', ['link']],
      ['view', ['fullscreen', 'help']],
    ],
    callbacks: {
      onInit: () => {
        // Set initial content when the editor initializes
        const initialValue = props.proposal[field.id] || '';
        $editor.summernote('code', initialValue);
      },
      onChange: (contents) => {
        props.proposal[field.id] = contents; // Update local state
        saveUpdate(field.id, contents); // Save update to server
      },
    },
  });

  editors.value[field.id] = $editor;

  // Watch for changes to the proposal and update the editor dynamically
  watch(
    () => props.proposal[field.id],
    (newContent) => {
      if ($editor.summernote) {
        const currentContent = $editor.summernote('code');
        if (currentContent !== newContent) {
          $editor.summernote('code', newContent || '');
        }
      }
    },
    { immediate: true }
  );
}


onBeforeUnmount(() => {
  Object.values(editors.value).forEach((editor) => {
    if (editor && editor.summernote) editor.summernote('destroy');
  });
});
</script>


<template>
  <div class="proposal-details-card">
    <div
      v-for="field in fields"
      :key="field.id"
      class="field-container"
    >
      <label :for="`editor-${field.id}`" class="label mb-2">{{ field.label }}</label>
      <div :id="`editor-${field.id}`" class="summernote-editor"></div>
    </div>
  </div>
</template>
