<script setup>
    import { usePage } from '@inertiajs/vue3';

    const page = usePage();
    const user = page.props.auth ? page.props.auth.user : null;
    const userRoles = page.props.auth ? page.props.auth.roles : null;
    
    const hasRole = (roles) => {
        if (userRoles && Array.isArray(userRoles)) {
            return roles.some(role => userRoles.includes(role));
        }
        return false;
    };

    const showLink = hasRole(['super-admin', 'budget-officer-iii', 'budget-officer-ii']);
    
</script>
<template>
    <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="index.html" class="logo d-flex align-items-center">    
            <img src="assets/img/logo.png" alt="">
            <span class="d-none d-lg-block">FMIS</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
            <li class="nav-item dropdown pe-3">
                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src="assets/layouts/img/profile-img.png" alt="Profile" class="rounded-circle">
                    <span class="d-none d-md-block dropdown-toggle ps-2">{{ user.name }}</span>
                </a><!-- End Profile Iamge Icon -->
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>{{ user.name}}</h6>
                        <!-- <span>Web Designer</span> -->
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                            <i class="bi bi-person"></i>
                            <span>My Profile</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                        <!-- Render this link only if the user has the required roles -->
                        <li v-if="showLink">
                            <a class="dropdown-item d-flex align-items-center" href="admin/home" target="_blank">
                                <i class="bi bi-toggles"></i>
                                <span>Admin Console</span>
                            </a>
                        </li>
                    
                        <li v-if="showLink">
                            <hr class="dropdown-divider">
                        </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Sign Out</span>
                        </a>
                    </li>

                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

    </header>
</template>