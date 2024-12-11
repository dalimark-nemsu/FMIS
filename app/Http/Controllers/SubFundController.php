<?php

namespace App\Http\Controllers;

use App\Models\FundSource;
use App\Models\SubFund;
use Illuminate\Http\Request;

class SubFundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subFunds = SubFund::with('fundSource')->get(); 
        $fundSources = FundSource::all(); 
        return view('admin.sub-funds.index', compact('subFunds', 'fundSources'));
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

        SubFund::create($request->all());
        return redirect()->route('sub-funds.index')->with('success', 'SubFund added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubFund  $subFund
     * @return \Illuminate\Http\Response
     */
    public function show(SubFund $subFund)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubFund  $subFund
     * @return \Illuminate\Http\Response
     */
    public function edit(SubFund $subFund)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubFund  $subFund
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubFund $subFund)
    {
        $request->validate([
            'fund_source_id' => 'required|exists:fund_sources,id',
            'name' => 'required|string|max:255',
        ]);

        $subFund->update($request->all());
        return redirect()->route('sub-funds.index')->with('success', 'SubFund updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubFund  $subFund
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubFund $subFund)
    {
        $subFund->delete();
        return redirect()->route('sub-funds.index')->with('success', 'SubFund deleted successfully!');
    }
}
