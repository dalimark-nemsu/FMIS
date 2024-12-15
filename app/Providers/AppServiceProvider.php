<?php

namespace App\Providers;

use App\Models\BudgetYear;
use App\Models\FundSource;
use App\Models\MajorFinalOutput;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['admin.unit-budget-ceiling.index', 'admin.unit-budget-ceiling.show'], function ($view) {
            $fundSources = FundSource::all();
            $majorFinalOutputs = MajorFinalOutput::all();
            $budgetYears = BudgetYear::all();  // Assuming you fetch all budget years
            $activeYear = BudgetYear::where('is_active', 1)->first();  // Assuming you have an 'is_active' column
            
            $view->with([
                'fundSources' => $fundSources,
                'majorFinalOutputs' => $majorFinalOutputs,
                'budgetYears' => $budgetYears,
                'activeYear' => $activeYear
            ]);
        });
    }
}
