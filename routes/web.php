<?php

use App\Http\Controllers\Admin\UnitBudgetCeilingController;
use App\Http\Controllers\AllotmentClassController;
use App\Http\Controllers\BudgetCeilingController;
use App\Http\Controllers\BudgetYearController;
use App\Http\Controllers\CampusController;
use App\Http\Controllers\FundSourceController;
use App\Http\Controllers\MajorFinalOutputController;
use App\Http\Controllers\ObjectExpenditureController;
use App\Http\Controllers\ProgramActivityProjectsController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\User\HomeController as UserHomeController;
use Illuminate\Support\Facades\Auth;
use App\Models\FundSource;
use App\Models\ProgramActivityProject;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/dashboard', [UserHomeController::class, 'index'])->name('home');
Route::get('proposals', function(){
    return Inertia::render('User/Proposal/Index');
})->name('proposals')->middleware('auth');
Route::get('proposals/edit', function(){
    return Inertia::render('User/Proposal/Edit');
})->name('proposals')->middleware('auth');
Route::get('project-procurement-management-plan', function(){
    return Inertia::render('User/Ppmp/Index');
})->name('ppmp')->middleware('auth');
Route::get('purchase-request', function(){
    return Inertia::render('User/PurchaseRequest/Index');
})->name('pr')->middleware('auth');

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

    Route::resource('allotment-classes', AllotmentClassController::class)->names([
        'index'     =>  'allotment-classes.index',
        'create'    =>  'allotment-classes.create',
        'store'     =>  'allotment-classes.store',
        'show'      =>  'allotment-classes.show',
        'edit'      =>  'allotment-classes.edit',
        'update'    =>  'allotment-classes.update',
        'destroy'   =>  'allotment-classes.delete',
    ]);

    Route::resource('object-expenditures', ObjectExpenditureController::class)->names([
        'index'     =>  'object-expenditures.index',
        'create'    =>  'object-expenditures.create',
        'store'     =>  'object-expenditures.store',
        'show'      =>  'object-expenditures.show',
        'edit'      =>  'object-expenditures.edit',
        'update'    =>  'object-expenditures.update',
        'destroy'   =>  'object-expenditures.delete',
    ]);

    Route::get('/campus/{id}/budget-ceilings/{budgetYearId}', [BudgetCeilingController::class, 'showCampus'])->name('show-campus');
    Route::post('/post-budget-ceiling', [BudgetCeilingController::class, 'postBudgetCeiling'])->name('post-budget-ceiling');
    Route::get('/by-year/budget-ceilings/', [BudgetCeilingController::class, 'getCampusBudgetCeilingByYear'])->name('budget-ceiling.by-year');

    // Route::get('/get-paps-by-fundsource/{fundSourceId}', [ProgramActivityProjectsController::class, 'getPapsByFundSource']);
    // Route::get('/get-paps-by-mfo/{mfoId}', [ProgramActivityProjectsController::class, 'getPapsByMfo']);
    // Route::get('/get-paps-by-fundsource-and-mfo/{fundSourceId}/{mfoId}', [ProgramActivityProjectsController::class, 'getPapsByFundSourceAndMfo']);
    Route::get('/get-paps', [ProgramActivityProjectsController::class, 'getPaps']);
    Route::get('/get-fundsource-and-mfo-by-paps/{papId}', [ProgramActivityProjectsController::class, 'getFundSourceAndMfoByPaps']);


    Route::get('unit/budget-ceiling', [UnitBudgetCeilingController::class, 'index'])->name('admin.unit-budget-ceiling.index');
    Route::get('unit/{id}/budget-ceiling', [UnitBudgetCeilingController::class, 'show'])->name('admin.unit-budget-ceiling.show');
    Route::post('unit/budget-ceiling', [UnitBudgetCeilingController::class, 'store'])->name('admin.unit-budget-ceiling.store');
    Route::put('unit/budget-ceiling/{unitBudgetCeilingId}', [UnitBudgetCeilingController::class, 'update'])->name('admin.unit-budget-ceiling.update');
    Route::put('unit/budget-ceiling/post/{unitBudgetCeilingId}', [UnitBudgetCeilingController::class, 'post'])->name('admin.unit-budget-ceiling.post');
    Route::put('unit/budget-ceiling/unpost/{unitBudgetCeilingId}', [UnitBudgetCeilingController::class, 'unpost'])->name('admin.unit-budget-ceiling.unpost');
    Route::delete('unit/budget-ceiling/destroy/{unitBudgetCeilingId}', [UnitBudgetCeilingController::class, 'destroy'])->name('admin.unit-budget-ceiling.destroy');
});

