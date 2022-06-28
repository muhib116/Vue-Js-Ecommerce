<template>
    <div class="category_container">
        <div class="container">
            <div class="section_header">
                <h2 class="title">Popular Categories</h2>
                <a href="#">View All <i class="fa fa-angle-right"></i></a>
            </div>
            <div class="content">
                <div id="categories-carousel">
                    
                    <div class="cat_item">
                        <a href="#">
                            <img src="https://shop.activeitzone.com/public/uploads/all/QFr6jOK360KnwVvONku4UnJzpIrY2M0314pWkXK9.png" alt="">
                            <p class="name" title="Women Clothing & Fashion">Women Clothing & Fashion</p>
                        </a>
                    </div>
                    
                    <div class="cat_item">
                        <a href="#">
                            <img src="https://shop.activeitzone.com/public/uploads/all/lMV8ZYzEzDA8QIaleuzcAr3zwVP2mVVOVcnOnRMD.png" alt="">
                            <p class="name" title="Men Clothing & Fashion">Men Clothing & Fashion</p>
                        </a>
                    </div>
                    
                    <div class="cat_item">
                        <a href="#">
                            <img src="https://shop.activeitzone.com/public/uploads/all/4BphheR4IxBOBx88SLBAHjpr5yFYdlOGrwmvlAq2.png" alt="">
                            <p class="name" title="Baby & Kids">Baby & Kids</p>
                        </a>
                    </div>
                    
                    <div class="cat_item">
                        <a href="#">
                            <img src="https://shop.activeitzone.com/public/uploads/all/0V78CrUJyi9nmr9SsqhK2AV8Rl0oTC44FUq45X8r.png" alt="">
                            <p class="name" title="Sports & Outdoor">Sports & Outdoor</p>
                        </a>
                    </div>
                    
                    <div class="cat_item">
                        <a href="#">
                            <img src="https://shop.activeitzone.com/public/uploads/all/p7GDjaYAa9lLs32Zd1LqmXLze3ywrhOahKnNtNi6.png" alt="">
                            <p class="name" title="Automobile & Motorcycle">Automobile & Motorcycle</p>
                        </a>
                    </div>
                    
                    <div class="cat_item">
                        <a href="#">
                            <img src="https://shop.activeitzone.com/public/uploads/all/uazXsowjuJ4ESShXDqGxf0SjlGQlyIwnm8yxNZEr.png" alt="">
                            <p class="name" title="Computer & Accessories">Computer & Accessories</p>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted(){
            
        }
    }
</script>

<style scoped>
    div#categories-carousel {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 1rem;
    }


    div#categories-carousel .cat_item {
        max-width: 300px;
        justify-self: center;
    }
    .category_container .cat_item{
        border: 1px solid var(--border_color);
        padding: 10px;
    }
    .category_container .cat_item a{
        display: grid;
        text-align: center;
        font-size: 0.9rem;
    }
    .category_container .cat_item .name{
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
    }
</style>