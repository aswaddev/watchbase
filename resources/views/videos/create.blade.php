@extends('layouts.layout')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Add Video</h1>
    </div>
    <form action="{{ route("videos.store") }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">
                Title
            </label>
            <input value="{{ old("title") }}" required id="title" name="title" type="text" class="form-control @error('title') is-invalid @enderror">
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
                    <option {{ ($category->id == old('category'))?'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
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
            <input required  id="thumbnail" name="thumbnail" type="file" accept="image" class="form-control-file @error('thumbnail') is-invalid @enderror" accept=".jpeg,.png,.bmp,.gif,.svg,.webp">
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
            <input required  id="video" name="video" type="file" class="form-control-file @error('video') is-invalid @enderror">
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
            <textarea required  class="form-control @error('description') is-invalid @enderror" name="description" id="description" cols="30" rows="10">
               {!! old("description") !!}
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
                Submit
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
@endpush
