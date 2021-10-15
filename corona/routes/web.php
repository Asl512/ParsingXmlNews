<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\CountryController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, "Main"]);
Route::get('main', [MainController::class, "Main"]);
Route::get('contry', [CountryController::class, "Contry"]);
