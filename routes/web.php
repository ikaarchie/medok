<?php

use App\Events\ServerCreated;
use App\Http\Controllers\DokterOrderController;
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

// Route::get('/tes', function () {
//     ServerCreated::dispatch('parameter atribut message');

//     echo 'tes tes tes';
// });

Route::get('/dokterorder', [DokterOrderController::class, 'create']);
Route::post('/dokterorder/save', [DokterOrderController::class, 'store'])->name('saveDokterOrder');
Route::get('/dokterorder/order_list', [DokterOrderController::class, 'index'])->name('listDokterOrder');
Route::get('sedangdiproses/{id}', [DokterOrderController::class, 'sedangdiproses'])->name('sedangdiproses');
Route::get('menunggupengantaran/{id}', [DokterOrderController::class, 'menunggupengantaran'])->name('menunggupengantaran');
Route::get('sedangdiantar/{id}', [DokterOrderController::class, 'sedangdiantar'])->name('sedangdiantar');
Route::get('selesai/{id}', [DokterOrderController::class, 'selesai'])->name('selesai');