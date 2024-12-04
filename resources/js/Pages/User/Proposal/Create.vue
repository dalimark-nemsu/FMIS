<script setup>
    import { ref, computed } from 'vue';
    import { formatAmount } from '../../../Utils/numberUtils';
    import BaseInput from '../../../Components/BaseInput.vue';
    import BaseSelect from '../../../Components/BaseSelect.vue';
    import BaseButton from '../../../Components/BaseButton.vue';
    import PapsTablePlaceHolder from './includes/PapsTablePlaceHolder.vue';
    import { usePage, useForm } from '@inertiajs/vue3';
    import axios from 'axios';

    const typeOptions = [
        { value: 'project', text: 'Project' },
        { value: 'activity', text: 'Activity' },
    ];

    const props = defineProps({
        unitBudgetCeilings:{
            type: Array,
            default: ()=>([]),
        },
    });

    const form = useForm({
        type: '',
        title: '',
        proponent_id: '',
        unit_budget_ceiling_id: '',
    });
    
    function submit(){
        form.post(route('proposals.store'))
    }

    const selectedRow = ref(null);
    const searchResults = ref([]);
    const searchQuery = ref('');
    const searching = ref(false);

    // Method to select a row
    function selectRow(id) {
        form.unit_budget_ceiling_id = id;
        selectedRow.value = id;
    }   

    async function searchProponents() {
        if (!searchQuery.value) {
            searchResults.value = [];
            return;
        }

        searching.value = true;
        try {
            const response = await axios.get('/users', {
                params: { query: searchQuery.value }
            });
            searchResults.value = response.data;
            
        } catch (error) {
            console.error('Error fetching proponents:', error);
        } finally {
            searching.value = false;
        }
    }

    // Method to select a proponent from search results
    function selectProponent(proponent) {
        form.proponent_id = proponent.id;
        searchQuery.value = proponent.name; // Display name in input
        searchResults.value = []; // Clear results after selection
    }
</script>

<template>
    <form @submit.prevent="submit();" class="d-flex flex-column h-100">
        <div class="offcanvas-body d-flex flex-column">
            <div class="form-floating mb-3 col-6">
                <BaseSelect id="floatingSelect" v-model="form.type" :options="typeOptions" label="Type" classes="form-select fw-bold"/>
            </div>
            <div class="form-floating mb-3">
                <BaseInput id="floatingInput" type="text" v-model="form.title" label="Proposal Title" classes="form-control fw-bold"/>
            </div>
            <div class="form-floating mb-3">
                <BaseInput 
                    id="floatingInput" 
                    type="search" 
                    v-model="searchQuery" 
                    label="Proponent" 
                    classes="form-control fw-bold"
                    @input="searchProponents" 
                />
                <ul v-if="searching" class="dropdown-menu show w-100">
                    <li class="dropdown-item">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Searching...
                    </li>
                </ul>
        
                <ul v-if="searchResults.length" class="dropdown-menu show w-100">
                    <li v-for="proponent in searchResults" :key="proponent.id" @click="selectProponent(proponent)" class="dropdown-item">
                        {{ proponent.name }}
                    </li>
                </ul>
            </div>
            <div class="table-responsive flex-grow-1 mb-3 vi">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" class="fw-600">PAP's</th>
                            <th scope="col" class="fw-600 text-end">Available Balance</th>
                        </tr>
                    </thead>
                    <tbody v-if="!unitBudgetCeilings || unitBudgetCeilings.length === 0">
                        <tr>
                            <td>
                                <div class="title placeholder-glow">
                                    <span class="placeholder col-8"></span>
                                </div>
                                <div class="subtitle placeholder-glow">
                                    <span class="placeholder col-6"></span>
                                    <span class="placeholder col-4 ms-2"></span>
                                </div>
                            </td>
                            <td class="text-end placeholder-glow">
                                <span class="placeholder col-4"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="title placeholder-glow">
                                    <span class="placeholder col-7"></span>
                                </div>
                                <div class="subtitle placeholder-glow">
                                    <span class="placeholder col-5"></span>
                                    <span class="placeholder col-3 ms-2"></span>
                                </div>
                            </td>
                            <td class="text-end placeholder-glow">
                                <span class="placeholder col-5"></span>
                            </td>
                        </tr>
                    </tbody>
                    <tbody v-else>
                        <tr v-for="(unitBudgetCeiling, index) in unitBudgetCeilings" :key="index" :class="{ 'active-row': selectedRow === unitBudgetCeiling.id }" @click="selectRow(unitBudgetCeiling.id)">
                            <td>
                                <div class="title">{{ unitBudgetCeiling.campus_budget_ceiling.program_activity_project.name }}</div>
                                <div class="subtitle">MFO: {{ unitBudgetCeiling.campus_budget_ceiling.program_activity_project.major_final_output.abbreviation }} | Fund Source: {{ unitBudgetCeiling.campus_budget_ceiling.program_activity_project.fund_source.abbreviation }}</div>
                            </td>
                            <td class="text-end">
                                ₱{{ formatAmount(unitBudgetCeiling.total_amount) }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="offcanvas-footer sticky-footer">
            <BaseButton variant="primary" type="submit" customClasses="float-end">
                <template v-if="form.processing">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Creating...
                </template>
                <template v-else>
                    Create
                    <i class="bi bi-arrow-right"></i>
                </template>
            </BaseButton>
        </div>
    </form>
</template>

<style scoped>
    td {
        padding: 10px;
    }
    .title {
        font-weight: 600;
        font-size: 12pt;
    }
    .subtitle{
        font-weight: 500;
        font-size: 11pt;
    }
    .other-details{
        font-size: 11pt;
        font-weight: 500;
    }
    tbody tr{
        cursor: pointer;
    }
    .active-row {
        background-color: #0d6efd; /* Light blue background */
        color: #fff;
    }

    .offcanvas-body {
        flex: 1 1 auto; /* Allow body to take up available space */
        display: flex;
        flex-direction: column;
        overflow-y: auto;
    }

.table-responsive {
    flex-grow: 1; /* Make table take up the remaining space */
}

.sticky-footer {
    position: sticky;
    bottom: 0;
    background-color: #f8f9fa; /* Adjust as needed */
    padding: 10px;
    border-top: 1px solid #dee2e6; /* Optional: top border */
}
.dropdown-item {
    cursor: pointer;
}
</style>