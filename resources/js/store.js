import { createStore } from 'vuex'

const store = createStore({
    state () {
      return {
        count: 0,
        cartItems: [
            {
                'product_name': "This is product name This is product name This",
                'product_id': "1",
                'product_img': "https://shop.activeitzone.com/public/uploads/all/f121PGFfa83b4nf5R04lhwQSM3VxCtyyrYWZf1Hn.webp",
                'product_price': {
                    regular: 120,
                    current: 200,
                    discount: 0
                },
                'qnty': 1,
                'attributes': [
                    {
                        name:"size", 
                        value:'S'
                    },
                    {
                        name:"color", 
                        value:'red'
                    }
                ],
                stock: 3
            },
            {
                'product_name': "ASUS ROG Phone 2 (New) Unlocked GSM US Version & Warranty",
                'product_id': "2",
                'product_img': "https://shop.activeitzone.com/public/uploads/all/UloibGzNcLOvClXvXj4sZK9eOMMt5NnoYEfr2uNi.webp",
                'product_price': {
                    regular: 150,
                    current: 100,
                    discount: 0
                },
                'qnty': 3,
                'attributes': [
                    {
                        name:"size", 
                        value:'S'
                    },
                    {
                        name:"color", 
                        value:'red'
                    }
                ],
                stock: 10
            }
        ]
      }
    },

    mutations: {
        increment (state, numberToAdd) {
            state.count += numberToAdd;
        },

        AddToCart(state){},

        UpdateCartItem(state, {ProductId, TotalQuantity})
        {
            state.cartItems.filter(item=>{
                if(item.product_id==ProductId)
                    item.qnty = TotalQuantity;
            })
        },

        DeleteCartItem(state, ProductId){
            let newCartItems = state.cartItems.filter(item=>{
                return item.product_id!=ProductId;
            });

            state.cartItems = newCartItems;
        }
    },

    actions: {},

    getters: {
        getNumber(state){
            state.myNumber.forEach(element => {
                console.log(element);
            });
        },

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
            state.cartItems.forEach(item=>{
                let prices = item.product_price;

                totalAmount += (prices.regular > prices.current) ? (prices.current*item.qnty) : (prices.regular*item.qnty);
            })

            return totalAmount;
        }
    }
})

export default store;