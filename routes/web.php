<?php

use App\Http\Controllers\CensusRecordController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Map POST '/' to store method so current frontend AJAX works seamlessly
Route::post('/', [CensusRecordController::class, 'store']);

// API CRUD Routes for census records
Route::get('census/check-house', [CensusRecordController::class, 'checkHouse']);
Route::apiResource('census', CensusRecordController::class);
Route::post('census/{id}/restore', [CensusRecordController::class, 'restore'])->name('census.restore');
Route::delete('census/{id}/force', [CensusRecordController::class, 'forceDelete'])->name('census.force-delete');

Route::get('refresh-csrf', function () {
    request()->session()->regenerateToken();
    return response()->json(['token' => csrf_token()]);
});

// Download Data Page and Exports
Route::get('/download-data', [CensusRecordController::class, 'downloadPage'])->name('census.download.page');
Route::get('/download-data/excel', [CensusRecordController::class, 'exportExcel'])->name('census.download.excel');
Route::get('/download-data/pdf', [CensusRecordController::class, 'exportPdf'])->name('census.download.pdf');


