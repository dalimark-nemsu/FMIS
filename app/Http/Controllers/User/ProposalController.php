<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Proposal;
use App\Models\UnitBudgetCeiling;
use function PHPSTORM_META\type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Str;
use Inertia\Inertia;

class ProposalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unitBudgetCeilings = UnitBudgetCeiling::where('operating_unit', Auth::user()->unit_id)->get();
        return Inertia::render('User/Proposal/Index', ['unitBudgetCeilings' => $unitBudgetCeilings]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $proposal = Proposal::create([
            'type' => $request->type,
            'title' => $request->title,
            'proponent_id' => $request->proponent_id,
            'unit_budget_ceiling_id' => $request->unit_budget_ceiling_id,
            'created_by' => Auth::id(),
        ]);

        return to_route('proposals.edit', $proposal->id)->with('success', 'created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Proposal  $proposal
     * @return \Illuminate\Http\Response
     */
    public function show(Proposal $proposal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Proposal  $proposal
     * @return \Illuminate\Http\Response
     */
    public function edit(Proposal $proposal)
    {
        $proposal = [
            'id'                            =>      $proposal->id,
            'title'                         =>      Str::title($proposal->title),
            'type'                          =>      Str::ucfirst($proposal->type),
            'program_name'                  =>      Str::title($proposal->unitBudgetCeiling->campusBudgetCeiling?->programActivityProject?->name),
            'mfo_abbreviation'              =>      Str::upper($proposal->unitBudgetCeiling->campusBudgetCeiling?->programActivityProject?->majorFinalOutput?->abbreviation),
            'fund_source_abbreviation'      =>      Str::upper($proposal->unitBudgetCeiling->campusBudgetCeiling?->programActivityProject?->fundSource?->abbreviation),
            'amount'                        =>      $proposal->unitBudgetCeiling?->total_amount ? number_format($proposal->unitBudgetCeiling->total_amount, 2) : null,
            'proposal_description'          =>      $proposal->description,
            'proposal_purpose'              =>      $proposal->purpose,
            'participants_beneficiaries'    =>      $proposal->participants_beneficiaries,
            'expected_output'               =>      $proposal->expected_output,
        ];
        return Inertia::render('User/Proposal/Edit',  ['proposal' => $proposal]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Proposal  $proposal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proposal $proposal)
    {

    }

    public function updateProposalDetails(Request $request, Proposal $proposal)
    {
        // Define a mapping of request field names to database column names
        $fieldMapping = [
            'proposal_description' => 'description',
            'proposal_purpose' => 'purpose',
            'participants_beneficiaries' => 'participants_beneficiaries',
            'expected_output' => 'expected_output',
        ];

        // Validate the incoming request
        $validated = $request->validate([
            'field' => 'required|string|in:' . implode(',', array_keys($fieldMapping)), // Only accept keys in $fieldMapping
            'content' => 'nullable|string',
        ]);

        // Translate the field name to the database column name
        $field = $validated['field'];
        $dbColumn = $fieldMapping[$field] ?? null;

        if (!$dbColumn) {
            return response()->json(['error' => 'Invalid field name'], 400); // Bad Request
        }

        // Update the specific field in the database
        $proposal->$dbColumn = $validated['content'];
        $proposal->save();

        return response()->json(['success' => true, 'message' => 'Field updated successfully.']);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Proposal  $proposal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proposal $proposal)
    {
        //
    }
}
