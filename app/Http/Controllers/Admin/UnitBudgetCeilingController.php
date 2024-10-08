<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BudgetYear;
use App\Models\CampusBudgetCeiling;
use App\Models\FundSource;
use App\Models\MajorFinalOutput;
use App\Models\ProgramActivityProject;
use App\Models\UnitBudgetCeiling;
use App\Traits\DataRetrievalTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UnitBudgetCeilingController extends Controller
{
    use DataRetrievalTrait;

    public function index(Request $request)
    {
        $budgetYears = $this->getAllYears();
        $activeYear = $this->getActiveYear();
        $selectedYear = $request->has('budget_year_id') ? BudgetYear::select('id','year')->find($request->budget_year_id) : $this->getActiveYear();
        $fundSources = FundSource::all();;
        $majorFinalOutputs = MajorFinalOutput::all();

       $allocated = UnitBudgetCeiling::where('budget_year_id', $selectedYear->id)->whereHas('operatingUnit', function($query){
        $query->where('campus_id', Auth::user()->unit->campus_id);
       })->sum('total_amount');

        $query = CampusBudgetCeiling::query()->with(['programActivityProject', 'programActivityProject.fundSource', 'programActivityProject.majorFinalOutput', 'budgetYear']);
        
        $query->when(!Auth::user()->hasRole('super-admin'), function($query){
            return $query->where('campus_id', Auth::user()?->unit?->campus_id);
        });

        $campusBudgetCeilings = $query->where('budget_year_id', $selectedYear->id)->get();

        return view('admin.unit-budget-ceiling.index', [
            'campusBudgetCeilings' => $campusBudgetCeilings, 
            'budgetYears' => $budgetYears, 
            'fundSources' => $fundSources, 
            'activeYear' => $activeYear, 
            'selectedYear' => $selectedYear,
            'majorFinalOutputs' => $majorFinalOutputs
        ]);
    }

    public function show($id)
    {
        $campusBudgetCeiling = CampusBudgetCeiling::with(['programActivityProject', 'programActivityProject.majorFinalOutput', 'programActivityProject.majorFinalOutput.units'])->find($id);
        $unitBudgetCeilings = UnitBudgetCeiling::with(['programActivityProject', 'budgetYear', 'operatingUnit'])
            ->where('budget_year_id', $campusBudgetCeiling->budget_year_id)
            ->where('pap_id', $campusBudgetCeiling->pap_id)
            ->get();
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
        $totalUnallocated = ($campusBudgetCeiling?->fundSource?->abbreviation === 'GAA' || $campusBudgetCeiling?->fundSource?->abbreviation === 'TES') ? $psUnallocated + $mooeUnallocated + $coUnallocated : $campusBudgetCeiling->total_amount - $totalAllocatedSum;

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
        $campusBudgetCeiling = CampusBudgetCeiling::findOrFail($request->campus_budget_ceiling);
        $papsTotal = UnitBudgetCeiling::where('budget_year_id', $campusBudgetCeiling->budget_year_id)->where('pap_id', $request->pap_id)->sum('total_amount');

        $this->validate($request, [
            'unit' => [
                'required',
                'max:255',
                Rule::unique('unit_budget_ceilings', 'operating_unit')->where(function ($query) use ($campusBudgetCeiling) {
                    return $query->where('pap_id', $campusBudgetCeiling->pap_id)
                                 ->where('budget_year_id', $campusBudgetCeiling->budget_year_id);
                })
            ],
            'ps' => ['sometimes', 'required', 'regex:/^\d{1,3}(,\d{3})*(\.\d{2})?$/', 'min:0'],
            'mooe' => ['sometimes', 'required', 'regex:/^\d{1,3}(,\d{3})*(\.\d{2})?$/', 'min:0'],
            'co' => ['sometimes', 'required', 'regex:/^\d{1,3}(,\d{3})*(\.\d{2})?$/', 'min:0'],
            'total' => [
                'sometimes',
                'required',
                'regex:/^\d{1,3}(,\d{3})*(\.\d{2})?$/',
                'min:0',
                function ($attribute, $value, $fail) use ($campusBudgetCeiling, $papsTotal) {
                    // Convert the value to a float for comparison, removing commas
                    $totalInput = floatval(str_replace(',', '', $value));
                    $overAllPapsTotal = $totalInput + $papsTotal;
        
                    if ($overAllPapsTotal > floatval($campusBudgetCeiling->total_amount)) {
                        $fail('The amount input (' . number_format($totalInput, 2) .
                            ') plus the current PAPs total (' . number_format($papsTotal, 2) .
                            ') exceeds the allowed campus budget ceiling of ' .
                            number_format($campusBudgetCeiling->total_amount, 2) .
                            '. Please adjust your total accordingly.');
                    }
                }
            ]
        ], [
            'unit.required' => 'The unit field is required.',
            'unit.max' => 'The unit may not be greater than 255 characters.',
            'unit.unique' => 'The selected unit has already been assigned for the specified PAP and budget year.',
            'ps.required' => 'The PS field is required.',
            'mooe.required' => 'The MOOE field is required.',
            'co.required' => 'The CO field is required.',
            'total.required' => 'The total field is required.',
            'total.regex' => 'The total must be a valid number in the format: 1,000.00.',
            'total.min' => 'The total must be at least 0.',
        ]);        

        $pap = ProgramActivityProject::with(['fundSource'])->find($request->pap_id);
        
        $ps = 0;
        $mooe = 0;
        $co = 0;
        $total = 0;

        if ($pap->fundSource?->abbreviation === "GAA" || $pap->fundSource?->abbreviation === "TES") {
            $ps = floatval(str_replace(',', '', $request->ps));
            $mooe = floatval(str_replace(',', '', $request->mooe));
            $co = floatval(str_replace(',', '', $request->co));
    
            $total = array_sum([$ps, $mooe, $co]);
        }

        $total = floatval(str_replace(',', '', $request->total));

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
