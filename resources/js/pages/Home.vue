<script setup>
    import Banner from "../components/Banner.vue";
    import Categories from "../components/Categories.vue";
    import Products from "../components/Products.vue";
    import Banner2 from "../components/Banner2.vue";
    import BigBanner from "../components/BigBanner.vue";
    import Banner3 from "../components/Banner3.vue";
    import FeaturedShop from "../components/FeaturedShop.vue";
    import Coupon from "../components/Coupon.vue";
    import BestSellingProducts from "../components/BestSellingProducts.vue";
    import LimitedTimeOffer from "../components/LimitedTimeOffer.vue";
    import WomenProducts from "../components/WomenProducts.vue";
    import TopShop from "../components/TopShop.vue";
    import OffCanvasCart from "../components/global/OffCanvasCart.vue";
</script>

<template>
    <Banner3 />
    <Categories />
    <Products title="Todays Deal" />
    <Banner2 />
    <Products title="New Arraival" product_type="new_arrival" />
    <BigBanner />
    <Products title="Top Rated" product_type="top_ratted" />
    <Banner />
    <FeaturedShop />
    <Coupon />
    <BestSellingProducts />
    <LimitedTimeOffer />
    <WomenProducts />
    <TopShop />

    <OffCanvasCart />
</template>