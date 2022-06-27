<script setup >
    import Header from '../components/global/Header.vue'
    import Footer from '../components/global/Footer.vue';
    import Navigation from '../components/Global/Navigation.vue'; 
</script>
<template>
    <Header></Header>
    <Navigation />
    <router-view :key="$route.path" />
    <Footer></Footer>
</template>