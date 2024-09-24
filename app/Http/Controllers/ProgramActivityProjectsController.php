<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProgramActivityProjectsStoreRequest;
use App\Http\Requests\ProgramActivityProjectsUpdateRequest;
use App\Models\FundSource;
use App\Models\MajorFinalOutput;
use App\Models\ProgramActivityProject;
use App\Traits\DataRetrievalTrait;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProgramActivityProjectsController extends Controller
{
    use DataRetrievalTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $paps = ProgramActivityProject::with('campusBugetCeilings', 'unitBudgetCeilings', 'majorFinalOutput', 'fundSource')->orderBy('created_at', 'desc')->get();
        $fundSources = $this->getAllFundSources();
        $mfos = $this->getAllMFOs();

        if ($request->ajax()) {
            return $this->renderDataTables($paps, $fundSources, $mfos);
        }
        return view('paps.index', compact('paps','fundSources','mfos'));
    }

    public function renderDataTables($paps, $fundSources, $mfos)
    {
        // $fundSources = FundSource::all();
        // $mfos = MajorFinalOutput::all();

        return DataTables::of($paps)
            ->addIndexColumn()
            ->editColumn('code', function($paps) {
                return $paps->code;
            })
            ->addColumn('fund_source_abbrev', function ($paps) {
                return $paps->fundSource?->abbreviation;
            })
            ->addColumn('mfos_abbrev', function ($paps) {
                return $paps->majorFinalOutput?->abbreviation;
            })
            ->editColumn('name', function($paps) {
                return $paps->name;
            })
            ->addColumn('action', function ($paps) use ($fundSources, $mfos) {
                return view('paps.actions.btn', compact('paps', 'fundSources', 'mfos'));
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
    public function store(ProgramActivityProjectsStoreRequest $request)
    {
        ProgramActivityProject::create([
            'code'              =>      $request->code,
            'fund_source_id'    =>      $request->fund_source_id,
            'mfo_id'            =>      $request->mfo_id,
            'name'              =>      $request->name,
        ]);
        return redirect()->route('paps.index')->with('success','Program Activity Project added successfully');
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
    public function update(ProgramActivityProjectsUpdateRequest $request, ProgramActivityProject $pap)
    {
        $pap->update([
            'code'              =>      $request->code,
            'fund_source_id'    =>      $request->fund_source_id,
            'mfo_id'            =>      $request->mfo_id,
            'name'              =>      $request->name,
        ]);
        return redirect()->route('paps.index')->with('success','Program Activity Project updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProgramActivityProject $pap)
    {
        $name = strtoupper($pap->name);
        $pap->delete();
        return redirect()->route('paps.index')->with('success', "{$name} deleted successfully");
    }
}
