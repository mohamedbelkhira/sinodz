<?php

use App\Http\Controllers\Api\CarApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/cars', [CarApiController::class, 'index']);
