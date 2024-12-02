<script setup>
import { defineProps, onMounted, onBeforeUnmount, ref, nextTick, watch } from 'vue';
import $ from 'jquery';
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

// Summernote toolbar configuration
const toolbarConfig = [
  ['style', ['style']],
  ['font', ['bold', 'italic', 'underline', 'clear']],
  ['fontname', ['fontname']],
  ['color', ['color']],
  ['para', ['ul', 'ol', 'paragraph']],
  ['table', ['table']],
  ['insert', ['link']],
  ['view', ['fullscreen', 'help']],
];

// Initialize all Summernote editors
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
    toolbar: toolbarConfig,
    callbacks: {
      onChange: (contents) => {
        props.proposal[field.id] = contents;
      },
      onEnterFullscreen: () => {
        // Add a class to hide all other editors
        $('.summernote-editor').not(selector).addClass('hidden-editor');
      },
      onExitFullscreen: () => {
        // Remove the class to make all editors visible again
        $('.summernote-editor').removeClass('hidden-editor');
      },
    },
  });

  editors.value[field.id] = $editor;

  // Sync initial content
  watch(
    () => props.proposal[field.id],
    (newContent) => {
      if ($editor.summernote) {
        const currentContent = $editor.summernote('code');
        if (currentContent !== newContent) {
          $editor.summernote('code', newContent);
        }
      }
    },
    { immediate: true }
  );
}


// Cleanup all editor instances
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
