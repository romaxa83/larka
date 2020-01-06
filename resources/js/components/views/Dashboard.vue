<template>
    <div class="container">
        <div class="user" :user="userId"></div>
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
                categories: [],
                userId: ''
            }
        },
        created() {
            axios.post('/graphql', {
                // запрос вынесен в queries.js
                query: this.$apiQueries.dashboard
            }).then(res => {
                this.categories = res.data.data.categories;
            });

            axios.post('/get-auth-user')
                .then(res => {
                    console.log(res.data.data.id);
                    this.userId = res.data.data.id
                })
        },
        mounted() {
            let socket = io('http://192.168.126.109:3000');
            console.log('UserId - ' + this.userId);
            socket.on('pr.message.'+ '16' +':App\\Events\\PrivateMessageEvent', function(data){
                console.log(data);
            }.bind(this));
        },
    }

</script>