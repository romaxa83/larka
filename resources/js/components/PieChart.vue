<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2>Chart</h2>
                <pie-chart :chart-data="data" :height="250" :options="{responsive: true, maintainAspectRatio: true}"

                ></pie-chart>
            </div>
        </div>
    </div>
</template>

<script>
    import PieChart from './PieChart'

    export default {
        components: {
            PieChart
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
            update: function(){
                axios.get('/admin/chart/chart/pie').then((res) => {
                    this.data = res.data;
                });
            }
        }
    }
</script>