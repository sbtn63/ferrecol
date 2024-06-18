<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|min:3|max:50',
            'post' => 'required|int'
        ]);

        try {
            $comment = new Comment;
            $comment->content = $request->content;
            $comment->user_id = Auth::user()->id;
            $comment->post_id = $request->post;
            $comment->save();

            return redirect()->route('post.index')
                ->with('success', 'Commentario creado!');
        } catch (\Exception $e) {
            return redirect()->route('post.index')
                ->with('error', 'Error al comentar la Publicacion!'.$e);
        }
    }
}
