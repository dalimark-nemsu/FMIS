<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CampusBudgetCeiling;
use App\Models\FundSource;
use App\Models\MajorFinalOutput;
use App\Models\ProgramActivityProject;
use App\Models\UnitBudgetCeiling;
use App\Traits\DataRetrievalTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UnitBudgetCeilingController extends Controller
{
    use DataRetrievalTrait;

    public function index()
    {
        $budgetYears = $this->getAllYears();
        $activeYear = $this->getActiveYear();
        $fundSources = FundSource::all();;
        $majorFinalOutputs = MajorFinalOutput::all();;
        $campusBudgetCeilings = CampusBudgetCeiling::with(['programActivityProject', 'programActivityProject.fundSource', 'programActivityProject.majorFinalOutput', 'budgetYear'])->where('campus_id', Auth::user()->unit?->campus_id)
            ->where('budget_year_id', $activeYear->id)
            ->get();
        return view('admin.unit-budget-ceiling.index', ['campusBudgetCeilings' => $campusBudgetCeilings, 'budgetYears' => $budgetYears, 'fundSources' => $fundSources, 'activeYear' => $activeYear, 'majorFinalOutputs' => $majorFinalOutputs]);
    }

    public function show($id)
    {
        $campusBudgetCeiling = CampusBudgetCeiling::with(['programActivityProject', 'programActivityProject.majorFinalOutput', 'programActivityProject.majorFinalOutput.units'])->find($id);
        $unitBudgetCeilings = UnitBudgetCeiling::with(['programActivityProject', 'budgetYear', 'operatingUnit'])->get();
        $units = $campusBudgetCeiling->programActivityProject->majorFinalOutput->units;

        $psTotal = $campusBudgetCeiling->ps;
        $mooeTotal = $campusBudgetCeiling->mooe;
        $coTotal = $campusBudgetCeiling->co;

        $psAllocatedSum = $unitBudgetCeilings->sum('ps');
        $mooeAllocatedSum = $unitBudgetCeilings->sum('mooe');
        $coAllocatedSum = $unitBudgetCeilings->sum('co');
        $totalAllocatedSum = $unitBudgetCeilings->sum('total_amount');

        $psUnallocated = $psTotal - $psAllocatedSum;
        $mooeUnallocated = $mooeTotal - $mooeAllocatedSum;
        $coUnallocated = $coTotal - $coAllocatedSum;
        $totalUnallocated = $psUnallocated + $mooeUnallocated + $coUnallocated;

        return view('admin.unit-budget-ceiling.show', [
            'unitBudgetCeilings' => $unitBudgetCeilings,
            'campusBudgetCeiling' => $campusBudgetCeiling,
            'units' => $units,
            'psAllocatedSum' => $psAllocatedSum,
            'mooeAllocatedSum' => $mooeAllocatedSum,
            'coAllocatedSum' => $coAllocatedSum,
            'totalAllocatedSum' => $totalAllocatedSum,
            'psUnallocated' =>  $psUnallocated,
            'mooeUnallocated'   =>  $mooeUnallocated,
            'coUnallocated'   =>  $coUnallocated,
            'totalUnallocated' => $totalUnallocated
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'units' => ['required', 'string', 'max:255'],
            'units.*' => ['required', 'string', 'max:255'],
            'ps' => ['sometimes', 'required', 'regex:/^\d{1,3}(,\d{3})*(\.\d{2})?$/', 'min:0'],
            'mooe' => ['sometimes', 'required', 'regex:/^\d{1,3}(,\d{3})*(\.\d{2})?$/', 'min:0'],
            'co' => ['sometimes', 'required', 'regex:/^\d{1,3}(,\d{3})*(\.\d{2})?$/', 'min:0'],
            'total' => ['sometimes', 'required', 'regex:/^\d{1,3}(,\d{3})*(\.\d{2})?$/', 'min:0']
        ]);

        $pap = ProgramActivityProject::with(['fundSource'])->find($request->pap_id);
        
        $total = 0;

        if ($pap->fundSource?->abbreviation !== "GAA") {
            $total = $request->total;
        }

        $ps = floatval(str_replace(',', '', $request->ps));
        $mooe = floatval(str_replace(',', '', $request->mooe));
        $co = floatval(str_replace(',', '', $request->co));

        $total = array_sum([$ps, $mooe, $co]);

        foreach ($request->units as $key => $unit) {
            UnitBudgetCeiling::create([
                'budget_year_id' => $request->budget_year_id,
                'pap_id' => $request->pap_id,
                'operating_unit' => $unit,
                'ps' => $ps,
                'mooe' => $mooe,
                'co' => $co,
                'total_amount' => $total,
                'processed_by'   => Auth::id()
            ]);
        }

        return redirect()->back()->with('success', 'Budget has been assigned.');
    }
}
