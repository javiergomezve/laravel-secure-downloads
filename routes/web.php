<?php

use App\Http\Controllers\DownloadController;
use Illuminate\Support\Facades\Route;

Route::get('/downloads', [DownloadController::class, 'index']);
Route::get('/downloads/{id}/generate-secure-url', [DownloadController::class, 'generateSecureUrl'])
    ->name('generate-secure-url');
Route::get('/downloads/download', [DownloadController::class, 'download'])->name('download-contract');
