<script setup >
    import Header from '../components/global/Header.vue'
    import Footer from '../components/global/Footer.vue';
    import MobileNav from '../components/global/MobileNav.vue';
    import '../../assets/css/master.css';
</script>
<template>
    <Header />
    <MobileNav />
    <router-view :key="$route.path" />
    <Footer />
</template>

<script>
    export default {
        methods:{
            changeValue(value){
                this.$store.commit('increment', value);
            },
            parentHandler: function () {
                this.$refs.modal1.close();
                this.$refs.modal2.open();
            }
        }
    }
</script>
