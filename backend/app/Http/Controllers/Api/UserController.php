<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Resources\PostResource;
use App\Http\Resources\CommentsUserResource;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Traits\ApiResponse;
use Auth;

class UserController extends Controller
{
    use ApiResponse;
    public function show(int $id)
    {
        try{
            $user = User::find($id);

            if(!$user){
                return $this->error(404, 'El usuario no existe');
            }
            $user = new UserResource($user);

            $posts = $user->posts();
            $posts =$posts->with(['user', 'train_station.municipality', 'comments.user'])->orderByDesc('created_at')->get();
            $posts = PostResource::collection($posts);

            $comments = $user->comments();
            $comments = $comments->with(['user', 'post', 'post.train_station.municipality'])->get();
            $comments = CommentsUserResource::collection($comments);

            return $this->success(200, 'Usuario', ["user" => $user, "posts_user" => $posts, "comments_user" => $comments]);

        } catch (\Exception $e) {
            return $this->success(500, 'Internal server error'.$e);
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'email|unique:users|max:255',
            'username' => 'string|unique:users|max:50',
            'password' => 'required|string|min:8',
            'new_password' => 'string|min:8|confirmed'
        ]);

        if ($validator->fails()) {
            return $this->error(422, ["errors"=>$validator->errors()]);
        }

        try{
            $user = Auth::user();
            
            if (Hash::check($request->password, $user->password)) {
                
                $user->fill($request->only(['username', 'email']));

                if($request->filled('new_password')){
                    $user->password = bcrypt($request->new_password);
                }

                $user->save();
                return $this->success(200, '¡Usuario actualizado!', $user);
            }

            return $this->success(404, '¡Password not match!');
    
        } catch (\Exception $e) {
            return $this->error(404, 'Error al actualizar el usuario.');
        }
    }
}
