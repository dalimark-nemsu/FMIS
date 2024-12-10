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
            'proposal_type'                      =>      $request->type,
            'proposal_title'                     =>      $request->title,
            'proposal_proponent_id'              =>      $request->proponent_id,
            'unit_budget_ceiling_id'             =>      $request->unit_budget_ceiling_id,
            'created_by'                         =>      Auth::id(),
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
        $proposalData = [
            'id' => $proposal->id,
            'title' => Str::title($proposal->proposal_title),
            'type' => Str::ucfirst($proposal->proposal_type),
            // 'program_name' => Str::title($proposal->unitBudgetCeiling->campusBudgetCeiling?->programActivityProject?->name),
            // 'mfo_abbreviation' => Str::upper($proposal->unitBudgetCeiling->campusBudgetCeiling?->programActivityProject?->majorFinalOutput?->abbreviation),
            // 'fund_source_abbreviation' => Str::upper($proposal->unitBudgetCeiling->campusBudgetCeiling?->programActivityProject?->fundSource?->abbreviation),
            // 'amount' => $proposal->unitBudgetCeiling?->total_amount ? number_format($proposal->unitBudgetCeiling->total_amount, 2) : null,
            'proposal_description' => $proposal->proposal_description,
            'proposal_purpose' => $proposal->proposal_purpose,
            'participants_beneficiaries' => $proposal->proposal_participants_beneficiaries,
            'expected_output' => $proposal->proposal_expected_output,
        ];

        $activities = $proposal->activities()->get()->map(function ($activity) {
            return [
                'id' => $activity->id,
                'activity_title' => $activity->activity_title,
                'activity_date_schedule' => $activity->activity_date_schedule,
                'activity_venue' => $activity->activity_venue,
                'show_budgetary' => $activity->activity_title && $activity->activity_date_schedule && $activity->activity_venue,
            ];
        });

        return Inertia::render('User/Proposal/Edit', [
            'proposal' => $proposalData,
            'activities' => $activities,
        ]);
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
            'proposal_description'                   =>      'proposal_description',
            'proposal_purpose'                       =>      'proposal_purpose',
            'participants_beneficiaries'             =>      'proposal_participants_beneficiaries',
            'expected_output'                        =>      'proposal_expected_output',
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

    public function createActivity(Request $request, Proposal $proposal)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'dateRange' => 'nullable|string', // Allow null for dateRange
            'venue' => 'nullable|string|max:255',
        ]);

        // Get the next sequence number
        $activitySequence = $proposal->activities()->count() + 1;

        // Create the activity with default or null values
        $activity = $proposal->activities()->create([
            'activity_sequence' => $activitySequence,
            'activity_title' => $validated['title'], // This can be null
            'activity_date_schedule' => $validated['dateRange'], // This can be null
            'activity_venue' => $validated['venue'], // This can be null
        ]);

        return response()->json(['activity' => $activity, 'message' => 'Activity created successfully.']);
    }

    public function updateActivity(Request $request, Proposal $proposal, $activityId)
    {
        // Validate the request
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'dateRange' => 'nullable|string',
            'venue' => 'nullable|string|max:255',
        ]);

        // Find the activity
        $activity = $proposal->activities()->findOrFail($activityId);

        // Prepare an array to hold the fields to update
        $changes = [];

        // Check which fields are present in the request and add them to the changes array
        if ($request->has('title')) {
            $changes['activity_title'] = $validated['title'];
        }

        if ($request->has('dateRange')) {
            $changes['activity_date_schedule'] = $validated['dateRange'];
        }

        if ($request->has('venue')) {
            $changes['activity_venue'] = $validated['venue'];
        }

        // Update only the fields that are present in the request
        if (!empty($changes)) {
            $activity->update($changes);
        }

        return response()->json(['activity' => $activity, 'message' => 'Activity updated successfully.']);
    }

    public function deleteActivity(Proposal $proposal, $activityId)
    {
        $activity = $proposal->activities()->findOrFail($activityId);
        $activity->delete();
        return response()->json(['message' => 'Activity deleted successfully.']);
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
