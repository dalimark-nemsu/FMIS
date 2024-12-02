<script setup>
    import { computed, defineProps } from 'vue';

    const props = defineProps({
        proposal: Object,
    });

    const fundPercentage = computed(() => {
        return (props.proposal.available_funds / props.proposal.total_funds) * 100;
    });
</script>

<template>
    <div class="proposal-header-card">
      <button class="edit-button" @click="$emit('edit-header')">
        <i class="fas fa-pencil-alt"></i> Edit
      </button>
      <div class="header-content">
        <h2 class="proposal-title">{{ proposal.proposal_title }}</h2>
        <div class="header-field-group">
          <div class="header-field">
            <span class="icon"><i class="fas fa-folder-open"></i></span>
            <span class="label">Proposal Type</span>
            <span class="proposal-type-tag">{{ proposal.proposal_type }}</span>
          </div>
          <div class="header-field">
            <span class="icon"><i class="fas fa-bookmark"></i></span>
            <span class="label">PAPs</span>
            <span class="proposal-type-tag">{{ proposal.unit_budget_ceiling_id }}</span>
          </div>
        </div>
        <div class="header-field-group">
          <div class="header-field">
            <span class="icon"><i class="fas fa-chart-line"></i></span>
            <span class="label">MFO</span>
            <span class="proposal-type-tag">{{ proposal.mfo }}</span>
          </div>
          <div class="header-field">
            <span class="icon"><i class="fas fa-piggy-bank"></i></span>
            <span class="label">Fund Source</span>
            <span class="proposal-type-tag">STF</span>
          </div>
        </div>
        <div class="header-field">
          <span class="icon"><i class="fas fa-coins"></i></span>
          <span class="label">Availability</span>
          <span class="proposal-type-tag">
            ₱ {{ proposal.available_funds.toLocaleString() }} / ₱ {{ proposal.total_funds.toLocaleString() }}
          </span>
        </div>
      </div>
    </div>
</template>
