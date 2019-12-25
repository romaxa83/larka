@extends('layouts.admin')

@section('content')

    <div class="container-fluid">
        <h2>Socket</h2>
        <div class="row col-6">
            <button onclick="send();" class="btn btn-primary btn-xs text mt-1 mh-10">Chat</button>
        </div>
    </div>
    {{--<script src="http://autobahn.s3.amazonaws.com/js/autobahn.min.js"></script>--}}
    <script>
        // http://autobahn.vs/js/reference_vampv1.html#ab-connect
        // var conn = new ab.connect(
        //     'ws://192.168.126.102:8080',
        //     function(session){
        //         session.subscribe('onNewData', function(topic, data){
        //             console.info('New data: topic_id: "'+ topic +'"');
        //             console.log(data.data);
        //         })
        //     },
        //     function(code, reason, detail){
        //         // обработцик ошибки
        //         console.warn('Websocket connection closed: code=' + code + '; reason=' + reason + '; detail=' + detail);
        //     },
        //     {
        //         'maxRetries': 60,
        //         'retryDelay': 4000,
        //         'skipSubprotocolCheck': true
        //     }
        // );

    </script>

@endsection
