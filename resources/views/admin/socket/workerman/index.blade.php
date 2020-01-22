@extends('layouts.admin')

@section('breadcrumbs')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-8">
                    <div class="row">
                        <div class="col-md-6">
                            <h1>Socket with Workerman</h1>
                            <a href="https://github.com/walkor/Workerman" target="_blank"><i class="fab fa-github"></i> Git Hub</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Rooms</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Workerman</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <p>
                                        В корне проекта лежит лежит файл socket-server.php который запустит
                                        сервер для сокетов ( php socket-server.php start )
                                    </p>
                                    <p>
                                        Для отправки сообщений конкретному пользователю

                                    </p>

                                    <pre>
$localsocket = 'tcp://192.168.126.102:1234';
$user = 'user01';   // ID пользователя
$message = 'test';

// соединяемся с локальным tcp-сервером
$instance = stream_socket_client($localsocket);

// отправляем сообщение
fwrite($instance, json_encode(['user' => $user, 'message' => $message])  . "\n");
                                    </pre>

                                    <br>
                                        Порт для tcp-сервера можно указывать любой, хост - тот на котором есть php </br>
                                        зачастую localhost (tcp://127.0.0.1), но он и порт обязаны совпадать с tcp-сервером
                                        в файле socker-server.php
                                    </p>
                                    <p>
                                        На клиенте используется примерно такоей код
                                    </p>
                                    <pre>
let ws = new WebSocket('ws://192.168.126.102:8080/?user=user01');

ws.addEventListener('message', (event) => {
    console.log('Message from server: ' + event.data);
})
                                    </pre>
                                    <p>
                                        где передаеться ws-сервер указаные в файле socket-server.php
                                    </p>
                                    <p>
                                        <a href="https://habr.com/ru/post/331462/" target="_blank">Больше информации на хабре</a><br>
                                        <a href="https://github.com/morozovsk/workerman-examples" target="_blank">https://github.com/morozovsk/workerman-examples</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <a href="{{ route('admin.socket.workerman.push') }}" class="btn btn-primary btn-xs text mt-1 mh-10">Push</a>
                    <p id="userId">{{$user->id}}</p>
                </div>
            </div>
        </div>
    </section>
    <script>
        let userId = document.getElementById('userId').innerHTML;
        let ws = new WebSocket(`ws://192.168.126.102:8080/?user=${userId}`);

        ws.addEventListener('message', (event) => {
            console.log('Message from server: ' + event.data);
        })
    </script>
@endsection