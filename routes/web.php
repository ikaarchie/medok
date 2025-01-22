<?php

use App\Events\ServerCreated;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\DokterOkController;
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

// DOKTER
Route::get('/dokterorder', [DokterOrderController::class, 'add'])->name('addDokterOrder');
Route::post('/dokterorder/save', [DokterOrderController::class, 'save'])->name('saveDokterOrder');
Route::get('/tracking', [DokterOrderController::class, 'tracking'])->name('trackingOrder');
// Route::get('/tracking_cara2', [DokterOrderController::class, 'tracking_cara2'])->name('tracking_cara2');
Route::get('/selesai_dokter/{id}', [DokterOrderController::class, 'selesai_dokter'])->name('selesai_dokter');
Route::post('/check-nama', [DokterOrderController::class, 'checkNama'])->name('check_nama');
Route::post('/dokterorder/saveKuesioner', [DokterOrderController::class, 'saveKuesioner'])->name('saveKuesioner');

// JURU MASAK
Route::get('/orderlist', [DokterOrderController::class, 'index'])->name('listDokterOrder');
Route::get('/sedangdiproses/{id}', [DokterOrderController::class, 'sedangdiproses'])->name('sedangdiproses');
Route::get('/menunggupengantaran/{id}', [DokterOrderController::class, 'menunggupengantaran'])->name('menunggupengantaran');
Route::get('/sedangdiantar/{id}', [DokterOrderController::class, 'sedangdiantar'])->name('sedangdiantar');
Route::get('/selesai/{id}', [DokterOrderController::class, 'selesai'])->name('selesai');

// ADMIN DAPUR
Route::get('/master', [MasterController::class, 'index'])->name('indexMaster');
Route::post('/master/add', [MasterController::class, 'add']);
Route::patch('/master/edit/{id}', [MasterController::class, 'update'])->name('editMaster');
Route::get('/master/delete/{id}', [MasterController::class, 'delete'])->name('deleteMaster');
Route::get('/print/{id}', [DokterOrderController::class, 'print'])->name('print');
Route::get('/monitoring', [DokterOrderController::class, 'monitoring'])->name('monitoringMaster');
Route::get('/tarikdata', [DokterOrderController::class, 'tarikdata'])->name('tarikData');
// Route::get('/selesai_admin/{id}', [DokterOrderController::class, 'selesai_admin'])->name('selesai_admin');
Route::get('/dokter', [DokterController::class, 'index'])->name('indexDokter');
Route::post('/dokter/add', [DokterController::class, 'add']);
Route::patch('/dokter/edit/{id}', [DokterController::class, 'edit'])->name('editDokter');
Route::get('/dokter/delete/{id}', [DokterController::class, 'delete'])->name('deleteDokter');

// PANTRY
Route::get('/pantry', [DokterOrderController::class, 'pantry'])->name('monitoringPantry');

//OK
Route::get('/ok', [DokterOrderController::class, 'ok'])->name('monitoringOK');
Route::get('/dokter_ok', [DokterOkController::class, 'index'])->name('dokterOK');
Route::post('/dokter_ok/add', [DokterOkController::class, 'add']);
Route::patch('/dokter_ok/edit/{id}', [DokterOkController::class, 'edit'])->name('editDokterOk');
Route::get('/dokter_ok/delete/{id}', [DokterOkController::class, 'delete'])->name('deleteDokterOk');
