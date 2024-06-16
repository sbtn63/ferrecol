<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\TrainStation;
use Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        $train_stations = TrainStation::all();
        return view('post.index', compact('posts', 'train_stations'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|min:3|max:50',
            'content' => 'required|min:3|max:255',
            'train_station' => 'required|int'
        ]);

        $post = new Post;
        $post->title = $request->title;
        $post->content = $request->content;

        if(!empty($request->image)){
            $fileName = time(). '.' . $request->image->extension();
            $request->image->move(public_path('images'), $fileName);
            $post->file_url = $fileName;
        }

        $post->user_id = Auth::user()->id;
        $post->train_station_id = $request->train_station;
        $post->save();

        return redirect()->route('post.index');
    }
}
