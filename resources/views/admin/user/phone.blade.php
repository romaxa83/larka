@extends('layouts.admin')

@section('title')
    <title>{{ $title }}</title>
@endsection

@section('breadcrumbs')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <div class="row">
                        <h1>{{ $title }}</h1>
                    </div>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.users')}}">Users</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.user', ['id' => $user->id])}}">{{ $user->name }}</a></li>
                        <li class="breadcrumb-item">Profile User</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <form method="POST" action="{{ route('admin.user.phone.verify') }}">
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
                                <div class="form-group">
                                    <label for="token" class="col-form-label">SMS code</label>
                                    <input id="text" name="token" class="form-control{{ $errors->has('token') ? ' is-invalid' : '' }}" required>
                                    @if ($errors->has('token'))
                                        <span class="invalid-feedback"><strong>{{ $errors->first('token') }}</strong></span>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Verify</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

@endsection