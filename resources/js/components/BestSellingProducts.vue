<script setup>
    import Rating from "./Rating.vue";
</script>

<template>
<div class="best_selling_products_container">
    <div class="container">
        <div class="section_header">
            <h2 class="title">Best Selling</h2>
        </div>
        <div class="content">
            <div id="best_selling_products-carousel">
                
                <div class="product_item">
                    <div class="product_info">
                        <div class="img">
                            <div class="attributer">
                                <button class="wishlist" title="wishlist"><i class="fa fa-heart-o"></i></button>
                                <button class="quickview" title="quickview"><i class="fa fa-expand"></i></button>
                            </div>
                            <!-- <span class="msg success">Popular</span> -->
                            <img src="https://shop.activeitzone.com/public/uploads/all/KorbBNbxqdHYBKAbMvLH8W1OXdKnHIpd0jtI8wOh.png" alt="">
                        </div>
                        <div class="content">
                            <h5 class="name">OnePlus 8 (Glacial Green 8GB RAM+128GB Storage)</h5>
                            <div class="price">
                                <del>303.00$</del>
                                <strong>278.85$</strong>
                            </div>

                            <!-- product rating start -->
                            <Rating rating="85%" />
                            <!-- product rating end -->
        
                        </div>
                    </div>
                    <button class="add_to_cart">Add to Cart
                        <!-- <span class="count" title="Total item in cart!">2</span> -->
                    </button>
                </div>
                
                <div class="product_item">
                    <div class="product_info">
                        <div class="img">
                            <div class="attributer">
                                <button class="wishlist" title="wishlist"><i class="fa fa-heart-o"></i></button>
                                <button class="quickview" title="quickview"><i class="fa fa-expand"></i></button>
                            </div>
                            <!-- <span class="msg success">Popular</span> -->
                            <img src="https://shop.activeitzone.com/public/uploads/all/6rn3dJ1d7bQV2804mEO3uhPCeR8wWMQkHQled7J6.png" alt="">
                        </div>
                        <div class="content">
                            <h5 class="name">Women's Printed Cotton Pajama Set</h5>
                            <div class="price">
                                <strong>60.85$</strong>
                            </div>

                            <!-- product rating start -->
                            <Rating rating="85%" />
                            <!-- product rating end -->
        
                        </div>
                    </div>
                    <button class="add_to_cart">Add to Cart
                        <span class="count" title="Total item in cart!">1</span>
                    </button>
                </div>
                
                <div class="product_item">
                    <div class="product_info">
                        <div class="img">
                            <div class="attributer">
                                <button class="wishlist" title="wishlist"><i class="fa fa-heart-o"></i></button>
                                <button class="quickview" title="quickview"><i class="fa fa-expand"></i></button>
                            </div>
                            <span class="msg danger">-30% Off</span>
                            <img src="https://shop.activeitzone.com/public/uploads/all/MPk8OI5xPXWHCqEZw5decATlnNpqD8uBMN7RTmw4.png" alt="">
                        </div>
                        <div class="content">
                            <h5 class="name">Adidas Prime Backpack for traveler</h5>
                            <div class="price">
                                <del>61.20$</del>
                                <strong>42.84$</strong>
                            </div>

                            <!-- product rating start -->
                            <Rating rating="85%" />
                            <!-- product rating end -->
        
                        </div>
                    </div>
                    <button class="add_to_cart">Add to Cart
                        <!-- <span class="count" title="Total item in cart!">2</span> -->
                    </button>
                </div>
                
                <div class="product_item">
                    <div class="product_info">
                        <div class="img">
                            <div class="attributer">
                                <button class="wishlist" title="wishlist"><i class="fa fa-heart-o"></i></button>
                                <button class="quickview" title="quickview"><i class="fa fa-expand"></i></button>
                            </div>
                            <!-- <span class="msg danger">Sold Out</span> -->
                            <img src="https://shop.activeitzone.com/public/uploads/all/b2dq2wgYF7eQRxbVgkqqZUulbhKCszlq60WBZ4Ez.png" alt="">
                        </div>
                        <div class="content">
                            <h5 class="name">Adidas Men's 2021-22 Arsenal FC Home Jersey</h5>
                            <div class="price">
                                <strong>30$</strong>
                            </div>

                            <!-- product rating start -->
                            <Rating rating="85%" />
                            <!-- product rating end -->
        
                        </div>
                    </div>
                    <button class="add_to_cart">Add to Cart
                        <!-- <span class="count" title="Total item in cart!">2</span> -->
                    </button>
                </div>
                
                <div class="product_item">
                    <div class="product_info">
                        <div class="img">
                            <div class="attributer">
                                <button class="wishlist" title="wishlist"><i class="fa fa-heart-o"></i></button>
                                <button class="quickview" title="quickview"><i class="fa fa-expand"></i></button>
                            </div>
                            <!-- <span class="msg danger">Sold Out</span> -->
                            <img src="https://shop.activeitzone.com/public/uploads/all/brO9DLQukZXwzHMH9vExLST8L8w31nDk0ZqMxe3k.png" alt="">
                        </div>
                        <div class="content">
                            <h5 class="name">Microsoft Surface Arc Mouse, - CZV-00001</h5>
                            <div class="price">
                                <del>30.00$</del>
                                <strong>28.85$</strong>
                            </div>

                            <!-- product rating start -->
                            <Rating rating="85%" />
                            <!-- product rating end -->

                        </div>
                    </div>
                    <button class="add_to_cart">Add to Cart
                        <span class="count" title="Total item in cart!">4</span>
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
div#best_selling_products-carousel {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1rem;
}
.best_selling_products_container .product_item{
    border: 1px solid var(--border_color);
}
.best_selling_products_container .product_item .product_info{
    display: grid;
    grid-template-columns: 0.6fr 1fr;
    align-items: center;
    position: relative;
}
.best_selling_products_container .product_item .img{
    aspect-ratio: 1/1 !important;
    border-right: 1px solid var(--border_color);
}
.best_selling_products_container .product_item .content{
    padding: 10px 15px;
    display: grid;
    gap: 5px;
}
.best_selling_products_container .product_item .name{
    font-weight: normal;
    margin: 0;
}
.best_selling_products_container .product_item .attributer{
    display: grid;
    gap: 5px;
    position: absolute;
    left: 0;
    top: 0;
    padding: 5px;
    display: none;
}

.best_selling_products_container .product_item .attributer>*{
    aspect-ratio: 1/1;
    padding: 4px;
    width: 30px;
    height: 30px;
    display: grid;
    place-content: center;
    font-size: 0.8rem;
}
.best_selling_products_container .product_item .attributer .wishlist{
    background: var(--product_wishlist_bg);
    color: #fff;
    filter: grayscale(1);
}
.best_selling_products_container .product_item .attributer .quickview{
    background: var(--product_view_bg);
    color: #fff;
    filter: grayscale(1);
    transition: var(--transition);
}
.best_selling_products_container .product_item .attributer :is(.wishlist,.quickview):is(:hover,.active){
    filter: grayscale(0);
}

.best_selling_products_container .product_item .msg{
    position: absolute;
    color: #fff;
    top: 60%;
    left: 18px;
    padding: 0px 15px 0px 15px;
    font-size: 12px;
    transform-origin: left top;
    transform: rotateZ(90deg) translateX(-50%);
}
.best_selling_products_container .product_item .msg.success{
    background-color: var(--success_color);
}
.best_selling_products_container .product_item .msg.danger{
    background-color: var(--danger_color);
}
.best_selling_products_container .product_item .msg.warning{
    background-color: var(--warning_color);
}
.best_selling_products_container .product_item .add_to_cart{
    background-color: var(--primary_color);
    color: #fff;
    width: 100%;
    padding: 5px 15px;
    transition: var(--transition);
    text-transform: uppercase;
    position: relative;
    font-weight: 400;
}
.best_selling_products_container .product_item .add_to_cart .count{
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
.best_selling_products_container .product_item .add_to_cart:is(:hover,.active)
{
    background-color: var(--success_color);
}
.best_selling_products_container .product_item .rating{
    margin-left: unset;
    margin-right: unset;
}
.price del {
    font-size: 12px;
    margin-right: 10px;
    color: #888;
}
</style>