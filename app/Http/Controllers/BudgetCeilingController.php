<?php

namespace App\Http\Controllers;

use App\Http\Requests\BudgetCeilingStoreRequest;
use App\Models\Campus;
use App\Models\CampusBudgetCeiling;
use App\Services\BudgetYearService;
use App\Services\CampusBudgetCeilingService;
use App\Traits\DataRetrievalTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BudgetCeilingController extends Controller
{
    use DataRetrievalTrait;

    // protected $campusBudgetCeilingService, $budgetYearService;

    // public function __construct(CampusBudgetCeilingService $campusBudgetCeilingService,
    //                             BudgetYearService $budgetYearService)
    // {
    //     $this->campusBudgetCeilingService = $campusBudgetCeilingService;
    //     $this->budgetYearService = $budgetYearService;
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $budgetYears = $this->getAllYears();
        $activeYear = $this->getActiveYear();
        $campuses = $this->getAllCampuses();
        return view('budget-ceilings.campuses.index', compact('campuses', 'budgetYears', 'activeYear'));
    }

    public function showCampus($id)
    {
        $campus = Campus::findOrFail($id);
        $activeYear = $this->getActiveYear();
        $fundSources = $this->getAllFundSources();
        $mfos = $this->getAllMFOs();
        $paps = $this->getAllPAPs();
        $campusBudgetCeilings = CampusBudgetCeiling::where('campus_id', $campus->id)->with(['programActivityProject.fundSource', 'programActivityProject.majorFinalOutput'])->get();
        $groupedBudgetCeilings = $campusBudgetCeilings->groupBy(function ($type) {
            return $type->programActivityProject->fundSource->abbreviation;
        });
        // Calculate the grand total based on total_amount
        $grandTotal = $campusBudgetCeilings->sum('total_amount');
        return view('budget-ceilings.index', compact('campus', 'activeYear', 'fundSources', 'mfos', 'paps', 'groupedBudgetCeilings', 'grandTotal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BudgetCeilingStoreRequest $request)
    {
        $psAmount = str_replace(',', '', $request->ps);
        $mooeAmount = str_replace(',', '', $request->mooe);
        $coAmount = str_replace(',', '', $request->co);
        $totalAmount = $psAmount + $mooeAmount + $coAmount;
        CampusBudgetCeiling::create([
            'campus_id'             =>      $request->campus_id,
            'budget_year_id'        =>      $request->year_id,
            'pap_id'                =>      $request->pap,
            'ps'                    =>      $psAmount,
            'mooe'                  =>      $mooeAmount,
            'co'                    =>      $coAmount,
            'total_amount'          =>      $totalAmount,
            'processed_by'          =>      1,
        ]);
        return redirect()->back()->with('success','Budget Ceiling added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CampusBudgetCeiling $campusBudgetCeiling)
    {
        $psAmount = str_replace(',', '', $request->ps);
        $mooeAmount = str_replace(',', '', $request->mooe);
        $coAmount = str_replace(',', '', $request->co);
        $totalAmount = $psAmount + $mooeAmount + $coAmount;
        $campusBudgetCeiling->update([
            'pap_id'                =>      $request->pap,
            'ps'                    =>      $psAmount,
            'mooe'                  =>      $mooeAmount,
            'co'                    =>      $coAmount,
            'total_amount'          =>      $totalAmount,
            'processed_by'          =>      1,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
