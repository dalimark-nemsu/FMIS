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

    // public function showCampus($id, $budgetYearId, Request $request)
    // {
    //     $campus = Campus::findOrFail($id);
    //     $activeYear = $this->getActiveYear();
    //     // Fetch the budget ceilings for the campus and the specified budget year
    //     // return $campusBudgetCeilings = CampusBudgetCeiling::where('campus_id', $campus->id)->get();

    //      // Build the query
    //     $query = CampusBudgetCeiling::query()
    //         ->where('campus_id', $campus->id)
    //         ->when($budgetYearId, function ($query) use ($budgetYearId) {
    //             return $query->where('budget_year_id', $budgetYearId);
    //         })
    //         ->with(['programActivityProject.fundSource', 'programActivityProject.majorFinalOutput']);

    //     // Execute the query
    //     $campusBudgetCeilings = $query->get();

    //     $groupedBudgetCeilings = $campusBudgetCeilings->groupBy(function ($type) {
    //         return $type->programActivityProject->fundSource->abbreviation;
    //     });

    //     // Calculate the grand total based on total_amount
    //     $grandTotal = $campusBudgetCeilings->sum('total_amount');

    //     $fundSources = $this->getAllFundSources();
    //     $mfos = $this->getAllMFOs();
    //     $paps = $this->getAllPAPs();

    //     return view('budget-ceilings.index', compact('campus', 'activeYear', 'fundSources', 'mfos', 'paps', 'groupedBudgetCeilings', 'grandTotal', 'budgetYearId'));
    // }

    public function showCampus($id, $budgetYearId, Request $request)
    {
        $campus = Campus::findOrFail($id);
        $activeYear = $this->getActiveYear();

        // Check if all CampusBudgetCeilings are posted
        $allBudgetsPosted = $campus->allBudgetsPosted();

        // Other code to fetch data
        $campusBudgetCeilings = CampusBudgetCeiling::where('campus_id', $campus->id)
            ->where('budget_year_id', $budgetYearId)
            ->with(['programActivityProject.fundSource', 'programActivityProject.majorFinalOutput'])
            ->get();

        $groupedBudgetCeilings = $campusBudgetCeilings->groupBy(function ($type) {
            return $type->programActivityProject->fundSource->abbreviation;
        });

        $grandTotal = $campusBudgetCeilings->sum('total_amount');
        $fundSources = $this->getAllFundSources();
        $mfos = $this->getAllMFOs();
        $paps = $this->getAllPAPs();

        return view('budget-ceilings.index', compact(
            'campus', 'activeYear', 'fundSources', 'mfos', 'paps', 'groupedBudgetCeilings', 'grandTotal', 'budgetYearId', 'allBudgetsPosted'
        ));
    }

    public function postBudgetCeiling(Request $request)
{
    // Validate request data including 'is_posted' as an integer (1 or 0)
    $validatedData = $request->validate([
        'campus_id' => 'required|integer|exists:campuses,id',
        'budget_year_id' => 'required|integer|exists:budget_years,id',
        'is_posted' => 'required|in:0,1', // Ensure is_posted is either 1 or 0
    ]);

    // Update the is_posted status based on the request
    CampusBudgetCeiling::where('campus_id', $validatedData['campus_id'])
        ->where('budget_year_id', $validatedData['budget_year_id'])
        ->update(['is_posted' => $validatedData['is_posted']]);

    // Set the response message based on the is_posted status
    $statusMessage = $validatedData['is_posted'] == 1 ? 'Budget ceiling posted successfully.' : 'Budget ceiling unposted successfully.';

    return response()->json(['status' => 'success', 'message' => $statusMessage]);
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
        $psAmount = (float) str_replace(',', '', $request->ps);
        $mooeAmount = (float) str_replace(',', '', $request->mooe);
        $coAmount = (float) str_replace(',', '', $request->co);
        if (!empty($psAmount) || !empty($mooeAmount) || !empty($coAmount)) {
            // Calculate totalAmount if at least one of the values is present
            $totalAmount = $psAmount + $mooeAmount + $coAmount;
        } else {
            $totalAmount = (float) str_replace(',', '', $request->total);
        }
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
        $psAmount = (float) str_replace(',', '', $request->ps);
        $mooeAmount = (float) str_replace(',', '', $request->mooe);
        $coAmount = (float) str_replace(',', '', $request->co);
        if (!empty($psAmount) || !empty($mooeAmount) || !empty($coAmount)) {
            // Calculate totalAmount if at least one of the values is present
            $totalAmount = $psAmount + $mooeAmount + $coAmount;
        } else {
            $totalAmount = (float) str_replace(',', '', $request->total);
        }
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
