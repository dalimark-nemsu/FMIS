<?php

namespace App\Http\Controllers;

use App\Http\Requests\BudgetYearStoreRequest;
use App\Http\Requests\BudgetYearUpdateRequest;
use App\Models\BudgetYear;
use Illuminate\Http\Request;

class BudgetYearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $budgetYears = BudgetYear::latest()->get();
        return view('budget-year.index',compact('budgetYears'));
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
    public function store(BudgetYearStoreRequest $request)
    {
        // Check if the status is 'active'
        if ($request->status === 'active') {
            // Deactivate all other active budget years
            BudgetYear::where('is_active', 1)->update(['is_active' => 0]);
        }

        // Create the new budget year
        BudgetYear::create([
            'year'          =>      $request->year,
            'is_active'     =>      $request->status === 'active' ? 1 : 0,
        ]);

        return redirect()->route('budget-year.index')->with('success', 'Budget year added successfully');
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
    public function update(BudgetYearUpdateRequest $request, BudgetYear $budgetYear)
    {
        // Check if the status is 'active'
        if ($request->status === 'active') {
            // Deactivate all other active budget years
            BudgetYear::where('is_active', 1)->update(['is_active' => 0]);
        }
        $budgetYear->update([
            'year'          =>      $request->year,
            'is_active'     =>      $request->status === 'active' ? 1 : 0,
        ]);
        return redirect()->route('budget-year.index')->with('success', 'Budget year updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(BudgetYear $budgetYear)
    {
        $budgetYear->delete();
        return redirect()->route('budget-year.index')->with('success', 'Budget year deleted successfully');
    }
}
