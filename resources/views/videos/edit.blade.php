@extends('layouts.layout')

@push('styles')
    <link rel="stylesheet" href="https://cdn.plyr.io/3.6.2/plyr.css" />
@endpush

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Video</h1>
    </div>
    @include('partials.flash')
    <form action="{{ route("videos.update", $video->id) }}" method="post">
        @csrf
        @method("PATCH")
        <div class="form-group">
            <label for="title">
                Title
            </label>
            <input value="{{ old("title", $video->title)  }}" required id="title" name="title" type="text" class="form-control @error('title') is-invalid @enderror">
            @error('title')
                <span class="invalid-feedback mb-2" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="category">
                Category
            </label>
            <select required name="category_id" id="category" class="form-control @error('category_id') is-invalid @enderror">
                <option value="">None selected</option>
                @foreach ($categories as $category)
                    <option {{ ($category->id == old('category', $video->category_id)) ?'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <span class="invalid-feedback mb-2" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="thumbnail">
                Thumbnail
            </label>
            <div>
                <img src="{{ asset("storage/$video->thumbnail") }}" width="150" height="150" alt="" class="img-thumbnail">
            </div>
            <input id="thumbnail" name="thumbnail" type="file" accept="image" class="form-control-file @error('thumbnail') is-invalid @enderror" accept=".jpeg,.png,.bmp,.gif,.svg,.webp">
            <span class="form-text text-muted">Accepted formats: jpeg, png, bmp, gif, svg, or webp</span>
            @error('thumbnail')
                <span class="invalid-feedback mb-2" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="video">
                Video
            </label>
            <div class="mb-2">
                <video
                    controls
                    crossorigin
                    playsinline
                    data-poster="{{ asset("storage/$video->thumbnail") }}"
                    id="player">
                    <source src="{{ asset("storage/$video->video") }}">
                    Your browser does not support the video tag.
                </video>
            </div>
            <input id="video" name="video" type="file" class="form-control-file @error('video') is-invalid @enderror">
            @error('video')
                <span class="invalid-feedback mb-2" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="descripton">
                Descripton
            </label>
            <textarea required class="form-control @error('description') is-invalid @enderror" name="description" id="description" cols="30" rows="10">
               {!! old("description", $video->description) !!}
            </textarea>
            @error('description')
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

@push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/19.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#description' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>

    <script src="https://cdn.plyr.io/3.6.2/plyr.js"></script>
    <script>
        var player = new Plyr('#player');
    </script>
@endpush
