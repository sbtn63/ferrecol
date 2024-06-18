<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Departament;
use App\Traits\ApiResponse;

class DepartamentController extends Controller
{
    use ApiResponse;

    public function index()
    {
        try {
            $departaments = Departament::all();
            return $this->success(200, 'Departamanetos', $departaments);

        } catch (\Exception $e) {
            return $this->error(500, 'Internal server error');
        }
    }
}
