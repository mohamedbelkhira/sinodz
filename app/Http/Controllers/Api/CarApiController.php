<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CarModel;
use Illuminate\Http\Request;

class CarApiController extends Controller
{
    public function index()
    {
        $cars = CarModel::where('isAvailable', true)->with('features')->get();
        return response()->json($cars);
    }
}
