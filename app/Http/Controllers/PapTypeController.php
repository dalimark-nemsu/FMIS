<?php

namespace App\Http\Controllers;

use App\Models\PapType;
use Illuminate\Http\Request;

class PapTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $papTypes = PapType::all();
        return view('admin.pap-types.index', compact('papTypes'));
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
            'abbreviation' => 'required|string|max:255',
            'name' => 'required|string|max:255',
        ]);

        PapType::create($request->all());
        return redirect()->route('pap-types.index')->with('success', 'PAP Type added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PapType  $papType
     * @return \Illuminate\Http\Response
     */
    public function show(PapType $papType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PapType  $papType
     * @return \Illuminate\Http\Response
     */
    public function edit(PapType $papType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PapType  $papType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PapType $papType)
    {
        $request->validate([
            'abbreviation' => 'required|string|max:255',
            'name' => 'required|string|max:255',
        ]);

        $papType->update($request->all());
        return redirect()->route('pap-types.index')->with('success', 'PAP Type updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PapType  $papType
     * @return \Illuminate\Http\Response
     */
    public function destroy(PapType $papType)
    {
        $papType->delete();
        return redirect()->route('pap-types.index')->with('success', 'PAP Type deleted successfully!');
    }
    
}
