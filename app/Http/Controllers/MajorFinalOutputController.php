<?php

namespace App\Http\Controllers;

use App\Http\Requests\MajorFinalOutputStoreRequest;
use App\Http\Requests\MajorFinalOutputUpdateRequest;
use App\Models\MajorFinalOutput;
use App\Traits\DataRetrievalTrait;
use Illuminate\Http\Request;

class MajorFinalOutputController extends Controller
{
    use DataRetrievalTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mfos = $this->getAllMFOs();
        return view('mfos.index', compact('mfos'));
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
    public function store(MajorFinalOutputStoreRequest $request)
    {
        MajorFinalOutput::create([
            'abbreviation'      =>      $request->abbrev,
            'name'              =>      $request->name,
        ]);
        return redirect()->route('mfos.index')->with('success','Major Final Output added successfully');
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
    public function update(MajorFinalOutputUpdateRequest $request, MajorFinalOutput $mfo)
    {
        $mfo->update([
            'abbreviation'      =>      $request->abbrev,
            'name'              =>      $request->name,
        ]);
        return redirect()->route('mfos.index')->with('success','Major Final Output updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(MajorFinalOutput $mfo)
    {
        $name = strtoupper($mfo->name);
        $mfo->delete();
        return redirect()->route('mfos.index')->with('success',"{$name} deleted successfully");
    }
}
