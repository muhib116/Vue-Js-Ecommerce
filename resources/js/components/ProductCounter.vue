<template>
    <div class="product_counter">
        <button type="button" @click="productQntyUpDown(-1)">-</button>
        <input type="text" :min="min" :value="qnty" :max="max">
        <button type="button" @click="productQntyUpDown(+1)">+</button>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                qnty: 1
            }
        },
        props: {
            min: {
                default: 1
            },
            max: {
                default: 1
            },
            productId: {
                default:undefined
            },
            quantity: {
                default: 1
            },
        },
        mounted(){
            this.qnty = this.quantity
        },
        updated(){
            this.qnty = this.quantity
        },
        methods: {
            productQntyUpDown(value){
                value = parseInt(value);
                if((this.qnty > this.min) && value<0)
                    this.qnty--;

                if((this.qnty < this.max) && value>0)
                    this.qnty ++;

                // updateCart
                this.$store.commit('UpdateCartItem', {ProductId:this.productId, TotalQuantity:this.qnty});
            }
        }
    }
</script>

<style scoped>
    /* product counter start */
    .product_counter{
        display: flex;
        width: fit-content;
        border: 1px solid var(--primary_color);
    }
    .product_counter input{
        padding: 2px;
        width: 50px;
        text-align: center;
        appearance: none;
        border-radius: 0;
        border: none;
        font-size: 14px;
        background: transparent;
    }
    .product_counter input:focus{
        box-shadow: unset;
    }
    .product_counter button{
        border: none;
        background: var(--primary_color);
        color: #fff;
        display: grid;
        place-content: center;
        min-width: 20px;
        aspect-ratio: 1/1;
        font-size: 16px;
        cursor: pointer;
        border-radius: 0;
    }
    /* product counter end */
    .quantity {
        width: fit-content;
        text-align: center;
        border: 1px solid #0001;
        display: flex;
    }
    .quantity input{
        padding: 6px;
        text-align: center;
        font-size: 12px;
        border-radius: 0px;
        border:
        none;
        border-left: 1px solid #0001;
        border-right: 1px solid #0001;
        width: 45px;
        height: 38px;
    }
    .quantity button{
        background-color: #f7f7f7;
        width: 30px;
        border: none;
        outline: none;
        transition: var(--transition);
        aspect-ratio: 1/1;
    }
    .quantity button:hover{
        background-color: var(--secondary_color);
        color: #fff;
    }
</style>