<template>
    <transition>
        <div v-if="$store.state.catNavToggler">
            <div class="container_overlay">
                <button @click="$store.commit('catNavToggler', false)" class="catNavToggleBtn btn_ripple">
                    <i class="fa fa-close"></i>
                </button>
                <div class="cat_container">
                    <template v-for="cat in categoryList">
                        <a href="#">
                            {{cat.name}}
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </template>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
    import config from '../../config';
    export default {
        data(){
            return {
                categoryList: '',
                catShow: true
            }
        },
        async mounted(){
            let response = await config.callAPI('categories/parent');
            this.categoryList = response.data;
        }
    }
</script>

<style lang="scss" scoped>
.catNavToggleBtn {
    position: absolute;
    background: var(--danger_color);
    z-index: 1;
    right: 50%;
    top: 50%;
    transform: translate(50%, -50%);
    width: 150px;
    height: 150px;
    font-size: 60px;
    border-radius: 50%;
    opacity: 0.4;
    color: #fff;
    transition: var(--transition);

    &:hover{
        opacity: 1;
    }
}
.btn_ripple {
    border: 2px solid #fff;
    animation-name: ripple;
    animation-duration: 1.5s;
    animation-iteration-count: infinite;
}


.v-enter-active,
.v-leave-active {
  transition: opacity 0.5s ease;
}

.v-enter-from,
.v-leave-to {
  opacity: 0;
}

@keyframes ripple {
    0% {
        box-shadow: 0 0 0 0 #fff4, 0 0 0 0 #fff4;
    }

    80% {
        box-shadow: 0 0 0 20px #fff0, 0 0 0 40px #fff0;
    }

    100% {
        box-shadow: 0 0 0 0 #fff0, 0 0 0 0 #fff0;
    }
}


.container_overlay {
    position: fixed;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    background: rgb(0 0 0 / 91%);
    // backdrop-filter: blur(19px);
    z-index: 100;
}
.cat_container {
    display: grid;
    position: fixed;
    background: #fff;
    top: 0;
    left: 0;
    bottom: 0;
    overflow-y: auto;
    height: 100vh;
    box-shadow: 1px 0 4px #0001, 1px 0 6px #0001;
    max-width: 250px;
}

.cat_container a {
    color: #111;
    font-size: 0.89em;
    display: flex;
    justify-content: space-between;
    gap: 1rem;
    align-items: center;
    width: 100%;
    padding: 5px 25px;

    &:is(:hover, .active){
        background-color: #efefef;
    }
}

.cat_container a+a {
    border-top: 1px solid #0001;
}


@media all and (max-width: 768px){
    .catNavToggleBtn {
        right: 1rem;
        top: 1rem;
        transform: unset;
        width: 50px;
        height: 50px;
        font-size: 25px;
        opacity: 1;
    }
}
</style>