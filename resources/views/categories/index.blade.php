@extends('layouts.layout')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">All Categories</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route("categories.create") }}" class="btn btn-sm btn-outline-success">Add New</a>
        </div>
    </div>
    @include('partials.flash')
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Created At</th>
                <th scope="col">Last Modified</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $key => $category)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->created_at }}</td>
                    <td>{{ $category->updated_at }}</td>
                    <td>
                        <a href="{{ route("categories.edit", $category->id) }}" class="btn btn-dark">
                            Edit
                        </a>
                        <form action="{{route('categories.destroy', $category->id) }}" class="d-inline-block"  method="POST">
                            @csrf
                            @method('Delete')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('If you delete this category then all videos related to this category will also get deleted, are you sure you want to proceed?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">
                        <div class="alert alert-info">No categories found</div>
                        <a href="{{ route("categories.create") }}" class="btn btn-primary">Add New</a>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
