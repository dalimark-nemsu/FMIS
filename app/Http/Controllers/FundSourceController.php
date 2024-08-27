<?php

namespace App\Http\Controllers;

use App\Http\Requests\FundSourceStoreRequest;
use App\Http\Requests\FundSourceUpdateRequest;
use App\Models\Category;
use App\Models\FundSource;
use Illuminate\Http\Request;

class FundSourceController extends Controller
{
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
        $categories = Category::get();
        $fundSources = FundSource::get();
        return view('fund-sources.index',compact('categories','fundSources'));
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
            'category_id'       =>      $request->category_id,
        ]);
        return redirect()->route('fund-sources.index')->with('success','Fund Source added successfully');
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
            'category_id'       =>      $request->category_id,
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
        $fundSource->delete();
        return redirect()->route('fund-sources.index')->with('success','Fund Source deleted successfully');
    }
}
