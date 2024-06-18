<?php

namespace App\Http\Controllers\Api;

use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Comment;
use App\Models\Post;
use Auth;

class CommentController extends Controller
{
    use ApiResponse;
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required|min:3|max:50',
            'post_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return $this->error(422, ["errors"=>$validator->errors()]);
        }

        try {

            $post = Post::find($request->post_id);

            if(!$post){
                return $this->error(404, 'La Publicacion no existe!');
            }

            $comment = new Comment;
            $comment->content = $request->content;
            $comment->user_id = Auth::user()->id;
            $comment->post_id = $request->post_id;
            $comment->save();

            return $this->success(201, 'Comentario Creado!', $comment);
        } catch (\Exception $e) {
            return $this->error(500, 'Internal server error!');
        }
    }

    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required|min:3|max:50'
        ]);

        if ($validator->fails()) {
            return $this->error(422, ["errors"=>$validator->errors()]);
        }

        try {
            $comment = Comment::where('id', $id)->where('user_id', Auth::user()->id)->first(); 
            if(!$comment){
                return $this->error(404, 'El Comentario no existe!');
            }

            $comment->content = $request->content;
            $comment->save();

            return $this->success(201, 'Comentario Actualizado!', $comment);
        } catch (\Exception $e) {
            return $this->error(500, 'Internal server error!');
        }
    }

    public function destroy(int $id)
    {
        try{

            $comment = Comment::where('id', $id)->where('user_id', Auth::user()->id)->first(); 
            if(!$comment){
                return $this->error(404, 'El Comentario no existe!');
            }

            $comment->delete();
            return $this->success(200, 'Comentario eliminado', $comment);

            if(!$post){
                return $this->error(404, 'La Publicacion no existe!');
            }

        } catch (\Exception $e) {
            return $this->error(500, 'Internal server error!');
        }
    }
}
