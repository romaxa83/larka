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
                        <li class="breadcrumb-item active">{{ $user->name }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')

    <section class="content">
        <div class="container-fluid">
            <!-- /.row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">Profile</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                class="fas fa-minus"></i></button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                                class="fas fa-remove"></i></button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        @if($user->phone)
                                            {{ $user->phone }}
                                            @if(!$user->isPhoneVerified())
                                                <i>(is not verified)</i><br/>
                                                <form method="POST" action="{{ route('admin.user.phone') }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-success">Verify</button>
                                                </form>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form method="POST" action="{{ route('admin.user.upload') }}"  enctype="multipart/form-data">
                            @csrf
                            {{--@post--}}

                            <div class="card card-default">
                                <div class="card-header">
                                    <h3 class="card-title">Upload Image</h3>

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
                                                <label for="exampleInputFile">File input</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                        <input type="file" name="image" class="custom-file-input{{ $errors->has('name') ? ' is-invalid' : '' }}" id="exampleInputFile">
                                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                        @if ($errors->has('image'))
                                                            <span class="invalid-feedback"><strong>{{ $errors->first('image') }}</strong></span>
                                                        @endif
                                                    </div>
                                                    <div class="input-group-append">
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <img class="img-thumbnail" src="{{ $user->avatar }}" alt="user-img">
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>

            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

@endsection