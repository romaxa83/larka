<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2>Chart</h2>
                <line-chart :chart-data="data" :height="250" :options="{responsive: true, maintainAspectRatio: true}"

                ></line-chart>

                <button @click="update" class="btn btn-primary btn-xs text mt-1 mh-10">Realtime</button>
            </div>
        </div>
    </div>
</template>

<script>
    // import LineChart from './LineChart'
    //
    // export default {
    //     components: {
    //         LineChart
    //     },
    //     data: function (){
    //         return {
    //             data: []
    //         }
    //     },
    //     mounted() {
    //         let socket = io('http://192.168.126.109:3000');
    //         console.log('euu');
    //         socket.on('real-chart:App\\Events\\ChartRealTimeEvent', function(data){
    //             console.log(data.result);
    //             this.data = data.result;
    //         }.bind(this));
    //
    //         this.update();
    //         this.chart()
    //     },
    //     methods: {
    //         chart: function(){
    //             axios.get('/admin/chart/chart/line').then((res) => {
    //                 this.data = res.data;
    //             });
    //         },
    //         update: function(){
    //             axios.get('/admin/chart/chart/line-random?realtime=true').then((res) => {
    //                 this.data = res.data;
    //             });
    //         }
    //     }
    // }
</script>