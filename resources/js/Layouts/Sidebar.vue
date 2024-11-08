<script setup>
    import { reactive,ref } from 'vue';
    import DropdownButton from '../Components/DropdownButton.vue';
    import DropdownItem from '../Components/DropdownItem.vue';
    import NavLink from '../Components/NavLink.vue';
    import OffCanvas from '../Components/OffCanvas.vue';
    import BaseInput from '../Components/BaseInput.vue';
    import ProposalCreate from '../Pages/User/Proposal/Create.vue';

    const links = [
        { title: 'Dashboard', icon: 'grid', route: 'home' },
        { title: 'Proposals', icon: 'file-post', route: 'proposals' },
        { title: 'PPMP', icon: 'file-earmark-ruled', route: 'ppmp' },
        { title: 'Purchase Request', icon: 'file-earmark-spreadsheet', route: 'pr' },
    ];

    const menuItems = [
        { label: 'Proposals', isButton: false, href: '#', icon: 'file-earmark' },
        { label: 'Regular Expenses', isButton: false, href: '#', icon: 'bi-trash' },
        { label: 'Purchase Requests', isButton: false, href: '#', icon: 'bi-pencil' },
    ];

    const dropdownProps = reactive({
        label: 'Create',
        color: 'btn-primary',
        size: '',
        split: true,
        dropup: false,
        dropright: false,
        dropleft: false,
        icon: 'plus-circle',
    });
</script>
<template>
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item">
                <div class="d-flex justify-content-center mb-2">
                    <DropdownButton v-bind="dropdownProps">
                        <DropdownItem text="Proposal" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"/>
                        <DropdownItem text="Regular Expenses" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"/>
                    </DropdownButton>
                </div>
            </li>

            <NavLink v-for="(link, i) in links" :key="i" :href="route(link.route)">
                <i :class="`bi bi-${link.icon}`"></i>
                <span>{{ link.title }}</span>
            </NavLink>
        </ul>
    </aside>

    <OffCanvas id="offcanvasRight" title="Create Proposal" position="offcanvas-end" :backdrop="true">
        <ProposalCreate/>
    </OffCanvas>
</template>