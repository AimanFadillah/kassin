<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\KasController;
use App\Http\Controllers\KeluarController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware("auth")->group(function () {
    Route::get("/logout",[LoginController::class,"logout"]);
    
    Route::get("/anggota",[AnggotaController::class,"index"]);
    Route::post("/anggota",[AnggotaController::class,"store"]);
    Route::put("/anggota/{Anggota:id}/",[AnggotaController::class,"update"]);
    Route::delete("/anggota/{Anggota:id}/",[AnggotaController::class,"destroy"]);
    
    Route::get("/",[KasController::class,"dashbord"]);
    Route::get("/kas-masuk",[KasController::class,"index"]);
    Route::post("/kas-masuk",[KasController::class,"store"]);
    Route::put("/kas-masuk/{Kas:id}/",[KasController::class,"update"]);
    Route::delete("/kas-masuk/{Kas:id}/",[KasController::class,"destroy"]);

    Route::get("/kas-keluar",[KeluarController::class,"index"]);
    Route::post("/kas-keluar",[KeluarController::class,"store"]);
    Route::put("/kas-keluar/{Kas:id}/",[KeluarController::class,"update"]);
    Route::delete("/kas-keluar/{Kas:id}",[KeluarController::class,"destroy"]);
});

Route::middleware("guest")->group(function () {
    Route::get('/login',[LoginController::class,"index"])->name("login");
    Route::get('/google',[LoginController::class,"google"]);
    Route::get("/google/callback",[LoginController::class,"store"]);  
});
