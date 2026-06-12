<?php

use App\Http\Controllers\CensusRecordController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('dashboard');

    // Map POST '/' to store method so current frontend AJAX works seamlessly
    Route::post('/', [CensusRecordController::class, 'store']);

    // API CRUD Routes for census records
    Route::get('census/check-house', [CensusRecordController::class, 'checkHouse']);
    Route::apiResource('census', CensusRecordController::class);
    Route::post('census/{id}/restore', [CensusRecordController::class, 'restore'])->name('census.restore');
    Route::delete('census/{id}/force', [CensusRecordController::class, 'forceDelete'])->name('census.force-delete');

    // Download Data Page and Exports
    Route::get('/download-data', [CensusRecordController::class, 'downloadPage'])->name('census.download.page');
    Route::get('/download-data/excel', [CensusRecordController::class, 'exportExcel'])->name('census.download.excel');
    Route::get('/download-data/pdf', [CensusRecordController::class, 'exportPdf'])->name('census.download.pdf');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('refresh-csrf', function () {
    request()->session()->regenerateToken();
    return response()->json(['token' => csrf_token()]);
});

Route::get('session-keep-alive', function () {
    return response()->json(['token' => csrf_token()]);
});

require __DIR__.'/auth.php';
