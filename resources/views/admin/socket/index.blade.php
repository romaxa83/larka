@extends('layouts.admin')

@section('content')

    <div class="container-fluid">
        <h2>Socket</h2>
        <div class="row col-6">
            <button onclick="send();" class="btn btn-primary btn-xs text mt-1 mh-10">Chat</button>
        </div>
    </div>

   <script>
       var conn = new WebSocket('ws://192.168.126.102:8080');

       conn.onopen = function(e) {
       console.log(e);
       };

       conn.onmessage = function(e) {
       console.log('Получены данные: ' + e.data);
       };

       function send(){
           let data = 'Данные для отправки: ' + Math.random();
           conn.send(data);
           console.log('Отправленно: ' + data);
       }

   </script>

@endsection
