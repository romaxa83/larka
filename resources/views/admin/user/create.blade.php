@extends('layouts.admin')

@section('title')
    <title>Create User</title>
@endsection

@section('breadcrumbs')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <div class="row">
                        <h1>User Create</h1>
                    </div>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.users')}}">Users</a></li>
                        <li class="breadcrumb-item active">Create User</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
@endsection

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
                                <div class="form-group">
                                    <label for="name" class="col-form-label">Username</label>
                                    <input id="name" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" required>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback"><strong>{{ $errors->first('name') }}</strong></span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="email" class="col-form-label">Email</label>
                                    <input id="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" required>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback"><strong>{{ $errors->first('email') }}</strong></span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="password" class="col-form-label">Password</label>
                                    <input id="text" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback"><strong>{{ $errors->first('password') }}</strong></span>
                                    @endif
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Role</label>
                                    <select class="select2" name="roles[]" multiple="multiple" data-placeholder="Select a role" style="width: 100%;">
                                        @foreach($roles as $id => $role)
                                            <option value="{{ $id }}">{{ $role }}</option>
                                        @endforeach
                                    </select>
                                </div>

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

@endsection