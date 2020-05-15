<?php

namespace App\Http\Controllers;

use App\Category;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = Auth::user()->videos;
        return view("videos.index", compact("videos"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view("videos.create", compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'max:255', 'unique:videos,title'],
            'category_id' => ['required', 'exists:categories,id'],
            'thumbnail' => ['required', "image"],
            'video' => ['required', 'mimetypes:video/avi,video/mpeg,video/quicktime,video/x-matroska,video/mp4'],
            'description' => ['required']
        ]);

        $data['slug'] = Str::slug($data['title']);

        $thumbnail = $request->thumbnail;
        $filename = Str::random(15) . '.' . $thumbnail->extension();
        Storage::putFileAs("public", $thumbnail, $filename);
        $data['thumbnail'] = $filename;

        $video = $request->video;
        $filename = Str::random(15) . '.' . $video->extension();
        Storage::putFileAs("public", $video, $filename);
        $data['video'] = $filename;

        Auth::user()->videos()->create($data);

        $request->session()->flash('message', 'New video added successfully');
        $request->session()->flash('alert-class', 'alert alert-success');
        return redirect()->route('videos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        $categories = Category::all();
        if (Auth::user()->id != $video->user_id) {
            return redirect(route("pages.home"));
        }
        return view("videos.edit", compact("video", 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {
        if (Auth::user()->id != $video->user_id) {
            return redirect(route("pages.home"));
        }

        $data = $request->validate([
            'title' => ['required', 'max:255', 'unique:videos,title,' . $video->id],
            'category_id' => ['required', 'exists:categories,id'],
            'thumbnail' => ['nullable', "image"],
            'video' => ['nullable', 'mimetypes:video/avi,video/mpeg,video/quicktime,video/x-matroska,video/mp4'],
            'description' => ['required']
        ]);

        $data['slug'] = Str::slug($data['title']);

        $thumbnail = $request->thumbnail;
        if ($thumbnail) {
            Storage::delete("public/" . $video->thumbnail);
            $filename = Str::random(15) . '.' . $thumbnail->extension();
            Storage::putFileAs("public", $thumbnail, $filename);
            $data['thumbnail'] = $filename;
        } else {
            $data['thumbnail'] = $video->thumbnail;
        }

        $videoFile = $request->video;
        if ($videoFile) {
            Storage::delete("public/" . $videoFile->video);
            $filename = Str::random(15) . '.' . $videoFile->extension();
            Storage::putFileAs("public", $videoFile, $filename);
            $data['video'] = $filename;
        } else {
            $data['video'] = $video->video;
        }

        $video->update($data);

        $request->session()->flash('message', 'Video updated successfully');
        $request->session()->flash('alert-class', 'alert alert-success');
        return redirect()->route('videos.edit', $video->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Video $video)
    {
        if (Auth::user()->id != $video->user_id) {
            return redirect(route("pages.home"));
        }
        Storage::delete("public/" . $video->thumbnail);
        Storage::delete("public/" . $videoFile->video);
        $video->delete();
        $request->session()->flash('message', 'Video deleted successfully');
        $request->session()->flash('alert-class', 'alert alert-success');
        return redirect()->route('videos.index');
    }
}
