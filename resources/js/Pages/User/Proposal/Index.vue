<script setup>
import AuthenticatedLayout from '../../../Layouts/AuthenticatedLayout.vue';
import { Link } from '@inertiajs/vue3';
import Swal from 'sweetalert2';

// Accept proposals as props
const props = defineProps({
  proposals: Array, // Ensure proposals data is passed as an array
});

const handleDelete = (item) => {
  Swal.fire({
    title: "Are you sure?",
    text: `Do you want to delete "${item.proposal_title}"?`,
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Yes, delete it!",
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire("Deleted!", `${item.proposal_title} has been deleted.`, "success");
    }
  });
};
</script>

<template>
  <AuthenticatedLayout page-title="Proposals and Regular Expenses">
    <section class="section dashboard">
      <!-- Title -->
      <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
          <h1 class="fw-bold">Proposals</h1>
          <button class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Add New Proposal
          </button>
        </div>
      </div>

      <!-- Proposals List -->
      <div class="row">
        <div class="col-md-4 mb-4" v-for="proposal in props.proposals" :key="proposal.id">
          <div class="card shadow-sm">
            <div class="card-body">
              <h5 class="card-title">{{ proposal.proposal_title }}</h5>
              <p class="card-text">
                //fund-source
                //budget_year
                //total
                <strong>Created:</strong> {{ new Date(proposal.created_at).toLocaleDateString() }}
              </p>
              <div class="d-flex justify-content-end gap-2">
                <Link :href="route('proposals.edit',proposal.id)" class="btn btn-sm btn-outline-secondary">
                  <i class="fas fa-edit"></i> Edit
                </Link>
                <button class="btn btn-sm btn-outline-danger" @click="handleDelete(proposal)">
                  <i class="fas fa-trash-alt"></i> Delete
                </button>
              </div>
            </div>
          </div>
        </div>
        <!-- Empty State -->
        <div v-if="props.proposals.length === 0" class="text-center text-muted">
          <p>No proposals found.</p>
        </div>
      </div>
    </section>
  </AuthenticatedLayout>
</template>

<style scoped>
.card {
  border-radius: 8px;
  overflow: hidden;
  background-color: #ffffff;
  border: 1px solid #e6e6e6;
}

.card-title {
  font-size: 1.2rem;
  font-weight: bold;
  color: #333;
}

.card-text {
  font-size: 0.9rem;
  color: #666;
}

.btn i {
  margin-right: 4px;
}
</style>
