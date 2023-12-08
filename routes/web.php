<?php

use App\Events\ServerCreated;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\DokterOrderController;

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

Route::get('/orderlist', [DokterOrderController::class, 'index'])->name('listDokterOrder');
Route::get('/dokterorder', [DokterOrderController::class, 'add'])->name('addDokterOrder');
Route::post('/dokterorder/save', [DokterOrderController::class, 'save'])->name('saveDokterOrder');
Route::patch('sedangdiproses/{id}', [DokterOrderController::class, 'sedangdiproses'])->name('sedangdiproses');
Route::patch('menunggupengantaran/{id}', [DokterOrderController::class, 'menunggupengantaran'])->name('menunggupengantaran');
Route::patch('sedangdiantar/{id}', [DokterOrderController::class, 'sedangdiantar'])->name('sedangdiantar');
Route::patch('selesai/{id}', [DokterOrderController::class, 'selesai'])->name('selesai');

Route::get('/tracking', [DokterOrderController::class, 'tracking'])->name('trackingOrder');

Route::get('/master', [MasterController::class, 'index'])->name('indexMaster');
Route::post('/master/add', [MasterController::class, 'add']);
Route::patch('/master/edit/{id}', [MasterController::class, 'update'])->name('editMaster');
Route::get('/master/delete/{id}', [MasterController::class, 'delete'])->name('deleteMaster');

Route::get('/monitoring', [DokterOrderController::class, 'monitoring'])->name('monitoringMaster');

Route::get('/dokter', [DokterController::class, 'index'])->name('indexDokter');
Route::post('/dokter/add', [DokterController::class, 'add']);
Route::patch('/dokter/edit/{id}', [DokterController::class, 'edit'])->name('editDokter');
Route::get('/dokter/delete/{id}', [DokterController::class, 'delete'])->name('deleteDokter');
