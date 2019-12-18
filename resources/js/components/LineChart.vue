<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2>Chart</h2>
                <line-chart :chart-data="data" :height="250" :options="{responsive: true, maintainAspectRatio: true}"

                ></line-chart>

                <button @click="update" class="btn btn-primary btn-xs text mt-1 mh-10">Update</button>
            </div>
        </div>
    </div>
</template>

<script>
    import LineChart from './LineChart'

    export default {
        components: {
            LineChart
        },
        data: function (){
            return {
                data: []
            }
        },
        mounted() {
            this.update()
        },
        methods: {
            // chart: function(){
            //     axios.get('/admin/chart/chart/line').then((res) => {
            //         this.data = res.data;
            //     });
            // },
            update: function(){
                axios.get('/admin/chart/chart/line-random').then((res) => {
                    this.data = res.data;
                });
            }
        }
    }
</script>