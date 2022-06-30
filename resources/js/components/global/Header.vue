<script setup>
    import CatNav from './CatNav.vue';
</script>

<template>
    <header class="header_wrapper">
        <!-- top bar start -->
        <div class="topbar_wrapper">
            <div class="container py_0">
                <div class="left">

                    <div class="language dropdown_with_img">
                        <span class="main_item">English</span>
                        <div class="lang_list">
                            <div data-value="English">
                                <img src="https://shop.activeitzone.com/public/assets/img/flags/en.png" alt="">
                                <span>English</span>
                            </div>
                            <div data-value="English">
                                <img src="https://shop.activeitzone.com/public/assets/img/flags/bd.png" alt="">
                                <span>Bangla</span>
                            </div>
                            <div data-value="English">
                                <img src="https://shop.activeitzone.com/public/assets/img/flags/in.png" alt="">
                                <span>Hindi</span>
                            </div>
                            <div data-value="English">
                                <img src="https://shop.activeitzone.com/public/assets/img/flags/fr.png" alt="">
                                <span>France</span>
                            </div>
                        </div>
                    </div>


                    <a href="#">
                        <i class="icon fa fa-android"></i>
                        play Store
                    </a>

                    <a href="#">
                        <i class="icon fa fa-apple"></i>
                        App Store
                    </a>

                    <a href="#">
                        Be a Seller
                    </a>

                </div>
                <div class="right">

                    <a href="#">
                        <i class="icon fa fa-thumb-tack"></i>
                        Track Order
                    </a>

                    <a href="#">
                        <i class="icon fa fa-phone"></i>
                        Help Line {{phone}}
                    </a>

                    <a href="#">
                        <i class="icon fa fa-heart"></i>
                        Wishlist (0)
                    </a>
                </div>
            </div>
        </div>
        <!-- topbar end -->

        <!-- middlebar start -->
        <div class="middlebar_wrapper">
            <div class="container py_0">
                <router-link active-class="active" :to="{name:'Home'}"  class="brand_logo">
                    <img :src="logo" :alt="site_name">
                </router-link>

                <form action="#" method="get">
                    <input type="search" placeholder="Searce...">
                    <button type="submit">
                        <i class="icon fa fa-search"></i>
                    </button>
                </form>

                <div class="login_registration">
                    <router-link class="wishlist_btn" :to="{name: 'Wishlist'}">
                        <i class="fa fa-heart"></i>
                        <span class="count">5</span>
                    </router-link>
                    <i class="icon fa fa-user"></i>
                    <a href="#">Login</a>
                    <span>|</span>
                    <a href="#">Registration</a>
                </div>

            </div>
        </div>
        <!-- middlebar end -->

        <!-- bottombar start -->
        <div class="container py_0">
            <nav class="bottom_bar_wrapper">
                <a href="" @click.prevent="$store.commit('catNavToggler', true)">Categories</a>
                <router-link active-class="active" :to="{name:'AllShops'}">
                    All Seller
                </router-link>
                <router-link active-class="active" :to="{name:'Offers'}">
                    Offers
                </router-link>
                <a href="#">Coupon</a>
                <a href="#">Computer & Accessories</a>
                <button class="mobile_category_close">
                    <svg id="Layer_1" fill="currentColor" width="16px" height="16px" viewBox="0 0 122.878 122.88" enable-background="new 0 0 122.878 122.88" xml:space="preserve"><g><path d="M1.426,8.313c-1.901-1.901-1.901-4.984,0-6.886c1.901-1.902,4.984-1.902,6.886,0l53.127,53.127l53.127-53.127 c1.901-1.902,4.984-1.902,6.887,0c1.901,1.901,1.901,4.985,0,6.886L68.324,61.439l53.128,53.128c1.901,1.901,1.901,4.984,0,6.886 c-1.902,1.902-4.985,1.902-6.887,0L61.438,68.326L8.312,121.453c-1.901,1.902-4.984,1.902-6.886,0 c-1.901-1.901-1.901-4.984,0-6.886l53.127-53.128L1.426,8.313L1.426,8.313z"></path></g></svg>
                </button>
            </nav>
        </div>
        <!-- bottombar end -->

    </header>
    <CatNav />
</template>

<script>
    import Config from '../../config.js'
    export default {
        data(){
            return {
                logo: '',
                site_name: '',
                phone: '',
            }
        },
        async mounted(){
            let response = await Config.callAPI('site_settings');
            this.logo = response.logo;
            this.site_name = response.site_name;
            this.phone = response.phone;

            document.title = response.title
        }
    }
</script>

<style lang="scss" scoped>
    /* topbar start */
    .header_wrapper .topbar_wrapper{
        display: none;
        font-size: 0.8rem;
        background-color: var(--topbar_bg);
        border-bottom: 1px solid var(--border_color);
        padding: 5px 0;
        color: var(--topbar_text_color);

        a:hover{
            color: var(--topbar_text_color);
        }
    }
    .header_wrapper .topbar_wrapper>*{
        display: flex;
        justify-content: space-between;
    }
    .header_wrapper .topbar_wrapper .left,
    .header_wrapper .topbar_wrapper .right{
        display: flex;
        flex-wrap: wrap;
        gap: 0.6rem;
        align-items: center;
    }
    .header_wrapper .topbar_wrapper :is(.left,.right)>*+*{
        border-left: 1px solid var(--topbar_border_color);
        padding-left: 0.6rem;
    }
    /* topbar start */


    /* middlebar start */
    .middlebar_wrapper{
        border-bottom: 1px solid var(--border_color);
        padding: 0.8rem 0;
    }
    .middlebar_wrapper>*{
        display: grid;
        grid-template-columns: 150px 1fr 250px;
        align-items: center;
        gap: 1rem;
    }

    .middlebar_wrapper form{
        position: relative;
        max-width: 450px;
        width: 100%;
        margin: auto;
    }
    .middlebar_wrapper form input{
        border-color: #0002;
        padding-left: 25px;
        padding-right: 55px;
        border-radius: 2px;
        border-radius: 40px;
    }
    .middlebar_wrapper form input:focus{
        border-color: var(--primary_color);
    }
    .middlebar_wrapper form button[type=submit]{
        position: absolute;
        top: 50%;
        right: 5px;
        transform: translate(0, -50%);
        border: none;
        background: var(--primary_color);
        height: 80%;
        aspect-ratio: 1/1;
        font-size: 1.4rem;
        color: #fff;
        cursor: pointer;
        border-radius: 40px;
        transition: var(--transition);
    }
    .middlebar_wrapper form button[type=submit]:hover{
        box-shadow: 0 1px 5px var(--primary_color);
        border-radius: 40px;
    }

    .middlebar_wrapper .login_registration{
        display: flex;
        gap: 0.5rem;
        justify-content: flex-end;
        align-items: center;
        font-weight: 500;
    }
    .middlebar_wrapper .login_registration .icon{
        font-size: 1.2rem;
        background-color: var(--primary_color);
        color: #fff;
        padding: 5px;
        width: 35px;
        min-width: 35px;
        aspect-ratio: 1/1 !important;
        display: grid;
        place-content: center;
        border-radius: 50%;
        margin-right: 5px;
        box-shadow: 0 1px 10px var(--primary_color);
    }
    .middlebar_wrapper .login_registration span{
        font-weight: 300;
        font-size: 20px;
    }
    .wishlist_btn {
        width: 35px;
        min-width: 35px;
        background: var(--danger_color);
        position: relative;
        aspect-ratio: 1/1;
        display: grid;
        place-content: center;
        padding: 5px;
        font-size: 1rem;
        box-shadow: 0 1px 10px var(--danger_color);
        border-radius: 50%;
        color: #fff;
        margin-right: 5px;
    }

    .wishlist_btn .count {
        position: absolute;
        top: 2px;
        right: 2px;
        transform: translate(50%, -50%);
        font-size: 0.8rem !important;
        aspect-ratio: 1/1;
        display: grid;
        place-content: center;
        width: 25px;
        background: var(--danger_color);
        border-radius: 50%;
        box-shadow: 0 1px 4px #0002;
        color: white;
        border: 2px solid;
    }
    /* middlebar end */


    /* bottombar start */
    .bottom_bar_wrapper{
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        padding: 5px 0;
        gap: 0.5rem;
        font-size: 0.95rem;
        border-bottom: 1px solid var(--border_color);
    }
    .bottom_bar_wrapper a{
        padding: 5px 5px;
        line-height: 1.2;
        color: #666;
        font-weight: 500;

        &:is(:hover,.active){
            color: var(--primary_color)
        }
    }
    .mobile_category_close{
        display: none;
    }
    /* bottombar end */




    @media all and (max-width: 900px){
        .topbar_wrapper{
            display: none;
        }

        nav.bottom_bar_wrapper {
            padding-top: 40px;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            left: 0;
            background: #fff;
            width: 100%;
            height: 100%;
            justify-content: flex-start;
            transform: translateY(100%);
            transition: var(--transition);
            flex-wrap: nowrap;
            overflow-y: auto;
            z-index: 9;  
        }
        nav.bottom_bar_wrapper.active {
            transform: translateY(0%);
        }
        
        nav.bottom_bar_wrapper>a{
            display: block;
            padding: 10px 25px;
        }
        nav.bottom_bar_wrapper>a+a{
            border-top: 1px solid var(--border_color)
        }

        
        .bottom_bar_wrapper .mobile_category_close{
            position: absolute;
            top: 10px;
            right: 10px;
            width: 35px;
            height: 35px;
            display: grid;
            place-content: center;
            background-color: var(--danger_color);
            color: #fff;
        }
    }

    @media all and (max-width: 768px){
        .middlebar_wrapper>*{
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .middlebar_wrapper form{
            max-width: 80%;
            min-width: 80%;
            display: block;
            order: 2;
        }
        .middlebar_wrapper form button[type="submit"] {
            right: 5px;
            left: unset;
            transform: translateY(-50%)
        }
        .middlebar_wrapper .brand_logo{
            order: 0;
            width: 150px;
        }
        .middlebar_wrapper .login_registration{
            order: 1;
            width: 50%;
            justify-self: flex-end;
        }
    }

    @media all and (max-width: 500px){
        .middlebar_wrapper .login_registration .icon{
            display: none;
        }
    }
</style>