<template>
    <div class="category_container">
        <div class="container">
            <div class="section_header">
                <h2 class="title">Popular Categories</h2>
                <router-link :to="{name:'AllCategories'}">
                    View All
                    <i class="fa fa-angle-right"></i>
                </router-link>
            </div>
            <div class="content">
                <div id="categories-carousel">
                    
                    <div v-for="cat in categories" :key="cat.name" class="cat_item">
                        <router-link :to="{name:'CategoryWiseProducts', params: { slug: cat.url }}">
                            <img :src="cat.icon" :alt="cat.name">
                            <p class="name" :title="cat.name">{{cat.name}}</p>
                        </router-link>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Config from '../config.js'
    export default {
        data(){
            return {
                categories: []
            }
        },
        async mounted(){
            let response = await Config.callAPI('categories/popular');
            this.categories = response.data;
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