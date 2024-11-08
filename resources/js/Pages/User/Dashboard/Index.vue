<script setup>
    import AuthenticatedLayout from '../../../Layouts/AuthenticatedLayout.vue';
    import Boards from './Partials/Boards.vue';
</script>
<template>
    <AuthenticatedLayout page-title="Dashboard">
        <section class="section dashboard">
            <div class="row">
                <Boards class="sales-card" boards-title="Assigned Budget" boards-icon="wallet-fill"/>
                <Boards class="revenue-card" boards-title="Allocated" boards-icon="currency-dollar"/>
                <Boards class="customers-card" boards-title="Unallocated" boards-icon="currency-dollar"/>
            </div>
        </section>
    </AuthenticatedLayout>
</template>