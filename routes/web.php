<?php

use App\Http\Controllers\FundSourceController;
use App\Http\Controllers\UnitsController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('fund-sources', FundSourceController::class)->names([
    'index' => 'fund-sources.index',
    'create' => 'fund-sources.create',
    'store' => 'fund-sources.store',
    'show' => 'fund-sources.show',
    'edit' => 'fund-sources.edit',
    'update' => 'fund-sources.update',
    'destroy' => 'fund-sources.delete',
]);

Route::resource('units', UnitsController::class)->names([
    'index' => 'units.index',
    'create' => 'units.create',
    'store' => 'units.store',
    'show' => 'units.show',
    'edit' => 'units.edit',
    'update' => 'units.update',
    'destroy' => 'units.delete',
]);
