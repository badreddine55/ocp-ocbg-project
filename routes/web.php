<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\Analytics;
use App\Http\Controllers\authentications\Login;
use App\Http\Controllers\ControllerPDF;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\GestionOCBGController; // Update controller reference
use App\Http\Controllers\FillterDate;


// Main Page Route
Route::get('/', [Analytics::class, 'index'])->name('dashboard-analytics');

// Table routes
Route::get('/table/all', [GestionOCBGController::class, 'index'])->name('table-all');
Route::get('/table/Athlétisme', [GestionOCBGController::class, 'filter_Athlétisme'])->name('table-Athlétisme');
Route::get('/table/karaté', [GestionOCBGController::class, 'filter_karaté'])->name('table-karaté');
Route::get('/table/Gymnastique', [GestionOCBGController::class, 'filter_Gymnastique'])->name('table-Gymnastique');
Route::get('/table/Natation', [GestionOCBGController::class, 'filter_Natation'])->name('table-Natation');
Route::get('/table/Halteroptrit', [GestionOCBGController::class, 'filter_Halteroptrit'])->name('table-Halteroptrit');
Route::get('/table/Cyclisme', [GestionOCBGController::class, 'filter_Cyclisme'])->name('table-Cyclisme');
Route::get('/table/Petanque', [GestionOCBGController::class, 'filter_Petanque'])->name('table-Petanque');
Route::get('/table/Tennis', [GestionOCBGController::class, 'filter_Tennis'])->name('table-Tennis');
Route::get('/table/Tirauvol', [GestionOCBGController::class, 'filter_Tirauvol'])->name('table-Tirauvol');
// CRUD routes
Route::get('/edit/{id}', [GestionOCBGController::class, 'edit'])->name('edit-op');
Route::put('/update/{id}', [GestionOCBGController::class, 'update'])->name('update-ocbg');
Route::post('/add', [GestionOCBGController::class, 'store'])->name('add-ocbg');
Route::get('créer/nouvelle', [GestionOCBGController::class, 'create'])->name('créer/nouvelle'); // Corrected route name
Route::post('créer/nouvelle', [GestionOCBGController::class, 'store'])->name('créer.store'); // Corrected route name
Route::delete('/op/{id}', [GestionOCBGController::class, 'destroy'])->name('destroy-op');

// Search route
Route::get('/search', [GestionOCBGController::class, 'search'])->name('search');

// Excel routes
Route::get('/excel', [ExcelController::class, 'excel'])->name('excel');
Route::post('/import', [ExcelController::class, 'import'])->name('import');
Route::get('/export/{id}', [ExcelController::class, 'export'])->name('export');
Route::post('/export/{id}', [ExcelController::class, 'export'])->name('export'); // It seems redundant to have both GET and POST for export
Route::get('/exportall', [ExcelController::class, 'exportall'])->name('exportall');
Route::get('/filter-ops', [FillterDate::class, 'filterOps'])->name('filter-ops');
Route::get('/filter-by-year', [FillterDate::class, 'filterOps'])->name('filter-by-year');

// PDF route
Route::get('/download-op-pdf/{id}', [ControllerPDF::class, 'downloadOpPdf'])->name('download-op-pdf');

// Add your other routes here

// Filter route for OCBG
Route::get('/filter-ocbg', [FillterDate::class, 'filterOCBG'])->name('filter-ocbg');

