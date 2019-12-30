@extends('layouts.admin')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <form method="POST" action="{{ route('admin.user.create') }}">
                @csrf
                {{--@post--}}

                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Form</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{route('admin.socket.check')}}">Check</a>
                            </div>

                            <div class="col-md-6">


                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <script>

        // const conn = new WebSocket('http://192.168.126.109:3000');
        //
        // conn.onopen = function(e) {
        //     console.log(e);
        // };
        //
        // conn.onmessage = function(e) {
        //     console.log('Получены данные: ' + e.data);
        //     };
        //
        // function send(){
        //
        //     let data = 'Данные для отправки: ' + Math.random();
        //     conn.send(data);
        //     console.log('Отправленно: ' + data);
        //     }

        // var socket = io('http://192.168.126.109:3000');
        // console.log('euu');
        // socket.on('real-chart:App\\Events\\ChartRealTimeEvent', function(data){
        //     console.log(data.result);
        //     this.data = data.result;
        // }.bind(this));
    </script>
@endsection