<script setup>
import Rating from '../components/Rating'
</script>
<template>
    <div class="products_container">
        <div class="container">
            <div class="section_header">
                <h2 class="title">{{title}}</h2>
                <a href="#">View All <i class="fa fa-angle-right"></i></a>
            </div>
            <div class="content">
                <div id="product-carousel">
                    
                    <div v-for="product in products" :key="product.id" :class="($store.getters.GetSingleProductQnty(product.id)) ? 'product_item active' : 'product_item'">
                        <div class="attributer">
                            <button class="wishlist" title="wishlist"><i class="fa fa-heart-o"></i></button>
                            <button class="quickview" title="quickview"><i class="fa fa-expand"></i></button>
                        </div>
                        <span v-if="product.discount>0" class="msg danger">-{{product.discount}}% Off</span>

                        <div class="img">
                            <img :src="product.thumbnail_image" :alt="product.name">
                        </div>

                        <!-- product rating start -->
                        <Rating :rating="(product.rating*20)+'%'" />
                        <!-- product rating end -->

                        <div class="content">
                            <div class="price">
                                <del v-if="product.base_discounted_price>0">{{product.base_price}}$</del>
                                <strong v-if="product.base_discounted_price>0">{{product.base_discounted_price}}$</strong>
                                <strong v-else>{{product.base_price}}$</strong>
                            </div>
                            <h5 class="name">{{product.name}}</h5>
                        </div>
                        <button :class="($store.getters.GetSingleProductQnty(product.id)) ? 'add_to_cart active' : 'add_to_cart'" @click="$store.commit('AddToCart', product)">Add to Cart
                            <span v-if="$store.getters.GetSingleProductQnty(product.id)" class="count" title="Total item in cart!">{{ $store.getters.GetSingleProductQnty(product.id) }}</span>
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import config from '../config.js'
    export default {
        data(){
            return {
                products: []
            }
        },
        props: {
            title: {
                default: 'Title Goes Here'
            },
            product_type: {
                default: 'todays_deal'
            }
        },
        async mounted(){
            let response = await config.callAPI('products/'+this.product_type)
            this.products = response.data
        }
    }
</script>

<style scoped>
    div#product-carousel {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 1rem;
    }

    .price del {
        font-size: 12px;
        margin-right: 10px;
        color: #888;
    }

    .products_container .product_item{
        border: 1px solid var(--border_color);
        position: relative;
    }
    .products_container .product_item .img{
        aspect-ratio: 1/1 !important;
        border-bottom: 1px solid var(--border_color);
    }
    .products_container .product_item .content{
        padding: 10px 15px;
        text-align: center;
        display: grid;
        gap: 5px;
    }
    .products_container .product_item .name{
        font-weight: normal;
        margin: 0;
    }
    .products_container .product_item .attributer{
        display: grid;
        gap: 5px;
        position: absolute;
        left: 0;
        top: 0;
        padding: 5px;
    }

    .products_container .product_item .attributer>*{
        aspect-ratio: 1/1;
        padding: 4px;
        width: 30px;
        height: 30px;
        display: grid;
        place-content: center;
        font-size: 0.8rem;
    }
    .products_container .product_item .attributer .wishlist{
        background: var(--product_wishlist_bg);
        color: #fff;
        filter: grayscale(1) brightness(200%);
    }
    .products_container .product_item .attributer .quickview{
        background: var(--product_view_bg);
        color: #fff;
        filter: grayscale(1) brightness(150%);
        transition: var(--transition);
    }
    .products_container .product_item .attributer :is(.wishlist,.quickview):is(:hover,.active){
        filter: grayscale(0);
    }

    .products_container .product_item .msg{
        position: absolute;
        color: #fff;
        top: 0;
        right: 0;
        padding: 5px 15px 5px 25px;
        font-size: 0.8rem;
        clip-path: polygon(0 0, 100% 0, 100% 100%, 10% 100%);
    }
    .products_container .product_item .msg.success{
        background-color: var(--success_color);
    }
    .products_container .product_item .msg.danger{
        background-color: var(--danger_color);
    }
    .products_container .product_item .msg.warning{
        background-color: var(--warning_color);
    }
    .products_container .product_item .add_to_cart{
        background-color: var(--primary_color);
        color: #fff;
        width: 100%;
        padding: 10px 15px;
        transition: var(--transition);
        text-transform: uppercase;
        position: relative;
        font-weight: 400;
    }
    .products_container .product_item .add_to_cart .count{
        position: absolute;
        right: 0;
        bottom: 0;
        height: 100%;
        width: 50px;
        aspect-ratio: 1/1;
        background: var(--danger_color);
        display: grid;
        place-content: center;
        clip-path: polygon(0 0, 100% 0, 100% 100%, 10% 100%);
    }
    .products_container .product_item .add_to_cart:is(:hover,.active)
    {
        background-color: var(--success_color);
    }



    @media all and (min-width: 768px){
        .products_container .product_item .add_to_cart{
            transform: translateY(60px);
            opacity: 0;
            transition-delay: 0.3s;
        }
        .products_container .product_item:is(:hover, .active) .add_to_cart{
            transform: translateY(0px);
            opacity: 1;
            transition-delay: 0s;
        }
    }
</style>