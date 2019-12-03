<template>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{category.title}}</h5>
            <p class="card-text">{{category.slug}}</p>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['category']
    }
</script>