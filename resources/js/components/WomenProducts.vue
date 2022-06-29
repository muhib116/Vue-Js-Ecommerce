<script setup>
    import Rating from "./Rating.vue";
</script>

<template>
<div class="products_container">
    <div class="container">
        <div class="section_header">
            <h2 class="title">Todays Deal</h2>
            <a href="#">View All <i class="fa fa-angle-right"></i></a>
        </div>
        <div class="content">
            <div id="women_product-carousel">
                
                <div class="product_item">
                    <div class="attributer">
                        <button class="wishlist" title="wishlist"><i class="fa fa-heart-o"></i></button>
                        <button class="quickview" title="quickview"><i class="fa fa-expand"></i></button>
                    </div>
                    <!-- <span class="msg success">Popular</span> -->
                    <div class="img">
                        <img src="https://shop.activeitzone.com/public/uploads/all/6rn3dJ1d7bQV2804mEO3uhPCeR8wWMQkHQled7J6.png" alt="">
                    </div>

                    <!-- product rating start -->
                    <Rating />
                    <!-- product rating end -->

                    <div class="content">
                        <div class="price">
                            <strong>60.85$</strong>
                        </div>
                        <h5 class="name">Women's Printed Cotton Pajama Set</h5>
                    </div>
                    <button class="add_to_cart">Add to Cart
                        <span class="count" title="Total item in cart!">1</span>
                    </button>
                </div>
                
                <div class="product_item">
                    <div class="attributer">
                        <button class="wishlist" title="wishlist"><i class="fa fa-heart-o"></i></button>
                        <button class="quickview" title="quickview"><i class="fa fa-expand"></i></button>
                    </div>
                    <!-- <span class="msg success">Popular</span> -->
                    <div class="img">
                        <img src="https://shop.activeitzone.com/public/uploads/all/KorbBNbxqdHYBKAbMvLH8W1OXdKnHIpd0jtI8wOh.png" alt="">
                    </div>

                    <!-- product rating start -->
                    <Rating />
                    <!-- product rating end -->

                    <div class="content">
                        <div class="price">
                            <del>303.00$</del>
                            <strong>278.85$</strong>
                        </div>
                        <h5 class="name">OnePlus 8 (Glacial Green 8GB RAM+128GB Storage)</h5>
                    </div>
                    <button class="add_to_cart">Add to Cart
                        <!-- <span class="count" title="Total item in cart!">2</span> -->
                    </button>
                </div>
                
                <div class="product_item">
                    <div class="attributer">
                        <button class="wishlist" title="wishlist"><i class="fa fa-heart-o"></i></button>
                        <button class="quickview" title="quickview"><i class="fa fa-expand"></i></button>
                    </div>
                    <!-- <span class="msg danger">Sold Out</span> -->
                    <div class="img">
                        <img src="https://shop.activeitzone.com/public/uploads/all/brO9DLQukZXwzHMH9vExLST8L8w31nDk0ZqMxe3k.png" alt="">
                    </div>

                    <!-- product rating start -->
                    <Rating />
                    <!-- product rating end -->

                    <div class="content">
                        <div class="price">
                            <del>30.00$</del>
                            <strong>28.85$</strong>
                        </div>
                        <h5 class="name">Microsoft Surface Arc Mouse, - CZV-00001</h5>
                    </div>
                    <button class="add_to_cart">Add to Cart
                        <span class="count" title="Total item in cart!">4</span>
                    </button>
                </div>
                
                <div class="product_item">
                    <div class="attributer">
                        <button class="wishlist" title="wishlist"><i class="fa fa-heart-o"></i></button>
                        <button class="quickview" title="quickview"><i class="fa fa-expand"></i></button>
                    </div>
                    <!-- <span class="msg danger">Sold Out</span> -->
                    <div class="img">
                        <img src="https://shop.activeitzone.com/public/uploads/all/b2dq2wgYF7eQRxbVgkqqZUulbhKCszlq60WBZ4Ez.png" alt="">
                    </div>

                    <!-- product rating start -->
                    <Rating />
                    <!-- product rating end -->

                    <div class="content">
                        <div class="price">
                            <strong>30$</strong>
                        </div>
                        <h5 class="name">Adidas Men's 2021-22 Arsenal FC Home Jersey</h5>
                    </div>
                    <button class="add_to_cart">Add to Cart
                        <!-- <span class="count" title="Total item in cart!">2</span> -->
                    </button>
                </div>
                
                <div class="product_item">
                    <div class="attributer">
                        <button class="wishlist" title="wishlist"><i class="fa fa-heart-o"></i></button>
                        <button class="quickview" title="quickview"><i class="fa fa-expand"></i></button>
                    </div>
                    <span class="msg danger">-30% Off</span>
                    <div class="img">
                        <img src="https://shop.activeitzone.com/public/uploads/all/MPk8OI5xPXWHCqEZw5decATlnNpqD8uBMN7RTmw4.png" alt="">
                    </div>

                    <!-- product rating start -->
                    <Rating />
                    <!-- product rating end -->

                    <div class="content">
                        <div class="price">
                            <del>61.20$</del>
                            <strong>42.84$</strong>
                        </div>
                        <h5 class="name">Adidas Prime Backpack for traveler</h5>
                    </div>
                    <button class="add_to_cart">Add to Cart
                        <!-- <span class="count" title="Total item in cart!">2</span> -->
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        
    }
</script>

<style scoped>
div#women_product-carousel {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 1rem;
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
.price del {
    font-size: 12px;
    margin-right: 10px;
    color: #888;
}


@media all and (min-width: 768px){
    .products_container .product_item .add_to_cart{
        transform: translateY(60px);
        opacity: 0;
        transition-delay: 0.3s;
    }
    .products_container .product_item:hover .add_to_cart{
        transform: translateY(0px);
        opacity: 1;
        transition-delay: 0s;
    }
}
</style>