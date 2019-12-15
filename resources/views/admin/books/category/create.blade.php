@extends('layouts.admin')

@section('content')

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Quick Example</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form" method="POST" action="{{ route('admin.books.category.store') }}">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="categoryName">Name</label>
                    <input type="text" name="title" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" id="categoryName" value="{{ old('name') }}" placeholder="Category Name">
                    @if ($errors->has('title'))
                        <span class="invalid-feedback"><strong>{{ $errors->first('title') }}</strong></span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="categoryPosition">Position</label>
                    <input type="number" name="position" class="form-control" id="categoryPosition" min="0" max="1000">
                </div>

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

@endsection