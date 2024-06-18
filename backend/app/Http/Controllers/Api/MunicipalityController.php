<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Municipality;
use App\Traits\ApiResponse;

class MunicipalityController extends Controller
{
    use ApiResponse;

    public function index()
    {
        try {
            $municipalities = Municipality::all();
            return $this->success(200, 'Municipios', $municipalities);

        } catch (\Exception $e) {
            return $this->error(500, 'Internal server error');
        }
    }
}
