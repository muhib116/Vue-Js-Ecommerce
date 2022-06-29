<template>
<div class="shop_section_container">
    <div class="container">
        <div class="section_header">
            <h2 class="title">Featured Shops</h2>
        </div>
        <div class="shop_list">

            <div class="shop_item">
                <div class="banner" style="background-image:url(https://shop.activeitzone.com/public/uploads/all/t1MpKyqeGNHmVJmB17aD43LJSWUTntHQlj2P9nw3.webp)">
                    <div>
                        <div class="content">
                            <a href="#" class="shop_logo">
                                <img src="https://shop.activeitzone.com/public/uploads/all/WubUneHPvGBJFfr5M5NxpFvE5uh7vELJIjPmP1G1.png" alt="">
                            </a>
                            <h3 class="shop_name">
                                <a href="#">Beauty Shop</a>
                            </h3>
                            <div class="rating_wrapper">
                                4.8
                                <!-- product rating start -->
                                <Rating rating="95%" />
                                <!-- product rating end -->
                                (4 ratings)
                            </div>
                        </div>
                    </div>
                </div>

                <div class="products_wrapper">

                    <div class="product">
                        <a href="#">
                            <img src="https://shop.activeitzone.com/public/uploads/all/eOFjcj9sbvj9C9kh19a4z8E6u4QvisX3YakhhI3C.webp" alt="">
                        </a>
                        <div class="info">
                            <a href="#">Women's Zip Up Safari Military Anorak Jacket with Hood Drawstring - Regular and Plus Sizes</a>
                            <strong>71.07$</strong>
                        </div>
                    </div>

                    <div class="product">
                        <a href="#">
                            <img src="https://shop.activeitzone.com/public/uploads/all/CGozjgdSKa78cKGxzICh9QMtoKv6NYYooYjJbUZc.webp" alt="">
                        </a>
                        <div class="info">
                            <a href="#">TROMPE Lâ€™OEIL SKI-STYLE DRESS</a>
                            <strong>30.07$</strong>
                        </div>
                    </div>

                    <div class="product">
                        <a href="#">
                            <img src="https://shop.activeitzone.com/public/uploads/all/f121PGFfa83b4nf5R04lhwQSM3VxCtyyrYWZf1Hn.webp" alt="">
                        </a>
                        <div class="info">
                            <a href="#">GRACE KARIN Women's 50s Vintage Pencil Dress Cap Sleeve Wiggle Dress</a>
                            <strong>19.07$</strong>
                        </div>
                    </div>

                    <div class="product">
                        <a href="#">
                            <img src="https://shop.activeitzone.com/public/uploads/all/WwVqK4mr9iqZX3BuHR4nNi5TkPPb97ObiVe0ot7W.webp" alt="">
                        </a>
                        <div class="info">
                            <a href="#">Women's Zip Up Safari Military Anorak Jacket with Hood Drawstring - Regular and Plus Sizes</a>
                            <strong>71.07$</strong>
                        </div>
                    </div>

                    <a href="#" class="visit_store_link">Visit Store <i class="fa fa-angle-right"></i></a>
                </div>
            </div>

            <div class="shop_item">
                <div class="banner" style="background-image:url('https://shop.activeitzone.com/public/uploads/all/e6kYNNyz59AQPO7jbw8OguHACaaO1HLk8aG0e6SV.webp')">
                    <div>
                        <div class="content">
                            <a href="#" class="shop_logo">
                                <img src="https://shop.activeitzone.com/public/uploads/all/4GnbgOOz8kW3cGrgsuPXxFcnDxIk7OsyIC0jPqIg.png" alt="">
                            </a>
                            <h3 class="shop_name">
                                <a href="#">Sleek Style</a>
                            </h3>
                            <div class="rating_wrapper">
                                4.8
                                <!-- product rating start -->
                                <Rating rating="95%" />
                                <!-- product rating end -->
                                (4 ratings)
                            </div>
                        </div>
                    </div>
                </div>

                <div class="products_wrapper">

                    <div class="product">
                        <a href="#">
                            <img src="https://shop.activeitzone.com/public/uploads/all/hDbptRP3cF9kxpsjpWWsBSdXTHPej385D3EdKQyN.webp" alt="">
                        </a>
                        <div class="info">
                            <a href="#">TROMPE Lâ€™OEIL SKI-STYLE DRESS</a>
                            <strong>30.07$</strong>
                        </div>
                    </div>

                    <div class="product">
                        <a href="#">
                            <img src="https://shop.activeitzone.com/public/uploads/all/ugb1btJDFdwdWKwBEvx98ZiE2aqpZvxT9maz6yZJ.webp" alt="">
                        </a>
                        <div class="info">
                            <a href="#">GRACE KARIN Women's 50s Vintage Pencil Dress Cap Sleeve Wiggle Dress</a>
                            <strong>19.07$</strong>
                        </div>
                    </div>

                    <div class="product">
                        <a href="#">
                            <img src="https://shop.activeitzone.com/public/uploads/all/WwVqK4mr9iqZX3BuHR4nNi5TkPPb97ObiVe0ot7W.webp" alt="">
                        </a>
                        <div class="info">
                            <a href="#">Women's Zip Up Safari Military Anorak Jacket with Hood Drawstring - Regular and Plus Sizes</a>
                            <strong>71.07$</strong>
                        </div>
                    </div>

                    <div class="product">
                        <a href="#">
                            <img src="https://shop.activeitzone.com/public/uploads/all/WwVqK4mr9iqZX3BuHR4nNi5TkPPb97ObiVe0ot7W.webp" alt="">
                        </a>
                        <div class="info">
                            <a href="#">Women's Zip Up Safari Military Anorak Jacket with Hood Drawstring - Regular and Plus Sizes</a>
                            <strong>71.07$</strong>
                        </div>
                    </div>

                    <a href="#" class="visit_store_link">Visit Store <i class="fa fa-angle-right"></i></a>
                </div>
            </div>

        </div>
    </div>
</div>
</template>

<script>
    import Rating from './Rating.vue';
    export default {
        components: { Rating }
    }
</script>

<style scoped>
.shop_section_container .shop_list {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}

@media all and (max-width: 820px){
    .shop_section_container .shop_list {
        grid-template-columns: 1fr;
    }
}

/* shop banner start */
.shop_section_container .shop_item .banner {
    display: grid;
    grid-template-columns: 100px 1fr;
    padding: 1.2rem;
    justify-content: center;
    text-align: center;
    position: relative;
    border-radius: 10px 10px 0 0;
}
@media all and (max-width: 768px){
    .shop_section_container .shop_item .banner {
        grid-template-columns: 1fr;
    }
}
.shop_section_container .shop_item a.shop_logo {
    width: 90px;
    height: 90px;
    display: block;
    position: absolute;
    top: 50%;
    left: 20px;
    transform: translate(0%, -50%);
    border: 4px solid #fff;
    border-radius: 50%;
    box-shadow: 1px 0 2px #0002;
}

.shop_section_container .shop_item .banner .content{
    display: grid;
    background: #fff;
    width: fit-content;
    padding: 20px 50px 20px 105px;
    margin: 10px 0;
    white-space: nowrap;
    text-align: left;
}
.shop_section_container .shop_item .shop_name{
    margin: 0;
    margin-bottom: 10px;
}
.shop_section_container .shop_item .rating_wrapper{
    display: flex;
    gap: 0.5rem;
    width: fit-content;
    align-items: center;
    font-size: 0.8rem;
}
.shop_section_container .shop_item .rating_wrapper .rating{
    margin: 0;
    width: 80px;
}
.rating.active::before,
.shop_section_container .shop_item .rating {
    border-radius: 12px;
}
.shop_section_container .shop_item .rating img {
    border: 4px solid #fff;
}
/* shop banner end */



/* shop product design start */
.shop_section_container .shop_item  .products_wrapper {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 0.5rem;
    border: 1px solid var(--border_color);
    padding: 1rem;
    padding-bottom: 3.4rem;
    position: relative;
}

.shop_section_container .shop_item  .products_wrapper .product {
    border: 1px solid var(--border_color);
    display: grid;
    grid-template-columns: 0.5fr 1fr;
    align-items: center;
    max-width: 500px;
}

.shop_section_container .shop_item  .products_wrapper .product .info {
    display: grid;
    padding: 1rem;
}

.shop_section_container .shop_item  .products_wrapper .product .info a {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    font-size: 0.8rem;
    font-weight: 300;
    margin-bottom: 5px;
}

.shop_section_container .shop_item  .products_wrapper .product img {
    border-right: 1px solid var(--border_color);
}

.shop_section_container .shop_item .visit_store_link{
    position: absolute;
    right: 1rem;
    bottom: 1rem;
    color: var(--primary_color);
    font-size: 0.9rem;
    font-weight: normal;
}
/* shop product design end */
</style>