<template>
    <div>
        <navbar></navbar>
        <section id="body-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <router-view></router-view>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <!--<chartline-component></chartline-component>-->
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    import Navbar from './Navbar.vue';

    export default {
        name: "app",
        components: {
            Navbar
        },
        mounted() {
            console.log('App.vue');
        }
    }
</script>
