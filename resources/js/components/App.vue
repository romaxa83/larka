<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <router-link class="nav-link" :to="`/line-chart`">
                            LineChart
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to="`/pie-chart`">
                            PieChart
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to="`/chat`">
                            Chat
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                    </li>
                </ul>
            </div>
        </nav>
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

<!--<script>-->
    <!--export default {-->
        <!--name: "app"-->
    <!--}-->
<!--</script>-->

<!--<style scoped>-->

<!--</style>-->