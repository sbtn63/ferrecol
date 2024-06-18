<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TrainStation;
use App\Traits\ApiResponse;

class TrainStationController extends Controller
{
    use ApiResponse;

    public function index()
    {
        try {
            $trainStations =TrainStation::all();
            return $this->success(200, 'Estaciones de tren', $trainStations);

        } catch (\Exception $e) {
            return $this->error(500, 'Internal server error');
        }
    }
}
