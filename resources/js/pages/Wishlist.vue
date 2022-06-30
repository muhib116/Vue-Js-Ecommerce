<script setup>
    import Rating from '../components/Rating'
</script>
<template>
    <div class="whishlist_wrapper">
        <div class="wishlist_item">
            <div class="img">
                <img src="https://shop.activeitzone.com/public/uploads/all/lMV8ZYzEzDA8QIaleuzcAr3zwVP2mVVOVcnOnRMD.png" alt="">
            </div>

            <!-- product rating start -->
            <Rating :rating="(product.rating*20)+'%'" />
            <!-- product rating end -->

            <div class="content">
                <h5 class="name">{{product.name}}</h5>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        
    }
</script>

<style lang="scss" scoped>
    .whishlist_wrapper {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 1rem;

        .wishlist_item{
            border: 1px solid var(--border_color);
            position: relative;
            .img{
                aspect-ratio: 1/1 !important;
                border-bottom: 1px solid var(--border_color);
            }
            .content{
                padding: 10px 15px;
                text-align: center;
                display: grid;
                gap: 5px;
            }
            .name{
                font-weight: normal;
                margin: 0;
            }

            .footer{

            }
        }
    }
</style>