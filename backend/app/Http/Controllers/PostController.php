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
        $posts = Post::orderByDesc('created_at')->get();
        $train_stations = TrainStation::all();
        return view('post.index', compact('posts', 'train_stations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3|max:50',
            'content' => 'required|min:3|max:255',
            'train_station' => 'required|int|exists:train_stations,id'
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

    public function update(Request $request,  int $id)
    {
        $request->validate([
            'title' => 'min:3|max:50',
            'content' => 'min:3|max:255',
            'train_station' => 'required|int|exists:train_stations,id'
        ]);

        try {
            $referer = $request->headers->get('referer');
            $post = Post::where('id', $id)->where('user_id', Auth::user()->id)->first();

            if(!$post)
            {
                return $this->redirectUrl($referer, Auth::user()->id, 'Publicacion no existe!!');
            }

            $post->title = $request->title;
            $post->content = $request->content;

            if (!empty($request->image)) {
                $fileName = time(). '.' . $request->image->extension();
                $request->image->move(public_path('images'), $fileName);
                $post->file_url = $fileName;
            }

            $post->train_station_id = $request->train_station;
            $post->save();

            return $this->redirectUrl($referer, Auth::user()->id, 'Publicacion Actualizada!!');
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
                        ->first(); 

            if(!$post)
            {
                abort(404);
            }
            
            $post->delete();
    
            $referer = $request->headers->get('referer');

            return $this->redirectUrl($referer, Auth::user()->id, 'Publicacion Eliminada!!');

        } catch (\Exception $e) {
            return redirect()->route('post.index')
                ->with('error', 'Error al eliminar la publicacion.');
        }
    }

    private function redirectUrl($referer, $userId, $message)
    {
        if (strpos($referer, route('user.show', ['id' => $userId])) !== false) {
            return redirect()->route('user.show', ['id' => $userId])
                ->with('success', $message);
        } else {
            return redirect()->route('post.index')
                ->with('success', $message);
        }
    }
}
