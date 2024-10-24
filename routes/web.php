<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QrCodeController;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/qrcode', [QrCodeController::class, 'index'])->name('qrcode.index');
Route::post('/qrcode/generate', [QrCodeController::class, 'generate'])->name('qrcode.generate');
Route::get('/qrcode/download-csv', [QrCodeController::class, 'downloadCsv'])->name('qrcode.downloadCsv');
Route::delete('/qrcode/delete', [QrCodeController::class, 'delete'])->name('qrcode.delete');
