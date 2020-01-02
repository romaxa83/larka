<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Vue</a>
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
                    <router-link class="nav-link" :to="`/echo-chat`">
                        Echo-Chat
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link" :to="`/login`">
                        Login
                    </router-link>
                </li>
            </ul>
        </div>
    </nav>
</template>

<script>
    export default {
        name: "navbar"
    }
</script>

<style scoped>

</style>