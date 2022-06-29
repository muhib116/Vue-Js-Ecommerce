<template>
<div class="coupon_wrapper">
    <div class="container">
        <div class="section_header">
            <h2 class="title">Coupon</h2>
        </div>

        <div class="coupons">
            <div class="coupon_item">
                <img src="https://shop.activeitzone.com/public/uploads/all/6OcVBTopfxShgNf9EaIEmvPzMSGxTCXVnQiA1aau.webp" alt="">
                <button class="copy_coupon">Copy Code</button>
            </div>
            <div class="coupon_item">
                <img src="https://shop.activeitzone.com/public/uploads/all/MtEjgKLpLrdQ3gE9kyQLKGFouYw0LQ3ddH3TJjkH.webp" alt="">
                <button class="copy_coupon">Copy Code</button>
            </div>
            <div class="coupon_item">
                <img src="https://shop.activeitzone.com/public/uploads/all/MtEjgKLpLrdQ3gE9kyQLKGFouYw0LQ3ddH3TJjkH.webp" alt="">
                <button class="copy_coupon">Copy Code</button>
            </div>
            <div class="coupon_item">
                <img src="https://shop.activeitzone.com/public/uploads/all/fRt3pfff2rhr3eSV1khU829KWN9BgaGlU0PM8WUD.webp" alt="">
                <button class="copy_coupon">Copy Code</button>
            </div>
            <div class="coupon_item">
                <img src="https://shop.activeitzone.com/public/uploads/all/wrbeUEAZAZzLWizgAfXyhyKBFlbCbw9f5h9v4UQz.webp" alt="">
                <button class="copy_coupon">Copy Code</button>
            </div>
            <div class="coupon_item">
                <img src="https://shop.activeitzone.com/public/uploads/all/oMCKgqM19bxzD26JLWYDCEUu7umF7MuztUvSBW4h.webp" alt="">
                <button class="copy_coupon">Copy Code</button>
            </div>
            <div class="coupon_item">
                <img src="https://shop.activeitzone.com/public/uploads/all/NzFlsDJUoZ3TjfilDMfen4yRWkyg9S4ZHD1UU71o.webp" alt="">
                <button class="copy_coupon">Copy Code</button>
            </div>
            <div class="coupon_item">
                <img src="https://shop.activeitzone.com/public/uploads/all/DmsuD1CaWjhx1qqjJ5vabRSprhP4VhtngYvQmaW6.png" alt="">
                <button class="copy_coupon">Copy Code</button>
            </div>
            <div class="coupon_item">
                <img src="https://shop.activeitzone.com/public/uploads/all/i3pwjAgcleSa6vi7ZgyUBDx3gwgJpMqQ28wdJ5R6.png" alt="">
                <button class="copy_coupon">Copy Code</button>
            </div>
            <div class="coupon_item">
                <img src="https://shop.activeitzone.com/public/uploads/all/j4LWfFANpwNu9ZqqmHKnb1F8SmQ8ZsahxHgNDL9u.png" alt="">
                <button class="copy_coupon">Copy Code</button>
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
.coupon_wrapper .coupons{
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 1rem;
    justify-content: center;
}
.coupon_wrapper .coupons>*{
    justify-self: center;
    border-radius: 4px;
    overflow: hidden;
    position: relative;
}
.coupon_wrapper .coupons .copy_coupon{
    position: absolute;
    bottom: 0;
    width: 100%;
    background: var(--danger_color);
    color: #fff;
    padding: 10px;
    text-transform: uppercase;
    transform: translateY(100%);
    opacity: 0;
    transition: var(--transition);
    transition-delay: 0.3s;
}
.coupon_wrapper .coupons>*:hover .copy_coupon{
    transform: translateY(0%);
    opacity:1; 
    transition-delay: 0s;
    box-shadow: 0 -1px 4px #0004;
}
</style>