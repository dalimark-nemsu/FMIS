<script setup>
    import Header from './Header.vue';
    import Sidebar from './Sidebar.vue';
    import Footer from './Footer.vue';

    const props = defineProps({
        pageTitle:String,
    });
</script>

<template>
    <Header/>
    <Sidebar/>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>{{ pageTitle }}</h1>
            <nav>
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">{{ pageTitle }}</li>
                </ol>
            </nav>
        </div>

        <section class="section dashboard">
            <slot/>
        </section>
    </main>

    <Footer/>
</template>
