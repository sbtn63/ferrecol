<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\TrainStation;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Traits\ApiResponse;
use Auth;

class PostController extends Controller
{
    use ApiResponse;

    
    public function index()
    {
        try {
            $posts = Post::orderBy('created_at', 'desc')->get();
            foreach ($posts as $post) {
                $post['coutComments'] = $post->comments()->count();
            }
            return $this->success(200, 'Listado de Publicaciones', $posts);
        } catch (\Exception $e) {
            return $this->error(500, 'Internal server error');
        }
    }

    public function full()
    {
        try {
            $posts = Post::with(['user', 'train_station.municipality', 'comments.user'])->orderByDesc('created_at')->get();
            $posts = PostResource::collection($posts);
            return $this->success(200, 'Listado de Publicaciones', $posts);
        } catch (\Exception $e) {
            return $this->error(500, 'Internal server error');
        }
    }

    public function show(int $id)
    {
        try {
            $post = Post::find($id);

            if (!$post) {
                return $this->error(404, 'La Publicacion no existe!');
            }

            return $this->success(200, 'Publicacion', ['post' => $post, 'countComments' => $post->comments()->count()]);
        } catch (\Exception $e) {
            return $this->error(500, 'Internal server error');
        }
    }

    public function show_full(int $id)
    {
        try {
            $post = Post::with(['user', 'train_station.municipality', 'comments.user'])->find($id);

            if (!$post) {
                return $this->error(404, 'La Publicacion no existe!');
            }

            $post = new PostResource($post);
            return $this->success(200, 'Publicacion', $post);
        } catch (\Exception $e) {
            return $this->error(500, 'Internal server error');
        }
    }

    public function show_comments(int $id)
    {
        try {
            $post = Post::find($id);

            if (!$post) {
                return $this->error(404, 'La Publicacion no existe!');
            }

            $comments = $post->comments()->get();
            return $this->success(200, 'Publicacion', ['comments' => $comments, 'countComments' => $comments->count()]);
        } catch (\Exception $e) {
            return $this->error(500, 'Internal server error');
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3|max:50',
            'content' => 'required|min:3|max:255',
            'file_url' => 'nullable|max:255',
            'train_station_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return $this->error(422, ["errors"=>$validator->errors()]);
        }

        try {

            $train_station = TrainStation::find($request->train_station_id);
            if (!$train_station){
                return $this->error(404, 'La Estacion de tren no existe!');
            }

            $post = new Post();
            $post->title = $request->title;
            $post->content = $request->content;
            $post->train_station_id = $request->train_station_id;
            $post->user_id = Auth::user()->id;

            if($request->file_url)
            {
                $post->file_url = $request->file_url;
            }

            $post->save();
            return $this->success(200, 'Publicacion Creada!', $post);

        } catch (\Exception $e) {
            return $this->error(500, 'Internal server error');
        }
    }

    public function update(Request $request,  int $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'min:3|max:50',
            'content' => 'min:3|max:255',
            'file_url' => 'max:255',
            'train_station_id' => 'integer'
        ]);

        if ($validator->fails()) {
            return $this->error(422, ["errors"=>$validator->errors()]);
        }

        try {
            $post = Post::where('id', $id)->where('user_id', Auth::user()->id)->first();

            if(!$post){
                return $this->error(404, 'La Publicacion no existe!');
            }

            if($request->train_station_id){
                $train_station = TrainStation::find($request->train_station_id);
                if (!$train_station){
                    return $this->error(404, 'La Estacion de tren no existe!');
                }
            }

            $post->fill($request->only(['title', 'content', 'file_url','train_station_id']));
            $post->save();

            return $this->success(200, 'Publicacion actualizada', $post);
        } catch (\Exception $e) {
            return $this->error(500, 'Internal server error'.$e);
        }
    }

    public function destroy(int $id)
    {
        try {
            $post = Post::where('id', $id)->where('user_id', Auth::user()->id)->first(); 
            if(!$post){
                return $this->error(404, 'La Publicacion no existe!');
            }

            $post->delete();
            return $this->success(200, 'Publicacion eliminada', $post);
        } catch (\Exception $e) {
            return $this->error(500, 'Internal server error');
        }
    }
}

