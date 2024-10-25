<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\BudgetCeilingCalculation;
use App\Http\Controllers\Controller;
use App\Models\BudgetYear;
use App\Models\CampusBudgetCeiling;
use App\Models\FundSource;
use App\Models\MajorFinalOutput;
use App\Models\ProgramActivityProject;
use App\Models\Unit;
use App\Models\UnitBudgetCeiling;
use App\Traits\DataRetrievalTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Helpers\BudgetCeilingHelper;
use App\Http\Requests\UnitBudgetCeiling\UnitBudgetCeilingStoreRequest;
use App\Http\Requests\UnitBudgetCeiling\UnitBudgetCeilingUpdateRequest;
use App\Models\Campus;
use App\Services\UnitBudgetCeiling\UnitBudgetCeilingService;

class UnitBudgetCeilingController extends Controller
{
    use DataRetrievalTrait;

    protected UnitBudgetCeilingService $unitBudgetCeilingService;
    public function __construct(
        UnitBudgetCeilingService $unitBudgetCeilingService
    )
    {
        $this->unitBudgetCeilingService = $unitBudgetCeilingService;
    }

    public function index(Request $request)
    {
        $selectedYear = $this->getSelectedYear($request);
        $selectedCampus = $this->getSelectedCampus($request);
        $unitBudgetCeilingService = $this->unitBudgetCeilingService->getAllCampusBudgetCeiling($request->all(), $selectedYear);
        $campusBudgetCeilings= $unitBudgetCeilingService['campusBudgetCeilings'];
        $budgetData = $unitBudgetCeilingService['budgetData'];

        return view('admin.unit-budget-ceiling.index', [
            'campusBudgetCeilings' => $campusBudgetCeilings,
            'selectedYear' => $selectedYear,
            'selectedCampus' => $selectedCampus,
            'budgetData'    =>  $budgetData
        ]);
    }

    public function show($id)
    {
        $unitBudgetCeilingService = $this->unitBudgetCeilingService->getCampusUnitBudgetCeiling($id);
        $campusBudgetCeiling = $unitBudgetCeilingService['campusBudgetCeiling'];
        $budgetData = $unitBudgetCeilingService['budgetData'];
        $unitBudgetCeilings = $campusBudgetCeiling->unitBudgetCeilings;
        $units = $campusBudgetCeiling->programActivityProject->majorFinalOutput->units;

        return view('admin.unit-budget-ceiling.show', [
            'unitBudgetCeilings' => $unitBudgetCeilings,
            'campusBudgetCeiling' => $campusBudgetCeiling,
            'units' => $units,
            'budgetData'    =>  $budgetData
        ]);
    }
    

    public function store(UnitBudgetCeilingStoreRequest $request)
    {
        $this->unitBudgetCeilingService->storeUnitBudgetCeling($request->all());
        return redirect()->back()->with('success', 'Budget has been assigned.');
    }

    public function update(UnitBudgetCeilingUpdateRequest $request, $unitBudgetCeilingId)
    {
        $this->unitBudgetCeilingService->updateUnitBudgetCeiling($request->all(), $unitBudgetCeilingId);
        return redirect()->back()->with('success', 'Budget assignment has been updated.');
    }

    public function post($unitBudgetCeilingId)
    {
        $this->unitBudgetCeilingService->post($unitBudgetCeilingId);
        return redirect()->back()->with('success', 'Budget assignment has been posted.');
    }

    public function unpost($unitBudgetCeilingId)
    {
        $this->unitBudgetCeilingService->unpost($unitBudgetCeilingId);
        return redirect()->back()->with('success', 'Budget assignment has been unposted.');
    }

    public function destroy($unitBudgetCeilingId)
    {
        $this->unitBudgetCeilingService->destroy($unitBudgetCeilingId);
        return redirect()->back()->with('success', 'Budget assignment has been deleted.');
    }

    private function getSelectedYear(Request $request)
    {
        if ($request->has('budget_year_id')) {
            return BudgetYear::select('id', 'year')->find($request->budget_year_id) ?? $this->getActiveYear();
        }
        return $this->getActiveYear();
    }
    
    private function getSelectedCampus(Request $request)
    {
        return optional(Campus::find($request->campus_id));
    }
}
