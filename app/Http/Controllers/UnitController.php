<?php

namespace App\Http\Controllers;

use App\Http\Requests\UnitStoreRequest;
use App\Http\Requests\UnitUpdateRequest;
use App\Models\Campus;
use App\Models\MajorFinalOutput;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user(); // Get authenticated user
        // Check if the user has the role 'budget-officer-ii'
        if ($user->hasRole('budget-officer-ii')) {
            // Assuming the user has a campus_id field to determine the campus they belong to
            $campuses = Campus::where('id', $user->unit?->campus_id)->get();
            // Filter units by the campus that the user belongs to
            $units = Unit::where('campus_id', $user->unit?->campus_id)->get();
        } else {
            // Otherwise, get all campuses and units
            $campuses = Campus::get();
            $units = Unit::get();
        }
    
        $mfos = MajorFinalOutput::all(); // Fetch all MFOS (no need to filter unless necessary)
    
        return view('units.index', compact('campuses', 'units', 'mfos'));
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
    public function store(UnitStoreRequest $request)
    {
        Unit::create([
            'abbreviation'      =>      $request->abbrev,
            'name'              =>      $request->name,
            'campus_id'         =>      $request->campus_id,
        ]);
        return redirect()->route('units.index')->with('success','Unit added successfully');
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
    public function update(UnitUpdateRequest $request, Unit $unit)
    {
        $unit->update([
            'abbreviation'      =>      $request->abbrev,
            'name'              =>      $request->name,
            'campus_id'         =>      $request->campus_id,
        ]);
        return redirect()->route('units.index')->with('success','Unit updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unit $unit)
    {
        $name = strtoupper($unit->name);
        $unit->delete();
        return redirect()->route('units.index')->with('success', "{$name} deleted successfully");
    }

    public function assignMfo(Request $request, $id)
    {
        $unit = Unit::findOrFail($id);

        // Validate that at least one MFO is selected
        $request->validate([
            'mfos' => 'required|array',
        ]);


        // Sync the selected MFOs with the unit
        $unit->majorFinalOutputs()->sync($request->mfos);

        return redirect()->back()->with('success', 'MFOs assigned successfully!');
    }


}
