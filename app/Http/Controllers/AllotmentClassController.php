<?php

namespace App\Http\Controllers;

use App\Models\AllotmentClass;
use Illuminate\Http\Request;

class AllotmentClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allotmentClasses = AllotmentClass::get();
        return view('allotment-classes.index',compact('allotmentClasses'));
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

          // Validate input
          $request->validate([
            'abbrev' => 'required|string|max:10',
            'name' => 'required|string|max:100',
        ]);

        // Create new allotment class
        AllotmentClass::create([
            'abbreviation' => $request->abbrev,
            'name' => $request->name,
        ]);

        return redirect()->route('allotment-classes.index')->with('success', 'Allotment Class created successfully.');


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
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AllotmentClass $allotmentClass)
    {
          // Validate input
          $request->validate([
            'abbrev' => 'required|string|max:10',
            'name' => 'required|string|max:100',
        ]);

        // Update the allotment class
        $allotmentClass->update([
            'abbreviation' => $request->abbrev,
            'name' => $request->name,
        ]);

        return redirect()->route('allotment-classes.index')->with('success', 'Allotment Class updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(AllotmentClass $allotmentClass)
    {
           // Soft delete the allotment class
           $allotmentClass->delete();

           return redirect()->route('allotment-classes.index')->with('success', 'Allotment Class deleted successfully.');
   
    }
}
