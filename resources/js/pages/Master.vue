<script setup >
    import Header from '../components/global/Header.vue'
    import Footer from '../components/global/Footer.vue';
    import '../../assets/css/master.css';
</script>
<template>
    <Header></Header>
    <router-view :key="$route.path" />
    <Footer></Footer>
</template>