<?php

namespace App\Http\Controllers;

use App\Http\Requests\BudgetCeilingStoreRequest;
use App\Http\Requests\BudgetCeilingUpdateRequest;
use App\Models\BudgetYear;
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

        // You may set selectedYear to the active year here
        $selectedYear = $activeYear;

        $campuses = Campus::with(['campusBudgetCeilings' => function ($query) use ($activeYear) {
            $query->where('budget_year_id', $activeYear->id);
        }])->get();

        return view('budget-ceilings.campuses.index', compact('campuses', 'budgetYears', 'selectedYear', 'activeYear'));
    }

    public function getCampusBudgetCeilingByYear(Request $request)
    {
        // Retrieve the selected year from the request
        $yearId = $request->query('year');

        // Fetch all available budget years for the dropdown or display
        $budgetYears = $this->getAllYears();

        // Fetch the selected budget year details
        $selectedYear = BudgetYear::find($yearId); // Rename this to selectedYear

        // Fetch the campuses with their budget ceilings for the selected year
        $campuses = Campus::with(['campusBudgetCeilings' => function ($query) use ($yearId) {
            $query->where('budget_year_id', $yearId);
        }])->get();

        // If no data for the selected year, get all campuses (without filtering by budget year)
        if ($campuses->isEmpty()) {
            $campuses = Campus::all();
        }

        // Return the view with the necessary data, now using selectedYear instead of activeYear
        return view('budget-ceilings.campuses.index', compact('campuses', 'budgetYears', 'selectedYear'));
    }

    public function showCampus($id, $budgetYearId, Request $request)
    {
        $campus = Campus::findOrFail($id);
        $activeYear = $this->getActiveYear();
        // Fetch the budget ceilings for the campus and the specified budget year
        // return $campusBudgetCeilings = CampusBudgetCeiling::where('campus_id', $campus->id)->get();

         // Build the query
        $query = CampusBudgetCeiling::query()
            ->where('campus_id', $campus->id)
            ->when($budgetYearId, function ($query) use ($budgetYearId) {
                return $query->where('budget_year_id', $budgetYearId);
            })
            ->with(['programActivityProject.fundSource', 'programActivityProject.majorFinalOutput']);

        // Execute the query
        $campusBudgetCeilings = $query->get();

        $groupedBudgetCeilings = $campusBudgetCeilings->groupBy(function ($type) {
            return $type->programActivityProject->fundSource->abbreviation;
        });

        // Calculate the grand total based on total_amount
        $grandTotal = $campusBudgetCeilings->sum('total_amount');

        $fundSources = $this->getAllFundSources();
        $mfos = $this->getAllMFOs();
        $paps = $this->getAllPAPs();

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
            'processed_by'          =>      Auth::id(),
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
    public function update(BudgetCeilingUpdateRequest $request, CampusBudgetCeiling $budget_ceiling)
    {
        $psAmount = str_replace(',', '', $request->ps);
        $mooeAmount = str_replace(',', '', $request->mooe);
        $coAmount = str_replace(',', '', $request->co);
        $totalAmount = $psAmount + $mooeAmount + $coAmount;
        $budget_ceiling->update([
            'pap_id'                =>      $request->pap,
            'ps'                    =>      $psAmount,
            'mooe'                  =>      $mooeAmount,
            'co'                    =>      $coAmount,
            'total_amount'          =>      $totalAmount,
            'processed_by'          =>      Auth::id(),
        ]);
        return redirect()->back()->with('success','Budget Ceiling updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CampusBudgetCeiling $budget_ceiling)
    {
        $budget_ceiling->delete();
        return response()->json(['message' => 'Budget Ceiling deleted successfully'], 200);
    }
}
