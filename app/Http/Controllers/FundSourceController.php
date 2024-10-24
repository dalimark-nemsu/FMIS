<?php

namespace App\Http\Controllers;

use App\Http\Requests\FundSourceStoreRequest;
use App\Http\Requests\FundSourceUpdateRequest;
use App\Models\FundSource;
use App\Traits\DataRetrievalTrait;
use Illuminate\Http\Request;

class FundSourceController extends Controller
{
    use DataRetrievalTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
        $fundSources = $this->getAllFundSources();
        return view('fund-sources.index',compact('fundSources'));
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
    public function store(FundSourceStoreRequest $request)
    {
        FundSource::create([
            'abbreviation'      =>      $request->abbrev,
            'name'              =>      $request->name,
        ]);
        return redirect()->route('allotment-classes.index')->with('success','Allotment Class added successfully');
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
    public function update(FundSourceUpdateRequest $request, FundSource $fundSource)
    {
        $fundSource->update([
            'abbreviation'      =>      $request->abbrev,
            'name'              =>      $request->name,
        ]);
        return redirect()->route('fund-sources.index')->with('success','Fund Source updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(FundSource $fundSource)
    {
        $name = strtoupper($fundSource->name);
        $fundSource->delete();
        return redirect()->route('fund-sources.index')->with('success', "{$name} deleted successfully");
    }
}
