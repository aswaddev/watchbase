@extends('layouts.layout')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Latest Videos</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route("pages.videos", "latest-videos") }}" class="btn btn-sm btn-outline-success">View All</a>
        </div>
    </div>
    <div class="row mb-2">
        @forelse ($latestVideos as $video)
            <a href="{{ route("pages.video", $video->slug) }}" class="video-card col-md-3">
                <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col-md-12 overflow-hidden" style="height: 200px;">
                        <img src="{{ asset("storage/$video->thumbnail") }}" class="bd-placeholder-img" alt="{{ $video->title }}">
                    </div>
                    <div class="col-md-12 p-4 d-flex flex-column">
                        <strong class="d-inline-block mb-2 text-success">{{ $video->category->name }}</strong>
                        <h5 class="mb-0">{{ getExcerpt($video->title, 40) }}</h5>
                        <div class="d-flex mb-1 justify-content-between flex-wrap flex-md-nowrap align-items-center">
                            <div class="text-muted">{{ $video->views }} views - {{ getElapsedTime($video->created_at) }}</div>
                            <div class="text-muted">By {{ $video->user->name }}</div>
                        </div>
                    </div>
                </div>
            </a>
        @empty
            <h5 class="h5 text-center col-md-12">No videos found</h5>
        @endforelse
    </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Most Popular</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route("pages.videos", "most-popular") }}" class="btn btn-sm btn-outline-success">View All</a>
        </div>
    </div>
    <div class="row mb-2">
        @forelse ($mostPopularVideos as $video)
            <a href="{{ route("pages.video", $video->slug) }}" class="video-card col-md-3">
                <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col-md-12 overflow-hidden" style="height: 200px;">
                        <img src="{{ asset("storage/$video->thumbnail") }}" class="bd-placeholder-img" alt="{{ $video->title }}">
                    </div>
                    <div class="col-md-12 p-4 d-flex flex-column">
                        <strong class="d-inline-block mb-2 text-success">{{ $video->category->name }}</strong>
                        <h5 class="mb-0">{{ getExcerpt($video->title, 40) }}</h5>
                        <div class="d-flex mb-1 justify-content-between flex-wrap flex-md-nowrap align-items-center">
                            <div class="text-muted">
                                {{ $video->views }} views - {{ getElapsedTime($video->created_at) }}</>
                            </div>
                            <div class="text-muted">By {{ $video->user->name }}</div>
                        </div>
                    </div>
                </div>
            </a>
        @empty
            <h5 class="h5 text-center col-md-12">No videos found</h5>
        @endforelse
    </div>
    @auth
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Your Uploads</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <a href="{{ route("pages.videos", "my-uploads") }}" class="btn btn-sm btn-outline-success">View All</a>
            </div>
        </div>
        <div class="row mb-2">
            @forelse ($myVideos as $video)
                <a href="{{ route("pages.video", $video->slug) }}" class="video-card col-md-3">
                    <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="col-md-12 overflow-hidden" style="height: 200px;">
                            <img src="{{ asset("storage/$video->thumbnail") }}" class="bd-placeholder-img" alt="{{ $video->title }}">
                        </div>
                        <div class="col-md-12 p-4 d-flex flex-column">
                            <strong class="d-inline-block mb-2 text-success">{{ $video->category->name }}</strong>
                            <h5 class="mb-0">{{ getExcerpt($video->title, 40) }}</h5>
                            <div class="d-flex mb-1 justify-content-between flex-wrap flex-md-nowrap align-items-center">
                                <div class="text-muted">{{ $video->views }} views - {{ getElapsedTime($video->created_at) }}</div>
                                <div class="text-muted">By {{ $video->user->name }}</div>
                            </div>
                        </div>
                    </div>
                </a>
            @empty
                <h5 class="h5 text-center col-md-12">Your account currently has no videos</h5>
            @endforelse
        </div>
    @endauth
@endsection
