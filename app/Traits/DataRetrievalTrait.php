<?php

namespace App\Traits;

use App\Models\BudgetYear;
use App\Models\Campus;
use App\Models\FundSource;
use App\Models\MajorFinalOutput;
use App\Models\ProgramActivityProject;

trait DataRetrievalTrait
{
    public function getAllYears()
    {
        return BudgetYear::orderBy('year', 'desc')->get();
    }

    public function getActiveYear()
    {
        return BudgetYear::where('is_active', 1)->first(['id', 'year']);
    }

    public function getAllCampuses()
    {
        return Campus::all();
    }

    public function getAllFundSources()
    {
        return FundSource::all();
    }

    public function getAllMFOs()
    {
        return MajorFinalOutput::all();
    }

    public function getAllPAPs()
    {
        return ProgramActivityProject::all();
    }
}
