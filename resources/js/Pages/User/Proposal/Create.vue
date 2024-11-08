<script setup>
    import { ref } from 'vue';
    import BaseInput from '../../../Components/BaseInput.vue';
    import BaseSelect from '../../../Components/BaseSelect.vue';

    const name = ref('');
    const selectedType = ref('');
    const typeOptions = [
        { value: 'project', text: 'Project' },
        { value: 'activity', text: 'Activity' },
    ];
</script>

<template>
    <form>
        <div class="form-floating mb-3 col-6">
            <BaseSelect id="floatingSelect" v-model="selectedType" :options="typeOptions" label="Type" classes="form-select fw-bold"/>
        </div>
        <div class="form-floating mb-3">
            <BaseInput id="floatingInput" type="text" placeholder="name@example.com" v-model="name" label="Proposal Title" classes="form-control fw-bold"/>
        </div>
        <div
            class="table-responsive"
        >
            <table
                class="table"
            >
                <thead class="bg-primary text-white">
                    <tr>
                        <th scope="col"></th>
                        <th scope="col" class="fw-600">PAP's</th>
                        <th scope="col" class="fw-600 text-end">Available Balance</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="">
                        <td scope="row"></td>
                        <td>
                            <div class="title">General Management and Supervision</div>
                            <div class="subtitle">MFO: GAS | Fund Source: GAA</div>
                            <!-- <div class="other-details">Allocated: ₱200,000</div> -->
                        </td>
                        <td class="text-end">₱800,000.00 <small class="text-muted">/₱1,000,000.00</small></td>
                    </tr>
                    <tr class="">
                        <td scope="row"></td>
                        <td>
                            <div class="title">Provision of Higher Education Services</div>
                            <div class="subtitle">MFO: GAS | Fund Source: GAA</div>
                            <!-- <div class="other-details">Allocated: ₱300,000</div> -->
                        </td>
                        <td class="text-end">₱700,000.00 <small class="text-muted">/₱1,000,000.00</small></td>
                    </tr>
                </tbody>
            </table>
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
</style>