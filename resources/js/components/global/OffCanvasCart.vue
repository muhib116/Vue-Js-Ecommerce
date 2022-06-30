<script setup>
    import ProductCounter from '../ProductCounter.vue'
import EmptyCart from '../EmptyCart.vue'
</script>
<template>

<!-- cart open button start -->
    <div class="cart_toggle_btn">
        <div class="cart_items">
            <i class="fa fa-shopping-basket"></i>
            {{$store.getters.totalCartItem}} item(s)
        </div>
        <div class="total_amount">
            {{$store.getters.totalCartAmount}}$
        </div>
    </div>
<!-- cart open button end -->

<!-- cart start -->
    <div :class="($store.getters.totalCartItem==0) ? ['cart_wrapper empty'] : 'cart_wrapper'" >

        <!-- cart header -->
        <div class="card_header">
            <div class="cart_item_count">
                <i class="icon fa fa-shopping-basket"></i>
                <strong class="count">{{$store.getters.totalCartItem}}</strong>
                item(s) in Cart
            </div>
            <button class="cart_close">
                <svg id="Layer_1" fill="currentColor" width="16px" height="16px" viewBox="0 0 122.878 122.88" enable-background="new 0 0 122.878 122.88" xml:space="preserve"><g><path d="M1.426,8.313c-1.901-1.901-1.901-4.984,0-6.886c1.901-1.902,4.984-1.902,6.886,0l53.127,53.127l53.127-53.127 c1.901-1.902,4.984-1.902,6.887,0c1.901,1.901,1.901,4.985,0,6.886L68.324,61.439l53.128,53.128c1.901,1.901,1.901,4.984,0,6.886 c-1.902,1.902-4.985,1.902-6.887,0L61.438,68.326L8.312,121.453c-1.901,1.902-4.984,1.902-6.886,0 c-1.901-1.901-1.901-4.984,0-6.886l53.127-53.128L1.426,8.313L1.426,8.313z"/></g></svg>
            </button>
        </div>
        <!-- /cart header -->

        <template  v-if="$store.getters.totalCartItem">
            <!-- cart body -->
            <div class="card_body">

                <!-- single cart item -->
                <div class="list_items" v-for="(product, index) in $store.state.cartItems" :key="product.id">
                    <button class="cart_item_remove" @click="removeItemFromCart(product.product_id)">
                        <svg id="Layer_1" fill="currentColor" width="16px" height="16px" viewBox="0 0 122.878 122.88" enable-background="new 0 0 122.878 122.88" xml:space="preserve"><g><path d="M1.426,8.313c-1.901-1.901-1.901-4.984,0-6.886c1.901-1.902,4.984-1.902,6.886,0l53.127,53.127l53.127-53.127 c1.901-1.902,4.984-1.902,6.887,0c1.901,1.901,1.901,4.985,0,6.886L68.324,61.439l53.128,53.128c1.901,1.901,1.901,4.984,0,6.886 c-1.902,1.902-4.985,1.902-6.887,0L61.438,68.326L8.312,121.453c-1.901,1.902-4.984,1.902-6.886,0 c-1.901-1.901-1.901-4.984,0-6.886l53.127-53.128L1.426,8.313L1.426,8.313z"></path></g></svg>
                    </button>
                    <div class="product_img">
                        <img :src="product.product_img" :alt="product.product_name">
                        <div class="product_attr">
                            <div v-for="(attr,key) in product.attributes" :key="key">
                                <span>{{attr.name}} - </span>
                                <strong>{{attr.value}}</strong>
                            </div>
                        </div>
                    </div>
                    <div class="info">
                        <p class="product_name">{{product.product_name}}</p>
                        <ProductCounter :productId="product.product_id" :max="product.stock" :quantity="product.qnty" />
                    </div>
                    <div class="price_wrapper">
                        <del v-if="product.product_price.base_discounted>0">{{product.product_price.base}}$</del>
                        <span v-if="product.product_price.base_discounted>0">{{product.product_price.base_discounted}}$</span>
                        <span v-else>{{product.product_price.base}}$</span>
                    </div>
                </div>
                <!-- /single cart item -->

            </div>
            <!-- /cart body -->

            <!-- cart footer -->
            <div class="card_footer">
                <button class="checkout_btn">
                    Checkout {{$store.getters.totalCartAmount}}$
                </button>
            </div>
            <!-- /cart footer -->
        </template>


        <EmptyCart v-else />
    </div>
<!-- cart end -->
</template>

<script>
    export default {
        methods: {
            removeItemFromCart(product_id){
                this.$store.commit('DeleteCartItem', product_id)
            }
        },
        mounted()
        {
            // cart toggle start
            let cart_toggle_btn = document.querySelectorAll('.cart_toggle_btn, .cart_close, .mobile_cart_toggle_btn')
            let cart_wrapper    = document.querySelector('.cart_wrapper')

            if(cart_toggle_btn && cart_wrapper)
            {
                (cart_toggle_btn[0]) ? cart_toggle_btn[0].addEventListener('click', toggleCart) : '';
                (cart_toggle_btn[1]) ? cart_toggle_btn[1].addEventListener('click', toggleCart) : '';
                (cart_toggle_btn[2]) ? cart_toggle_btn[2].addEventListener('click', toggleCart) : '';

                function toggleCart(){
                    cart_wrapper.classList.toggle('active')
                }
            }
            // cart toggle end


            if(localStorage.getItem('cart')){
                this.$store.commit('setCartItemFromLocalStorage', localStorage.getItem('cart'));
            }
        }
    }
</script>


<style lang="scss" scoped>
/* cart button start */
    .cart_toggle_btn{
        position: fixed;
        right: 0;
        top: 50%;
        transform-origin: 100% 0%;
        transform: translateY(-50%);
        display: grid;
        justify-content: center;
        gap: 5px;
        padding: 15px;
        background-color: var(--primary_color);
        color: #fff;
        border-radius: 15px 0 0 15px;
        text-align: center;
        cursor: pointer;
        box-shadow: -1px 1px 4px #0002,  -1px 1px 10px #0002;
        transition: var(--transition);
        user-select: none;
        z-index: 10;
    }
    .cart_toggle_btn:hover{
        box-shadow: -1px 1px 15px var(--primary_color);
    }
    .cart_toggle_btn:active{
        transform: scale(0.95);
    }
    .cart_toggle_btn .cart_items{
        font-size: 0.8rem;
        display: flex;
        gap: 5px;
        align-items: center;
        justify-content: center;
    }
    .cart_toggle_btn .total_amount{
        font-size: 0.8rem;
        background-color: #fff;
        color: var(--primary_color);
        padding: 6px 10px;
        border-radius: 4px;
    }
/* cart button end */


/* cart design start */
    .cart_wrapper{
        z-index: 11;
        height: 100vh;
        position: fixed;
        top: 0;
        right: 0;
        width: var(--cart_width);
        background: #fff;
        box-shadow: -1px 0 4px #0002, -1px 0 14px #0002;
        display: grid;
        grid-template-rows: 80px 1fr 60px;
        transform: translateX(100%);
        transition: 0.2s ease;

        &.empty{
            grid-template-rows: 80px 1fr;
        }
    }
    .cart_wrapper.active{
        transform: translateX(0%);
    }

    /* cart header start */
    .cart_wrapper .card_header{
        border-bottom: 1px solid var(--border_color);
        padding: 0.5rem 1rem;
        display: grid;
        grid-template-columns: 1fr 60px;
        align-items: center;
        position: relative;
        text-transform: capitalize;
    }
    .card_header .cart_item_count{
        display: flex;
        align-items: center;
        gap: 10px;
        border-right: 1px solid var(--border_color);
    }
    .card_header .cart_item_count .icon{
        font-size: 1.5rem;
    }
    .cart_wrapper .card_header .cart_close{
        aspect-ratio: 1/1;
        font-size: 2rem;
        background: transparent;
        border: none;
        position: relative;
        color: #ff0000;
    }
    /* cart header end */


    /* cart body start */
    .card_body{
        overflow-y: auto;
    }
    .card_body .list_items{
        padding: 10px 15px;
        display: grid;
        gap: 10px;
        grid-template-columns: 25px 90px 1fr 60px;
        align-items: center;
        border-bottom: 1px solid var(--border_color);
        transition: var(--transition);
    }
    .card_body .list_items:hover{
        background-color: #f8f8f8;
    }
    .card_body .list_items .product_attr{
        font-weight: 300;
        font-size: 12px;
        margin: 0;
        border-top: 1px solid var(--border_color);
        text-align: center;
    }
    .card_body .list_items .product_name{
        font-weight: 300;
        font-size: 14px;
    }
    .card_body .list_items .info{
        display: grid;
        align-items: center;
    }
    .card_body .list_items .cart_item_remove{
        width: 25px;
        height: 25px;
        display: grid;
        place-content: center;
        color: #fff;
        padding: 6px;
        border: none;
        background: var(--danger_color);
        cursor: pointer;
        border-radius: 50%;
        transition: var(--transition);
    }
    .card_body .list_items .cart_item_remove:hover{
        background: red;
        transform: scale(1.2);
    }
    .card_body .price_wrapper{
        display: grid;
        gap: 0;
    }
    .card_body .price_wrapper del{
        color: #999;
    }
    .card_body .price_wrapper span{
        color: var(--primary_color);
        font-weight: 500;
        font-size: 1rem;
    }
    /* cart body end */


    /* cart footer start */
    .card_footer{
        display: grid;
        place-content: center;
        border-top: 1px solid var(--border_color);
    }
    .card_footer .checkout_btn{
        background: var(--primary_color);
        border: none;
        color: #fff;
        padding: 10px 20px;
        font-size: 1.2rem;
        border-radius: 2px;
        cursor: pointer;
        box-shadow: 1px 0 10px var(--primary_color);
    }
    /* cart footer end */

/* cart design end */



    @media all and (max-width: 768px){
        div.cart_toggle_btn{
            display: none;
        }
        .cart_wrapper{
            --cart_width: 100%;
        }
    }
</style>