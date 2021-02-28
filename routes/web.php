<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Report;

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

Route::get('/', function () {
    return view('homepage');
});

Route::get('admin', function () {
    return view('Admin');
});


Route::post('save_report', [Report::class, 'save_report_controller']);

Route::post('get_report', [Report::class, 'get_report_controller']);


