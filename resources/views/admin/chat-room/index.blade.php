@extends('layouts.admin')

@section('breadcrumbs')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-8">
                    <div class="row">
                        <div class="col-md-6">
                            <h1>Private rooms</h1>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('admin.chat-room.create') }}" class="btn btn-block btn-outline-success">
                                Create
                            </a>
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
                @if($rooms->isNotEmpty())
                    @foreach($rooms as $room)
                        <div class="col-md-6">
                            <div class="card card-default">
                                <div class="card-header">
                                    <h3 class="card-title">{{ $room->name }}</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            @if($room->users->isNotEmpty())
                                                @foreach($room->users as $user)
                                                    <p>{{ $user->email }}</p>
                                                @endforeach
                                            @endif
                                        </div>

                                        <div class="col-md-6">


                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-danger">Delete room</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>Not found private room</p>
                @endif
            </div>
        </div>
    </section>
@endsection