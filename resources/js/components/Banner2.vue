<template>
    <section class="banner_wrapper _other_banner">
        <div class="container py_0">
            <div class="banner_two">
                <div class="banner_two_bottom">
                    <div class="one">
                        <a href="#">
                            <img src="https://shop.activeitzone.com/public/uploads/all/PrS1ToTI590eGmlJty1zlP6xS7i9J152Uw1g9uJf.png" alt="">
                        </a>
                    </div>
                    <div class="two">
                        <a href="#">
                            <img src="https://shop.activeitzone.com/public/uploads/all/YHURoufSjInKrQGlk4ciMgMlTxRhKMO9XHKjMEg6.png" alt="">
                        </a>
                    </div>
                </div>
            </div>
            <div class="banner_one">
                <a href="#">
                    <img src="https://shop.activeitzone.com/public/uploads/all/ZurlOglHJaxpG8IZ6co8kWI5lIi5aVlCsvf0ZnP0.webp" alt="test">
                </a>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        
    }
</script>

<style scoped>
    .banner_wrapper._other_banner>* {
        display: grid;
        grid-template-columns: 0.5fr 1fr;
        gap: 0.8rem;
        margin-top: 0.8rem;
    }
    
    .banner_wrapper._other_banner .banner_two{
        grid-template-columns: 1fr;
    }
</style>