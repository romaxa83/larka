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
                        <div class="col-md-2">
                            <h1>{{ $title }}</h1>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('admin.user.create') }}" class="btn btn-block btn-outline-success">
                                Create
                            </a>
                            <a href="{{ route('admin.user.export') }}" class="btn btn-block btn-outline-success">
                                Export
                            </a>
                            <a href="{{ route('admin.user.export-view') }}" class="btn btn-block btn-outline-success">
                                ExportView
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('admin.user.export-format', 'Html') }}" class="btn btn-block btn-outline-success">
                                Export Html
                            </a>
                            <a href="{{ route('admin.user.export-format', 'Dompdf') }}" class="btn btn-block btn-outline-success">
                                Export PDF
                            </a>
                            <a href="{{ route('admin.user.export-format', 'Csv') }}" class="btn btn-block btn-outline-success">
                                Export CSV
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('admin.user.export-store') }}" class="btn btn-block btn-outline-success">
                                Export Store
                            </a>
                            <a href="{{ route('admin.user.export-heading') }}" class="btn btn-block btn-outline-success">
                                Export Heading
                            </a>
                            <a href="{{ route('admin.user.export-mapping') }}" class="btn btn-block btn-outline-success">
                                Export Mapping
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Users</li>
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
                <div class="col-md-4">
                    <form action="{{ route('admin.user.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="import">
                        <input type="submit" class="btn btn-block btn-outline-info" value="Import File">
                    </form>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Users</h3>
                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        @if($users->isNotEmpty())
                            <div class="card-body table-responsive p-0" style="height: 300px;">
                                @include('admin.user.user-table', $users)
                            </div>
                    @endif
                    <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

@endsection