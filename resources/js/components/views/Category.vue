<template>
    <div class="container">
        <h3>{{category.title}}</h3>
        <p>{{category.slug}}</p>
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        // name: "category",
        data() {
            return {
                category: {}
            }
        },
        created() {
            axios.post('/graphql', {
                query: `{
                    categories(categoryId: ${this.$route.params.id}) {
                        id,title,slug
                    }
                }`
            }).then(res => {
                console.log(res);
                this.category = res.data.data.categories[0];
            })
        }
    }
</script>

<style scoped>

</style>