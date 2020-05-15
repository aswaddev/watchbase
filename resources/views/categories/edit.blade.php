@extends('layouts.layout')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Category</h1>
    </div>
    @include('partials.flash')
    <form action="{{ route("categories.update", $category->id) }}" method="post">
        @csrf
        @method("PATCH")
        <div class="form-group">
            <label for="name">
                Name
            </label>
            <input value="{{ old("name", $category->name) }}" required id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror">
            @error('name')
                <span class="invalid-feedback mb-2" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <hr>
        <div class="text-right">
            <button class="btn btn-primary">
                Save Changes
            </button>
        </div>
    </form>
@endsection
