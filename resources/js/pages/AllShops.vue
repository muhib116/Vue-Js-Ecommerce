<script setup>
    import Rating from "../components/Rating.vue";
</script>
<template>
<div class="shop_section_container">
    <div class="container">
        <div class="section_header">
            <h2 class="title">All Shops</h2>
        </div>
        <div id="shop_list-carousel">

            <div class="shop_item">
                <div class="banner" style="background-image:url('https://shop.activeitzone.com/public/uploads/all/e6kYNNyz59AQPO7jbw8OguHACaaO1HLk8aG0e6SV.webp')"></div>
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
                        <Rating rating="85%" />
                        <!-- product rating end -->
                        (4 ratings)
                    </div>
                    <p>Women Clothing & Fashion, Men Clothing & Fashion, Sports & Outdoor, Beauty, Health</p>
                </div>
                <div class="footer">
                    <a href="#" class="follow_shop">Follow Shop</a>
                    <a href="#" class="visit_shop">Visit Shop</a>
                </div>
            </div>

            <div class="shop_item">
                <div class="banner" style="background-image:url('https://shop.activeitzone.com/public/uploads/all/e6kYNNyz59AQPO7jbw8OguHACaaO1HLk8aG0e6SV.webp')"></div>
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
                        <Rating rating="85%" />
                        <!-- product rating end -->
                        (4 ratings)
                    </div>
                    <p>Women Clothing & Fashion, Men Clothing & Fashion, Sports & Outdoor, Beauty, Health</p>
                </div>
                <div class="footer">
                    <a href="#" class="follow_shop">Follow Shop</a>
                    <a href="#" class="visit_shop">Visit Shop</a>
                </div>
            </div>

            <div class="shop_item">
                <div class="banner" style="background-image:url('https://shop.activeitzone.com/public/uploads/all/e6kYNNyz59AQPO7jbw8OguHACaaO1HLk8aG0e6SV.webp')"></div>
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
                        <Rating rating="85%" />
                        <!-- product rating end -->
                        (4 ratings)
                    </div>
                    <p>Women Clothing & Fashion, Men Clothing & Fashion, Sports & Outdoor, Beauty, Health</p>
                </div>
                <div class="footer">
                    <a href="#" class="follow_shop">Follow Shop</a>
                    <a href="#" class="visit_shop">Visit Shop</a>
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

<style lang="scss" scoped>
    div#shop_list-carousel {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1rem;
    }
    .shop_section_container .shop_list {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }
    .shop_section_container .shop_item{
        max-width: 300px;
        border: 1px solid #0001;
        border-radius: 6px;
        overflow: hidden;
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
        aspect-ratio: 6/2;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }
    @media all and (max-width: 768px){
        .shop_section_container .shop_item .banner {
            grid-template-columns: 1fr;
        }
    }

    .shop_section_container .content{
        background: #fff;
        padding: 20px;
        padding-top: 60px;
        margin: 10px 0;
        position: relative;
        text-align: center;
    }
    .shop_section_container .shop_item a.shop_logo {
        width: 90px;
        height: 90px;
        display: block;
        position: absolute;
        top: 0;
        left: 50%;
        transform: translate(-50%, -50%);
        border: 4px solid #fff;
        border-radius: 50%;
        box-shadow: 0 1px 3px #0005;
    }

    .shop_section_container .shop_item .shop_name{
        margin: 0;
        margin-bottom: 10px;
    }
    .shop_section_container .shop_item .rating_wrapper{
        display: flex;
        gap: 0.5rem;
        align-items: center;
        justify-content: center;
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
    
    .footer{
        display: flex;
        justify-content: space-between;
        gap: 1rem;
        padding: 1rem;
        border-top: 1px solid var(--border_color);

        &>*{
            display: block;
            padding: 5px 15px;
            background-color: var(--danger_color);
            color: #fff;
            border-radius: 6px;

            &.visit_shop{
                background-color: var(--secondary_color);
            }
        }
    }
</style>