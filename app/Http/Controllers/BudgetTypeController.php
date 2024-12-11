<?php

namespace App\Http\Controllers;

use App\Models\BudgetType;
use App\Models\FundSource;
use Illuminate\Http\Request;

class BudgetTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $budgetTypes = BudgetType::with('fundSource')->get();
        $fundSources = FundSource::all();
        // dd($budgetTypes, $fundSources);
        return view('admin.budget-types.index', compact('budgetTypes', 'fundSources'));
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
    public function store(Request $request)
    {
        $request->validate([
            'fund_source_id' => 'required|exists:fund_sources,id',
            'name' => 'required|string|max:255',
        ]);

        BudgetType::create($request->all());
        return redirect()->route('budget-types.index')->with('success', 'Budget Type added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BudgetType  $budgetType
     * @return \Illuminate\Http\Response
     */
    public function show(BudgetType $budgetType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BudgetType  $budgetType
     * @return \Illuminate\Http\Response
     */
    public function edit(BudgetType $budgetType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BudgetType  $budgetType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BudgetType $budgetType)
    {
        $request->validate([
            'fund_source_id' => 'required|exists:fund_sources,id',
            'name' => 'required|string|max:255',
        ]);

        $budgetType->update($request->all());
        return redirect()->route('budget-types.index')->with('success', 'Budget Type updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BudgetType  $budgetType
     * @return \Illuminate\Http\Response
     */
    public function destroy(BudgetType $budgetType)
    {
        $budgetType->delete();
        return redirect()->route('budget-types.index')->with('success', 'Budget Type deleted successfully!');
    }
}
