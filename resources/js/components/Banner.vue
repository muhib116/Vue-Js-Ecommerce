<template>
    <section class="banner_wrapper">
        <div class="container py_0">
            <div class="banner_one">
                <a href="#">
                    <img src="https://shop.activeitzone.com/public/uploads/all/Oj6iFR5o7BxzmYyYckZKKeyMy4rQa1McRCSQHKG3.webp" alt="test">
                </a>
            </div>
            <div class="banner_two">
                <div class="banner_two_bottom">
                    <div class="one">
                        <a href="#">
                            <img src="https://shop.activeitzone.com/public/uploads/all/CqRc0cFVxUffEmhhWSMO9aoA0ANOEx1teWjbM3nc.webp" alt="">
                        </a>
                    </div>
                    <div class="two">
                        <a href="#">
                            <img src="https://shop.activeitzone.com/public/uploads/all/a3LaXlWMa9vvEwvS69dVbzT6r0LE3hczSXOGnIDY.webp" alt="">
                        </a>
                    </div>
                </div>
                <div class="banner_two_top">
                    <a href="#">
                        <img src="https://shop.activeitzone.com/public/uploads/all/Y7IuvQwPLMjN21CRQVnzZX2c3ePzTbNthDCgcPl9.webp" alt="test">
                    </a>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        
    }
</script>

<style scoped>
    .banner_wrapper a{
        overflow: hidden;
        display: block;
    }
    .banner_wrapper a img{
        transition: var(--transition);
    }
    .banner_wrapper a:hover img{
        transform: scale(1.1) rotateZ(2deg);
    }
    .banner_wrapper>* {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.8rem;
        margin-top: 0.8rem;
    }
    .banner_wrapper .banner_two{
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.8rem;
    }
    .banner_wrapper .banner_two_bottom{
        display: grid;
        gap: 0.8rem;
    }

    @media all and (max-width: 1100px){
        .banner_wrapper>* {
            grid-template-columns: 1fr;
        }
        .banner_wrapper .banner_three{
            display: grid;
            gap: 15px;
        }
    }.banner_wrapper a{
        overflow: hidden;
        display: block;
    }
    .banner_wrapper a img{
        transition: var(--transition);
    }
    .banner_wrapper a:hover img{
        transform: scale(1.1) rotateZ(2deg);
    }
    .banner_wrapper>* {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.8rem;
        margin-top: 0.8rem;
    }
    .banner_wrapper .banner_two{
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.8rem;
    }
    .banner_wrapper .banner_two_bottom{
        display: grid;
        gap: 0.8rem;
    }

    @media all and (max-width: 1100px){
        .banner_wrapper>* {
            grid-template-columns: 1fr;
        }
        .banner_wrapper .banner_three{
            display: grid;
            gap: 15px;
        }
    }
</style>