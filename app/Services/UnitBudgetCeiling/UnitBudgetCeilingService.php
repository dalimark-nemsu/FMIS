<?php

namespace App\Services\UnitBudgetCeiling;

use App\Helpers\BudgetCeilingCalculation;
use App\Models\CampusBudgetCeiling;
use App\Models\UnitBudgetCeiling;
use Illuminate\Support\Facades\Auth;

class UnitBudgetCeilingService
{
    protected $budgetCeilingCalculation;

    public function __construct(BudgetCeilingCalculation $budgetCeilingCalculation)
    {
        $this->budgetCeilingCalculation = $budgetCeilingCalculation;
    }

    public function getAllCampusBudgetCeiling(array $data, $selectedYear)
    {
        $query = CampusBudgetCeiling::with([
            'unitBudgetCeilings', 
            'programActivityProject.fundSource', 
            'programActivityProject.majorFinalOutput', 
            'budgetYear'
        ]);
    
        // Filter by campus ID based on role
        $query->when(Auth::user()->hasRole(['super-admin', 'budget-officer-iii']), function($query) use ($data) {
            if (!isset($data['campus_id'])) {
                abort(404);
            }
            return $query->where('campus_id', $data['campus_id']);
        });
    
        // Restrict to user's campus if role is 'budget-officer-ii'
        $query->when(Auth::user()->hasRole('budget-officer-ii'), function($query) {
            $campusId = Auth::user()?->unit?->campus_id;
            if (!$campusId) {
                abort(404);
            }
            return $query->where('campus_id', $campusId);
        });
    
        $campusBudgetCeilings = $query->where('budget_year_id', $selectedYear->id)->isPosted()->get();

        $calculateBudgetData = [
            'campusTotalAllocatedBudget' => $this->budgetCeilingCalculation->getCampusTotalAllocatedBudget($campusBudgetCeilings),
            'campusUnitTotalAllocatedBudget' => $this->budgetCeilingCalculation->getCampusUnitTotalAllocated($campusBudgetCeilings),
            'campusUnitTotalUnallocatedBudget' => $this->budgetCeilingCalculation->getCampusUnitTotalUnallocated($campusBudgetCeilings),
        ];
    
        return [
            'campusBudgetCeilings' => $campusBudgetCeilings,
            'budgetData' => $calculateBudgetData,
        ];
    }

    public function getCampusUnitBudgetCeiling($budgetCeilingId)
    {
        $campusBudgetCeiling = CampusBudgetCeiling::with([
            'programActivityProject', 
            'programActivityProject.papType', 
            'programActivityProject.units', 
            'unitBudgetCeilings'
        ])->isPosted()->findOrFail($budgetCeilingId);

        $calculateBudgetData = [
            'unitPSTotalAllocated' => $this->budgetCeilingCalculation->getUnitPSTotalAllocated($campusBudgetCeiling),
            'unitMOOETotalAllocated' => $this->budgetCeilingCalculation->getUnitMOOETotalAllocated($campusBudgetCeiling),
            'unitCOTotalAllocated' => $this->budgetCeilingCalculation->getUnitCOTotalAllocated($campusBudgetCeiling),
            'unitTotalAllocated' => $this->budgetCeilingCalculation->getUnitTotalAllocated($campusBudgetCeiling),
            'unitPSTotalUnallocated' => $this->budgetCeilingCalculation->getUnitPSTotalUnallocated($campusBudgetCeiling),
            'unitMOOETotalUnallocated' => $this->budgetCeilingCalculation->getUnitMOOETotalUnallocated($campusBudgetCeiling),
            'unitCOTotalUnallocated' => $this->budgetCeilingCalculation->getUnitCOTotalUnallocated($campusBudgetCeiling),
            'unitTotalUnallocated' => $this->budgetCeilingCalculation->getUnitTotalUnallocated($campusBudgetCeiling),
        ];
    
        return [
            'campusBudgetCeiling' => $campusBudgetCeiling,
            'budgetData' => $calculateBudgetData,
        ];
    }

    public function storeUnitBudgetCeling(array $data)
    {
        $campusBudgetCeiling = CampusBudgetCeiling::findOrFail($data['campus_budget_ceiling']);

        $ps = $this->parseBudgetValue($data['ps'] ?? 0);
        $mooe = $this->parseBudgetValue($data['mooe'] ?? 0);
        $co = $this->parseBudgetValue($data['co'] ?? 0);
        $totalAmount = $this->budgetCeilingCalculation->calculateTotalAmount($ps, $mooe, $co, $this->parseBudgetValue($data['total']) ?? 0);

        return $campusBudgetCeiling->unitBudgetCeilings()->create([
            'operating_unit' => $data['unit'],
            'ps'             => $ps,
            'mooe'           => $mooe,
            'co'             => $co,
            'total_amount'   => $totalAmount,
            'processed_by'   => Auth::id()
        ]);
    }

    public function updateUnitBudgetCeiling(array $data, $id)
    {
        $unitBudgetCeiling = UnitBudgetCeiling::with(['campusBudgetCeiling', 'campusBudgetCeiling.programActivityProject', 'campusBudgetCeiling.programActivityProject.fundSource'])->find($id);
        
        $ps = $this->parseBudgetValue($data['ps'] ?? 0);
        $mooe = $this->parseBudgetValue($data['mooe'] ?? 0);
        $co = $this->parseBudgetValue($data['co'] ?? 0);
        $totalAmount = $this->budgetCeilingCalculation->calculateTotalAmount($ps, $mooe, $co, $this->parseBudgetValue($data['total']) ?? 0);

        $unitBudgetCeiling->ps = $ps;
        $unitBudgetCeiling->mooe = $mooe;
        $unitBudgetCeiling->co = $co;
        $unitBudgetCeiling->total_amount = $totalAmount;
        $unitBudgetCeiling->processed_by = Auth::id();
        
        return $unitBudgetCeiling->save();
    }

    public function post($id){
        $unitBudgetCeiling = UnitBudgetCeiling::findOrFail($id);
        $unitBudgetCeiling->is_posted = true;
        return $unitBudgetCeiling->save();
    }

    public function unpost($id){
        $unitBudgetCeiling = UnitBudgetCeiling::findOrFail($id);
        $unitBudgetCeiling->is_posted = false;
        return $unitBudgetCeiling->save();
    }

    public function destroy($id){
        $unitBudgetCeiling = UnitBudgetCeiling::findOrFail($id);
        return $unitBudgetCeiling->delete();
    }

    /**
     * Parse the budget value by removing commas and converting it to a float.
     *
     * @param string|float $value
     * @return float
     */
    private function parseBudgetValue($value): float
    {
        return floatval(str_replace(',', '', $value));
    }
}
