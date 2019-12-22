<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <button @click="send" class="btn btn-primary btn-xs text mt-1 mh-10">Chat</button>
            </div>
        </div>
    </div>
</template>

<!--<script>-->
    <!--const conn = new WebSocket('ws://192.168.126.102:8080');-->

    <!--conn.onopen = function(e) {-->
        <!--console.log(e);-->
    <!--};-->

    <!--conn.onmessage = function(e) {-->
        <!--console.log('Получены данные: ' + e.data);-->
    <!--};-->

    <!--function send(){-->

        <!--let data = 'Данные для отправки: ' + Math.random();-->
        <!--conn.send(data);-->
        <!--console.log('Отправленно: ' + data);-->
    <!--}-->
<!--</script>-->

<script>

    export default {
        methods: {
            send: function(){


            }
        }
    }
</script>
