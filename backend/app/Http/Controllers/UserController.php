<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TrainStation;

class UserController extends Controller
{
    public function show(int $id)
    {
        $user = User::find($id);
        $train_stations = TrainStation::all();

        if(!$user){
            abort(404);
        }

        return view('user.show', compact('user', 'train_stations'));
    }
}
