@extends('layouts.layout')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Your Videos</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route("videos.create") }}" class="btn btn-sm btn-outline-success">Add New</a>
        </div>
    </div>
    @include('partials.flash')
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Thumbnail</th>
                <th scope="col">Title</th>
                <th scope="col">Category</th>
                <th scope="col">Views</th>
                <th scope="col">Created At</th>
                <th scope="col">Last Modified</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse (Auth::user()->videos as $key => $video)
            <tr>
                <th scope="row">{{ $key + 1 }}</th>
                <td>
                    <img src="{{ asset("storage/$video->thumbnail") }}" alt="" class="img-thumbnail" width="150px" height="150px">
                </td>
                <td>{{ $video->title }}</td>
                <td>{{ $video->category->name }}</td>
                <td>{{ $video->views }}</td>
                <td>{{ $video->created_at }}</td>
                <td>{{ $video->updated_at }}</td>
                <td>
                    <a href="{{ route("videos.edit", $video->id) }}" class="btn btn-dark">
                        Edit
                    </a>
                    <form action="{{route('videos.destroy', $video->id) }}" class="d-inline-block" method="POST">
                        @csrf
                        @method('Delete')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this video??')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8">
                    <div class="text-center">
                        <div class="alert alert-info">Your account currently has no videos
                        </div>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
@endsection
