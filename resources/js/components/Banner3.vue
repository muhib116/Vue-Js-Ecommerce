<template>
<!-- banner start -->
<section class="banner_wrapper">
    <div class="container py_0">
        <div class="banner_one">
            <a href="#">
                <img src="https://shop.activeitzone.com/public/uploads/all/mVSFC313LZk2QrzWdLMFvDHm06whf7vSGqhje8U7.webp" alt="test">
            </a>
        </div>
        <div class="banner_two">
            <div class="banner_two_top">
                <a href="#">
                    <img src="https://shop.activeitzone.com/public/uploads/all/rJWH1AykG3YPFfjdA2k30D9UtfJEAMC6yJOMtgFZ.webp" alt="test">
                </a>
            </div>
            <div class="banner_two_bottom">
                <div class="one">
                    <a href="#">
                        <img src="https://shop.activeitzone.com/public/uploads/all/0wgUuVVAbM6CQE5JFjuC4VBvBeNOWbjmkY0xuw5K.webp" alt="">
                    </a>
                </div>
                <div class="two">
                    <a href="#">
                        <img src="https://shop.activeitzone.com/public/uploads/all/Oc9BavphNU6xmBu7UbrT3aKDhg0V2nTBdIccOS2J.webp" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- banner end -->
</template>

<script>
    export default {
        
    }
</script>

<style scoped>
.banner_wrapper a{
    overflow: hidden;
    display: block;
}
.banner_wrapper a img{
    transition: var(--transition);
}
.banner_wrapper a:hover img{
    transform: scale(1.1) rotateZ(2deg);
}
.banner_wrapper>* {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0.8rem;
    margin-top: 0.8rem;
}
.banner_wrapper .banner_two{
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0.8rem;
}
.banner_wrapper .banner_two_bottom{
    display: grid;
    gap: 0.8rem;
}

@media all and (max-width: 1100px){
    .banner_wrapper>* {
        grid-template-columns: 1fr;
    }
    .banner_wrapper .banner_three{
        display: grid;
        gap: 15px;
    }
}
</style>