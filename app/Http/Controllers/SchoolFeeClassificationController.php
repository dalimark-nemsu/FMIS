<?php

namespace App\Http\Controllers;

use App\Models\FundSource;
use App\Models\SchoolFeeClassification;
use Illuminate\Http\Request;

class SchoolFeeClassificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schoolFeeClassifications = SchoolFeeClassification::with('fundSource')->get();
        $fundSources = FundSource::all();

        return view('admin.school-fee-classifications.index', compact('schoolFeeClassifications', 'fundSources'));
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

        SchoolFeeClassification::create($request->all());

        return redirect()->route('school-fee-classifications.index')->with('success', 'School Fee Classification added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SchoolFeeClassification  $schoolFeeClassification
     * @return \Illuminate\Http\Response
     */
    public function show(SchoolFeeClassification $schoolFeeClassification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SchoolFeeClassification  $schoolFeeClassification
     * @return \Illuminate\Http\Response
     */
    public function edit(SchoolFeeClassification $schoolFeeClassification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SchoolFeeClassification  $schoolFeeClassification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SchoolFeeClassification $schoolFeeClassification)
    {
        $request->validate([
            'fund_source_id' => 'required|exists:fund_sources,id',
            'name' => 'required|string|max:255',
        ]);

        $schoolFeeClassification->update($request->all());

        return redirect()->route('school-fee-classifications.index')->with('success', 'School Fee Classification updated successfully!');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SchoolFeeClassification  $schoolFeeClassification
     * @return \Illuminate\Http\Response
     */
    public function destroy(SchoolFeeClassification $schoolFeeClassification)
    {
        $schoolFeeClassification->delete();

        return redirect()->route('school-fee-classifications.index')->with('success', 'School Fee Classification deleted successfully!');
    }
    
}
