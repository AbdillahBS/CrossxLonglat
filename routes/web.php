<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

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

// Route::get('/', function () {
//     return view('index');
// });

use App\Http\Controllers\SalesController;

Route::get('/', [SalesController::class, 'index']);

use App\Http\Controllers\CrossController;

Route::get('/cross-selling', [CrossController::class, 'crossSelling'])->name('cross-selling');

use App\Http\Controllers\MapsController;

Route::get('/maps', [MapsController::class, 'maps']);
Route::get('/api/get-location-sellers', [MapsController::class, 'getLocationSellers']);
Route::get('/api/get-locations-by-kode', [MapsController::class, 'getLocationsByKode']);




use App\Http\Controllers\ExcelController;

Route::get('/upload-excel-form', function () {
    $tables = DB::getDoctrineSchemaManager()->listTableNames();
    return view('upload', compact('tables'));
});

Route::post('/upload-excel', [ExcelController::class, 'upload'])->name('upload.excel');
Route::post('/get-columns', [ExcelController::class, 'getColumns'])->name('get.columns');
Route::post('/import-excel', [ExcelController::class, 'import'])->name('import.excel');
