<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PeminjamanController;
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

Route::get('/', [HomeController::class, "index"]);
Route::get('semua-buku', [HomeController::class, "semua"]);
Route::get('buku-tersedia', [HomeController::class, "tersedia"]);
Route::get('buku-dipinjam', [HomeController::class, "dipinjam"]);

Route::get("manajemen-buku/datatable", [BukuController::class, "datatable"]);

// Route::get("manajemen-buku", [BukuController::class, "index"]);
// Route::get("manajemen-buku/create", [BukuController::class, "create"]);
// Route::post("manajemen-buku", [BukuController::class, "store"]);
// Route::get("manajemen-buku/{id}", [BukuController::class, "show"]);
// Route::get("manajemen-buku/{id}/edit", [BukuController::class, "edit"]);
// Route::put("manajemen-buku/{id}", [BukuController::class, "update"]);
// Route::delete("manajemen-buku/{id}", [BukuController::class, "destroy"]);
Route::resource("manajemen-buku", BukuController::class);

Route::get('pinjam-buku/{id}', [PeminjamanController::class, "pinjamBuku"]);
Route::get('kembalikan-buku/{id}', [PeminjamanController::class, "kembalikanBuku"]);