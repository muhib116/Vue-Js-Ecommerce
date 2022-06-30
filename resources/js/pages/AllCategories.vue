<template>
<div class="all_category_container">
        <div class="container">
            <div class="section_header">
                <h2 class="title">All Categories</h2>
            </div>
            <div class="content">
                <div class="all_categories">
                    
                    <div v-for="cat in categoryList" :key="cat.id" class="cat_item">
                        <a href="#">
                            <img :src="cat.icon" :alt="cat.name">
                        </a>
                        <div class="content">
                            <h5 class="cat_name">
                                <router-link :to="{name:'CategoryWiseProducts', params:{id:cat.id}}">{{cat.name}}</router-link>
                            </h5>
                            <div class="sub_cats">
                                <router-link v-for="(subcat, index) in cat.children.data" :to="{name:'CategoryWiseProducts', params:{id:cat.id}}">
                                    <span v-if="index != 0">, </span>
                                    {{ subcat.name }}
                                </router-link>
                            </div>
                        </div>
                    </div>
    
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import config from '../config'

    export default {
        data(){
            return {
                categoryList: ''
            }
        },
        async mounted(){
            let response = await config.callAPI('categories/parent');
            this.categoryList = response.data;
        }
    }
</script>

<style lang="scss" scoped>
.all_categories {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 1rem;
}

.all_categories>.cat_item {
    border: 1px solid var(--border_color);
    display: grid;
    grid-template-columns: 0.6fr 1fr;
}

.all_categories>.cat_item .sub_cats {
    font-size: 0.9rem;
    font-weight: 300;
    color: #666;
    line-height: 1.4;
}

.all_categories>.cat_item .content {
    padding: 1rem;
}

.all_categories>.cat_item .cat_name {
    margin: 0;
    margin-bottom: 10px;
    font-size: 1.2rem;
    font-weight: 500;
}
</style>