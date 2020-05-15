@extends('layouts.layout')

@push('styles')
    <link rel="stylesheet" href="https://cdn.plyr.io/3.6.2/plyr.css" />
@endpush

@section('content')
    <div class="row mt-4">
        <div id="sidebarMenu" class="col-md-8 col-lg-8 d-md-block bg-white">
            <video
                controls
                crossorigin
                playsinline
                data-poster="{{ asset("storage/$video->thumbnail") }}"
                id="player">
                <source src="{{ asset("storage/$video->video") }}">
                Your browser does not support the video tag.
            </video>
            <h1 class="mt-3">{{ $video->title }}</h1>
            <div class="text-muted">{{ $video->views }} views - {{ getElapsedTime($video->created_at) }}</div>
            <hr>
            <div class="text-muted">By {{ $video->user->name }}</div>
            <p>
                {!! $video->description !!}
            </p>
        </div>

        <div class="col-md-4 ml-sm-auto col-lg-4 px-md-4">
            <h5 class="h5">Related Videos</h5>
            <hr>
                @forelse ($video->category->videos()->where('id', '!=', $video->id)->get() as $video)
                <a href="{{ route("pages.video", $video->slug) }}" class="video-card col-md-3">
                    <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="col-md-12 overflow-hidden" style="height: 200px;">
                            <img src="{{ asset("storage/$video->thumbnail") }}" class="bd-placeholder-img" alt="{{ $video->title }}">
                        </div>
                        <div class="col-md-12 p-4 d-flex flex-column">
                            <strong class="d-inline-block mb-2 text-success">{{ $video->category->name }}</strong>
                            <h4 class="mb-0">{{ getExcerpt($video->title, 40) }}</h4>
                            <div class="d-flex mb-1 justify-content-between flex-wrap flex-md-nowrap align-items-center">
                                <div class="text-muted">{{ $video->views }} views - {{ getElapsedTime($video->created_at) }}</div>
                                <div class="text-muted">By {{ $video->user->name }}</div>
                            </div>
                        </div>
                    </div>
                </a>
            @empty
                <h5 class="h5 text-center col-md-12">No related videos found</h5>
            @endforelse
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.plyr.io/3.6.2/plyr.js"></script>
    <script>
        var player = new Plyr('#player');
    </script>
@endpush
