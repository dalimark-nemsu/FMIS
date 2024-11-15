<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Proposal;
use App\Models\UnitBudgetCeiling;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

use function PHPSTORM_META\type;

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
        return Inertia::render('User/Proposal/Edit');
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
        //
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
