<template>
    <div class="container">
        <h3>{{category.title}}</h3>
        <p>{{category.slug}}</p>
        <br>
        <br>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="book in category.books" :key="book.id">
                    <td>{{ book.title }}</td>
                    <td>{{ book.description }}</td>
                </tr>
            </tbody>
        </table>
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
                query: this.$apiQueries.singleCategory,
                variables: {
                    categoryId: this.$route.params.id
                }
            }).then(res => {
                console.log(res);
                this.category = res.data.data.categories[0];
            })
        }
    }
</script>

<style scoped>

</style>