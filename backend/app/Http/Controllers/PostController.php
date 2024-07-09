<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\TrainStation;
use Illuminate\Support\Str;
use Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderByDesc('created_at')->get();
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

            return redirect()->route('post.index')->with('success', 'Publicacion Creada!!');

        } catch (\Exception $e) {
            return redirect()->route('post.index')->with('error', 'Error al crear la Publicacion!');
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

            $referer = $request->headers->get('referer');

            if (strpos($referer, route('user.show', ['id' => Auth::user()->id])) !== false) {
                return redirect()->route('user.show', ['id' => Auth::user()->id])
                    ->with('success', 'Publicación actualizada!');
            } else {
                return redirect()->route('post.index')
                    ->with('success', 'Publicación actualizada!');
            }
        } catch (\Exception $e) {
            return redirect()->route('post.index')
                ->with('error', 'Error al actualzar la Publicacion!');
        }
    }

    public function destroy(Request $request, int $id)
    {
        try {
            $post = Post::where('id', $id)
                        ->where('user_id', Auth::user()->id)
                        ->firstOrFail(); 
            $post->delete();
    
            $referer = $request->headers->get('referer');

            if (strpos($referer, route('user.show', ['id' => Auth::user()->id])) !== false) {
                return redirect()->route('user.show', ['id' => Auth::user()->id])
                    ->with('success', 'Publicación Eliminada!');
            } else {
                return redirect()->route('post.index')
                    ->with('success', 'Publicación Eliminada!');
            }
        } catch (\Exception $e) {
            return redirect()->route('post.index')
                ->with('error', 'Error al eliminar la publicacion.');
        }
    }
}
