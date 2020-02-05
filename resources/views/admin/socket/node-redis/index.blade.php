@extends('layouts.admin')

@section('breadcrumbs')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-8">
                    <div class="row">
                        <div class="col-md-6">
                            <h1>Socket with Node + Redis</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Node + Redis</li>
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
                            <h3 class="card-title">Node + Redis</h3>
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
                                        В корне проекта лежит лежит файл server.js который нужно запустить,
                                        также нужно запустить прослушивание очередей (php artisan queue:listen).
                                        Необходим работающий redis-server
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">

                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Testing (<span id="userId">{{$user->id}}</span>)</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
                            </div>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form method="POST" action="{{ route('admin.socket.node-redis.push') }}">
                                        @csrf
                                        {{--@post--}}

                                        <div class="form-group">
                                            <label>Users </label>
                                            <select class="select2" name="users[]" multiple="multiple" data-placeholder="Выбрать пользователя которому отправить сообщение" style="width: 100%;">
                                                @if($users)
                                                    @foreach($users as $id => $user)
                                                        <option value="{{ $id }}">{{ $user }} (id - {{ $id }})</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="message" class="col-form-label">Message</label>
                                            <input id="text" name="message" class="form-control{{ $errors->has('message') ? ' is-invalid' : '' }}" required>
                                            @if ($errors->has('message'))
                                                <span class="invalid-feedback"><strong>{{ $errors->first('message') }}</strong></span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Push</button>
                                        </div>

                                        {{--<p id="userId">{{$user->id}}</p>--}}
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        // let userId = document.getElementById('userId').innerHTML;
        // let socket = io('http://192.168.126.109:3000');
        // console.log('euu');
        // socket.on(`user.${userId}:App\\Events\\PrivateNodeMessageEvent`, function(data){
        //     console.log(data);
        // });

        // console.log(userId);
        // let ws = new WebSocket(`ws://192.168.126.109:3000`);
        //
        // ws.addEventListener('message', (event) => {
        //     console.log('Message from server: ' + event.data);
        // })
    </script>
@endsection