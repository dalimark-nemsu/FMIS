<?php

namespace App\Http\Controllers;

use App\Models\IdentifiedExpense;
use Illuminate\Http\Request;

class IdentifiedExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $identifiedExpenses = IdentifiedExpense::all();
        return view('admin/identified-expenses.index', compact('identifiedExpenses'));
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
            'name' => 'required|string|max:255',
        ]);

        IdentifiedExpense::create($request->all());

        return redirect()->route('identified-expenses.index')->with('success', 'Identified Expense created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IdentifiedExpense  $identifiedExpense
     * @return \Illuminate\Http\Response
     */
    public function show(IdentifiedExpense $identifiedExpense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IdentifiedExpense  $identifiedExpense
     * @return \Illuminate\Http\Response
     */
    public function edit(IdentifiedExpense $identifiedExpense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IdentifiedExpense  $identifiedExpense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IdentifiedExpense $identifiedExpense)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $identifiedExpense->update($request->all());

        return redirect()->route('identified-expenses.index')->with('success', 'Identified Expense updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IdentifiedExpense  $identifiedExpense
     * @return \Illuminate\Http\Response
     */
    public function destroy(IdentifiedExpense $identifiedExpense)
    {
        $identifiedExpense->delete();

        return redirect()->route('identified-expenses.index')->with('success', 'Identified Expense deleted successfully.');
    }
}
