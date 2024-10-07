<?php

use App\Http\Controllers\Admin\UnitBudgetCeilingController;
use App\Http\Controllers\BudgetCeilingController;
use App\Http\Controllers\BudgetYearController;
use App\Http\Controllers\CampusController;
use App\Http\Controllers\FundSourceController;
use App\Http\Controllers\MajorFinalOutputController;
use App\Http\Controllers\ProgramActivityProjectsController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\User\HomeController as UserHomeController;
use Illuminate\Support\Facades\Auth;
use App\Models\FundSource;
use App\Models\ProgramActivityProject;
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
    return redirect('login');
});

Auth::routes();

Route::get('/home', [UserHomeController::class, 'index'])->name('home');
Route::get('proposals', function(){
    return 'Proposals';
})->name('proposals');
Route::get('ppmp', function(){
    return 'PPMP';
})->name('ppmp');
Route::get('pr', function(){
    return 'PR';
})->name('pr');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:super-admin|budget-officer-iii|budget-officer-ii|president']], function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.home');

    Route::resource('fund-sources', FundSourceController::class)->names([
        'index'     =>  'fund-sources.index',
        'create'    =>  'fund-sources.create',
        'store'     =>  'fund-sources.store',
        'show'      =>  'fund-sources.show',
        'edit'      =>  'fund-sources.edit',
        'update'    =>  'fund-sources.update',
        'destroy'   =>  'fund-sources.delete',
    ]);
    
    Route::resource('units', UnitController::class)->names([
        'index'     =>  'units.index',
        'create'    =>  'units.create',
        'store'     =>  'units.store',
        'show'      =>  'units.show',
        'edit'      =>  'units.edit',
        'update'    =>  'units.update',
        'destroy'   =>  'units.delete',
    ]);
    
    Route::put('/units/{id}/assign-mfo', [UnitController::class, 'assignMfo'])->name('units.assignMfo');
    
    Route::resource('campuses', CampusController::class)->names([
        'index'     =>  'campuses.index',
        'create'    =>  'campuses.create',
        'store'     =>  'campuses.store',
        'show'      =>  'campuses.show',
        'edit'      =>  'campuses.edit',
        'update'    =>  'campuses.update',
        'destroy'   =>  'campuses.delete',
    ]);
    
    Route::resource('budget-year', BudgetYearController::class)->names([
        'index'     =>  'budget-year.index',
        'create'    =>  'budget-year.create',
        'store'     =>  'budget-year.store',
        'show'      =>  'budget-year.show',
        'edit'      =>  'budget-year.edit',
        'update'    =>  'budget-year.update',
        'destroy'   =>  'budget-year.delete',
    ]);
    
    Route::resource('mfos', MajorFinalOutputController::class)->names([
        'index'     =>  'mfos.index',
        'create'    =>  'mfos.create',
        'store'     =>  'mfos.store',
        'show'      =>  'mfos.show',
        'edit'      =>  'mfos.edit',
        'update'    =>  'mfos.update',
        'destroy'   =>  'mfos.delete',
    ]);
    
    Route::resource('paps', ProgramActivityProjectsController::class)->names([
        'index'     =>  'paps.index',
        'create'    =>  'paps.create',
        'store'     =>  'paps.store',
        'show'      =>  'paps.show',
        'edit'      =>  'paps.edit',
        'update'    =>  'paps.update',
        'destroy'   =>  'paps.delete',
    ]);
    
    Route::resource('budget-ceilings', BudgetCeilingController::class)->names([
        'index'     =>  'budget-ceilings.index',
        'create'    =>  'budget-ceilings.create',
        'store'     =>  'budget-ceilings.store',
        'show'      =>  'budget-ceilings.show',
        'edit'      =>  'budget-ceilings.edit',
        'update'    =>  'budget-ceilings.update',
        'destroy'   =>  'budget-ceilings.delete',
    ]);
    
    Route::get('budget-ceilings/campus/{id}', [BudgetCeilingController::class, 'showCampus'])->name('show-campus');
    
    // Route::get('/get-paps-by-fundsource/{fundSourceId}', [ProgramActivityProjectsController::class, 'getPapsByFundSource']);
    // Route::get('/get-paps-by-mfo/{mfoId}', [ProgramActivityProjectsController::class, 'getPapsByMfo']);
    // Route::get('/get-paps-by-fundsource-and-mfo/{fundSourceId}/{mfoId}', [ProgramActivityProjectsController::class, 'getPapsByFundSourceAndMfo']);
    Route::get('/get-paps', [ProgramActivityProjectsController::class, 'getPaps']);
    Route::get('/get-fundsource-and-mfo-by-paps/{papId}', [ProgramActivityProjectsController::class, 'getFundSourceAndMfoByPaps']);


    Route::get('unit/budget-ceiling', [UnitBudgetCeilingController::class, 'index'])->name('admin.unit-budget-ceiling.index');
    Route::get('unit/{id}/budget-ceiling', [UnitBudgetCeilingController::class, 'show'])->name('admin.unit-budget-ceiling.show');
    Route::post('unit/budget-ceiling', [UnitBudgetCeilingController::class, 'store'])->name('admin.unit-budget-ceiling.store');
});

