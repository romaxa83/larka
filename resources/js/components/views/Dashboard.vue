<template>
    <div class="container">
        <div class="card-columns">
            <category-card
                    v-for="category in categories"
                    :category="category"
                    :key="category.id"
            ></category-card>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import CategoryCard from './../CategoryCard.vue';

    export default {
        components: {CategoryCard},
        data() {
            return {
                categories: []
            }
        },
        created() {
            axios.post('/graphql', {
                query: '{categories{id, title, slug}}'
            }).then(res => {
                this.categories = res.data.data.categories;
            })
        }
    }

</script>