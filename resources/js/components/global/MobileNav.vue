<template>
    <!-- bottom nav for mobile start -->
        <nav class="mobie_bottom_nav">
            <router-link :to="{name:'Home'}" title="Home" class="Home">
                <i class="icon fa fa-home"></i>
                Home
            </router-link>
            
            <button class="Categories" @click.prevent="$store.commit('catNavToggler', true)" title="Categories">
                <i class="icon fa fa-th-large"></i>
                Categories
            </button>
            <button class="Chating" title="Chating">
                <i class="icon fa fa-comments"></i>
                Chating
            </button>
            <button class="Cart mobile_cart_toggle_btn" title="Cart">
                <i class="icon fa fa-shopping-basket"></i>
                Cart
            </button>
            <button class="Account" title="Account">
                <i class="icon fa fa-user"></i>
                Account
            </button>
        </nav>
    <!-- bottom nav for mobile end -->
</template>

<script>
    export default {
        mounted(){
            // category toggler for mobile start
            /* let CategoriesBtn = document.querySelectorAll('.mobie_bottom_nav .Categories,.mobile_category_close');
            let bottom_bar_wrapper = document.querySelector('.bottom_bar_wrapper');
            if(CategoriesBtn && bottom_bar_wrapper)
            {
                (CategoriesBtn[0]) ? CategoriesBtn[0].addEventListener('click', toggleCat) : '';
                (CategoriesBtn[1]) ? CategoriesBtn[1].addEventListener('click', toggleCat) : '';

                function toggleCat()
                {
                    bottom_bar_wrapper.classList.toggle('active');
                }
            } */
            // category toggler for mobile end
        }
    }
</script>

<style scoped>
.mobie_bottom_nav{
    display: flex;
    justify-content: center;
    position: fixed;
    z-index: 5;
    bottom: 0;
    left: 0;
    width: 100%;
    background: #fff;
    padding: 0 1rem;
    gap: 10px;
    box-shadow: 0 -1px 4px #0004;
}
.mobie_bottom_nav>*{
    display: grid;
    justify-content: center;
    gap: 4px;
    color: #666;
    padding: 15px 5px;
    font-weight: 400;
    font-size: 0.8rem;
    text-align: center;
}
.mobie_bottom_nav>* .icon{
    font-size: 1.15rem;
}
.mobie_bottom_nav>*:hover{
    color: var(--primary_color);
}



@media all and (min-width: 901px){
    .mobie_bottom_nav{
        display: none;
    }
}
</style>