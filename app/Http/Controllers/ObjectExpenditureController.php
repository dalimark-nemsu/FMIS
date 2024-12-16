<?php

namespace App\Http\Controllers;

use App\Models\AllotmentClass;
use App\Models\ObjectExpenditure;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ObjectExpenditureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $objectExpenditures = ObjectExpenditure::with('allotmentClass')->orderBy('created_at', 'desc')->get();
        $allotmentClasses = AllotmentClass::get(); 
        dd($objectExpenditures->toJson());
        if ($request->ajax()) {
            return $this->renderDataTables($objectExpenditures, $allotmentClasses);
        }
        
        return view('object-expenditures.index', compact('objectExpenditures', 'allotmentClasses'));
    }

    public function renderDataTables($objectExpenditures, $allotmentClasses)
    {
     
        return DataTables::of($objectExpenditures)
            ->addIndexColumn()
            ->editColumn('code', function($objectExpenditure) {
                return $objectExpenditure->uacs_code;
            })
            ->addColumn('allotment_class_abbrev', function ($objectExpenditure) {
                return $objectExpenditure->allotmentClass->abbreviation;
            })
            ->editColumn('name', function($objectExpenditure) {
                return $objectExpenditure->short_description;
            })
            ->addColumn('is_applicable_to_regular_operating_exp', function ($objectExpenditure) {
                return $objectExpenditure->is_applicable_to_regular_operating_exp ? 'Yes' : 'No';
            })
            ->addColumn('status', function($objectExpenditure) {
                return $objectExpenditure->is_active ? 'Active' : 'Inactive'; 
            })
            ->addColumn('action', function ($objectExpenditure) use ($allotmentClasses) {
                return view('object-expenditures.actions.btn', compact('objectExpenditure', 'allotmentClasses'));
            })
            
        ->toJson();

        
           
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
        // Normalize the `is_active` checkbox value
        $request->merge([
            'is_applicable_to_regular_operating_exp' => $request->has('is_applicable_to_regular_operating_exp'),
            'is_active' => $request->has('is_active'),
        ]);
    
        // Validate incoming request data
        $validatedData = $request->validate([
            'uacs_code' => 'required|string|max:255',
            'allotment_class_id' => 'required|exists:allotment_classes,id',
            'short_description' => 'required|string|max:255',
            'is_applicable_to_regular_operating_exp' => 'boolean',
            'is_active' => 'boolean', // Validates as true/false
        ]);
    
        // Create the Object Expenditure
        ObjectExpenditure::create($validatedData);
    
        // Redirect with success message
        return redirect()->route('object-expenditures.index')->with('success', 'Object Expenditure added successfully.');
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

     public function update(Request $request, ObjectExpenditure $objectExpenditure)
     {
         // Normalize the `is_active` checkbox value
         $request->merge([
             'is_applicable_to_regular_operating_exp' => $request->has('is_applicable_to_regular_operating_exp'),
             'is_active' => $request->has('is_active'),
         ]);
     
         // Validate the incoming request data
         $validatedData = $request->validate([
             'uacs_code' => 'required|string|max:255',
             'allotment_class_id' => 'required|exists:allotment_classes,id',
             'short_description' => 'required|string|max:255',
             'is_applicable_to_regular_operating_exp' => 'boolean',
             'is_active' => 'boolean',
         ]);
     
         // Update the Object Expenditure
         $objectExpenditure->update($validatedData);
     
         // Redirect back with a success message
         return redirect()->route('object-expenditures.index')->with('success', 'Object Expenditure updated successfully.');
     }
     
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ObjectExpenditure $objectExpenditure)
    {
             // Soft delete the object expenditure
             $objectExpenditure->delete();

             return redirect()->route('object-expenditures.index')->with('success', 'Object Expenditure deleted successfully.');
     
    }
}
