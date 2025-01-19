<?php

use App\Http\Controllers\api\RoomController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/rooms', [RoomController::class, 'index']);
Route::get('/rooms/{id}', [RoomController::class, 'show']);
Route::post('/rooms/store', [RoomController::class, 'store']);
Route::post('/rooms/edit', [RoomController::class, 'edit']);