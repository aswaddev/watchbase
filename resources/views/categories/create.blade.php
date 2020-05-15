@extends('layouts.layout')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Add Category</h1>
    </div>
    <form action="{{ route("categories.store") }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">
                Name
            </label>
            <input value="{{ old("name") }}" required id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror">
            @error('name')
                <span class="invalid-feedback mb-2" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <hr>
        <div class="text-right">
            <button class="btn btn-primary">
                Submit
            </button>
        </div>
    </form>
@endsection
