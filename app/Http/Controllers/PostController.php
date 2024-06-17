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

        try {
            $post = new Post;
            $post->title = $request->title;
            $post->content = $request->content;

            if (!empty($request->image)) {
                $fileName = time(). '.' . $request->image->extension();
                $request->image->move(public_path('images'), $fileName);
                $post->file_url = $fileName;
            }

            $post->user_id = Auth::user()->id;
            $post->train_station_id = $request->train_station;
            $post->save();

            return redirect()->route('post.index')
                ->with('success', 'Publicacion creada!');
        } catch (\Exception $e) {
            return redirect()->route('post.index')
                ->with('error', 'Error al crear la Publicacion!');
        }
    }

    public function edit(int $id)
    {
        $post = Post::where('id', $id)->where('user_id', Auth::user()->id)->first();

        if(!$post)
        {
            abort(404);
        }

        $train_stations = TrainStation::all();
        return view('post.edit', compact('post', 'train_stations'));
    }

    public function update(Request $request,  int $id)
    {
        $request->validate([
            'title' => 'min:3|max:50',
            'content' => 'min:3|max:255',
            'train_station' => 'int'
        ]);

        try {
            $post = Post::where('id', $id)->where('user_id', Auth::user()->id)->first();
            $post->title = $request->title;
            $post->content = $request->content;

            if (!empty($request->image)) {
                $fileName = time(). '.' . $request->image->extension();
                $request->image->move(public_path('images'), $fileName);
                $post->file_url = $fileName;
            }

            $post->train_station_id = $request->train_station;
            $post->save();

            return redirect()->route('post.index')
                ->with('success', 'Publicacion actualizada!');
        } catch (\Exception $e) {
            return redirect()->route('post.index')
                ->with('error', 'Error al actualzar la Publicacion!');
        }
    }

    public function destroy(int $id)
    {
        try {
            $post = Post::where('id', $id)
                        ->where('user_id', Auth::user()->id)
                        ->firstOrFail(); 
            $post->delete();
    
            return redirect()->route('post.index')
                ->with('success', 'Publicacion eliminada exitosamente!');
        } catch (\Exception $e) {
            return redirect()->route('post.index')
                ->with('error', 'Error al eliminar la publicacion.');
        }
    }
}
