<script setup>
    import { ref } from 'vue';

    // Define the props for the modal
    const props = defineProps({
        visible: {
            type: Boolean,
            default: false,
        },
        title: {
            type: String,
            default: 'Modal Title',
        },
    });

const emit = defineEmits(['update:visible']);

const closeModal = () => {
  emit('update:visible', false); // Close modal by emitting the update event
};

const save = () => {
  // Handle save logic (customize as needed)
  closeModal();
};
</script>
<template>
    <div
      class="modal fade"
      id="exampleModal"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      :class="{'show': visible}"
      style="display: block"
      aria-hidden="false"
      @click.self="closeModal"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{ title }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="closeModal"></button>
          </div>
          <div class="modal-body">
            <slot></slot> <!-- Slot to insert dynamic content -->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" @click="closeModal">Close</button>
            <button type="button" class="btn btn-primary" @click="save">Save changes</button>
          </div>
        </div>
      </div>
    </div>
</template>
  