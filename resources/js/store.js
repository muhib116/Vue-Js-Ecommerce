import { createStore } from 'vuex'

const store = createStore({
    state () {
      return {
        catNavToggler: false,
        cartItems: []
      }
    },

    mutations: 
    {
        catNavToggler (state, status) {
            state.catNavToggler = status;
        },

        AddToCart(state, $data)
        {
            let ExistanceStatus = false;
            for(let i=0; i<state.cartItems.length; i++){
                if(state.cartItems[i].product_id == $data.id){
                    ExistanceStatus = true;
                    break;
                }
            }

            if(!ExistanceStatus){
                let productInfo = {
                    'product_name': $data.name,
                    'product_id': $data.id,
                    'product_img': $data.thumbnail_image,
                    'product_price': {
                        base: $data.base_price,
                        base_discounted: $data.base_discounted_price,
                        discount: $data.discount
                    },
                    'qnty': 1,
                    'attributes': [
                        {
                            name:"size", 
                            value:'S'
                        }
                    ],
                    stock: $data.stock,
                    unit: $data.unit
                }
                state.cartItems.push(productInfo);
            }else
            {
                state.cartItems.filter(item=>{
                    if(item.product_id==$data.id){
                        item.qnty += 1;
                    }
                })
            }

            
            // update localStorage
            localStorage.setItem('cart', JSON.stringify(state.cartItems))
        },

        UpdateCartItem(state, {ProductId, TotalQuantity})
        {
            state.cartItems.filter(item=>{
                if(item.product_id==ProductId)
                    item.qnty = TotalQuantity;
            })

            // update localStorage
            localStorage.setItem('cart', JSON.stringify(state.cartItems));
        },

        DeleteCartItem(state, ProductId){
            let newCartItems = state.cartItems.filter(item=>{
                return item.product_id!=ProductId;
            });

            state.cartItems = newCartItems;
            
            // update localStorage
            localStorage.setItem('cart', JSON.stringify(state.cartItems));
        },

        setCartItemFromLocalStorage(state, cartData)
        {
            state.cartItems = JSON.parse(cartData);
        }
    },

    actions: {},

    getters: {
        // calucalate total items on cart
        totalCartItem(state){
            let totalItem = 0;
            state.cartItems.forEach(item=>{
                totalItem += item.qnty
            })

            return totalItem;
        },

        totalCartAmount(state){
            let totalAmount = 0;
            if(state.cartItems.length>0){
                state.cartItems.forEach(item=>{
                    let prices = item.product_price;
                    console.log(prices)
    
                    totalAmount += (prices.base_discounted > 0) ? (prices.base_discounted*item.qnty) : (prices.base*item.qnty);
                })
            }

            return totalAmount;
        },
        GetSingleProductQnty: (state)=>(ProductId)=>{
            let qnty = 0;
            state.cartItems.filter(item=>{
                if(item.product_id==ProductId){
                    qnty = item.qnty;
                }
            });

            return qnty;
        },
    }

});


export default store;