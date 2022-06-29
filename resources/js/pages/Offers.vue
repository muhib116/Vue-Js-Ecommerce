<template>
<div class="all_offers_container">
        <div class="container">
            <div class="section_header">
                <h2 class="title">All offers</h2>
            </div>
            <div class="all_offers">
                    
                <a href="#" class="brand_item">
                    <img src="https://shop.activeitzone.com/public/uploads/all/4JyMyDLNKzyESL1uvoa2mFoHznVDI27HsBMozQUs.webp" alt="">
                </a>
                    
                <a href="#" class="brand_item">
                    <img src="https://shop.activeitzone.com/public/uploads/all/AuXUoqkTwjCOeYpVKpqBWF9U3zV3hlemGsuvv9oa.webp" alt="">
                </a>
                    
                <a href="#" class="brand_item">
                    <img src="https://shop.activeitzone.com/public/uploads/all/YLqbB1vjwIrN3EWXtxg9p5b2Tji4X0wBh3YSP2AE.webp" alt="">
                </a>
                    
                <a href="#" class="brand_item">
                    <img src="https://shop.activeitzone.com/public/uploads/all/vg4N7qcyxiN4DzgswOJhJFFfDZ6RaheCDscspeK5.webp" alt="">
                </a>
                    
                <a href="#" class="brand_item">
                    <img src="https://shop.activeitzone.com/public/uploads/all/KyrlGkeOfdbiF1GJTavpwSIffTEtN9QHVBovP8Z9.webp" alt="">
                </a>
                    
                <a href="#" class="brand_item">
                    <img src="https://shop.activeitzone.com/public/uploads/all/V9lzVrnueU1hUtjAPG0JgetSJgF5606L7vfXA9jD.webp" alt="">
                </a>
                    
                <a href="#" class="brand_item">
                    <img src="https://shop.activeitzone.com/public/uploads/all/lxK7N6SUaEa5YgZELXbtQQjdYSBwVZo2mZ2tXfpD.webp" alt="">
                </a>
                    
                <a href="#" class="brand_item">
                    <img src="https://shop.activeitzone.com/public/uploads/all/4aBPiDloJ40DJEbRp3WxxIhFC0BXmtoRPwNJYOJw.webp" alt="">
                </a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        
    }
</script>

<style lang="scss" scoped>
.all_offers_container .all_offers{
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 1.5rem;
}
.all_offers_container .all_offers .brand_item{
    width: 100%;
    border: 1px solid var(--border_color);

}
.all_offers_container .all_offers .brand_item img{
    object-fit: contain;
}
</style>