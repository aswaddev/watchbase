<?php

namespace App\Http\Controllers;

use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function index()
    {
        $latestVideos = Video::orderBy("created_at", "DESC")->take(4)->get();
        $mostPopularVideos = Video::orderBy("views", "DESC")->take(4)->get();
        if (Auth::user()) {
            $myVideos = Auth::user()->videos()->orderBy("created_at", "DESC")->take(4)->get();
            return view('pages.home', compact("latestVideos", "mostPopularVideos", "myVideos"));
        }
        return view('pages.home', compact("latestVideos", "mostPopularVideos"));
    }

    public function videos($filter)
    {
        if ($filter == "latest-videos") {
            $title = "Latest Videos";
            $videos = Video::orderBy("created_at", "DESC")->get();
        } elseif ($filter == "most-popular") {
            $title = "Most Popular";
            $videos = Video::orderBy("views", "DESC")->get();
        } elseif ($filter == "my-uploads") {
            $title = "My Uploads";
            if (Auth::user()) {
                $videos = Auth::user()->videos()->orderBy("created_at", "DESC")->get();
            }
        }
        return view("pages.videos", compact("videos", "title"));
    }

    public function video(Video $video)
    {
        $video->increment("views");
        return view("pages.video", compact("video"));
    }
}
