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
        $gaa = ProgramActivityProject::with([
            'programActivityProjects' => function ($query) {
                $query->with('programActivityProjects'); // Recursively load children
            },
            'campusBugetCeilings',
            'majorFinalOutput',
            'fundSource'
        ])
        ->whereNull('parent_id') // Start with top-level parents
        ->orderBy('created_at', 'desc')->whereHas('fundSource', function ($query) {
            $query->where('abbreviation', 'GAA'); // Filter by Fund Source name "GAA"
        })->get()->groupBy([
            fn($pap) => $pap->budgetType->name ?? 'budgetType', // Group by Fund Source name
            fn($pap) => $pap->subFund->name ?? 'No Sub Fund',       // Group by Sub Fund name
            fn($pap) => $pap->papType->name ?? 'No PAP Type',       // Group by PAP Type name
        ]);

        $stf = ProgramActivityProject::with([
            'programActivityProjects' => function ($query) {
                $query->with('programActivityProjects'); // Recursively load children
            },
            'campusBugetCeilings',
            'majorFinalOutput',
            'fundSource'
        ])
        // ->whereNull('parent_id') // Start with top-level parents
        ->orderBy('created_at', 'desc')->whereHas('fundSource', function ($query) {
            $query->where('abbreviation', 'STF'); // Filter by Fund Source name "STF"
        })->get()->groupBy([
            fn($pap) => $pap->budgetType->name ?? 'budgetType', // Group by Fund Source name
            fn($pap) => $pap->schoolFeeClassification->name ?? 'No School Fee',       // Group by Sub Fund name
            fn($pap) => $pap->papType->name ?? 'No PAP Type',       // Group by PAP Type name
        ]);

        $fundSources = $this->getAllFundSources();
        $mfos = $this->getAllMFOs();

        if ($request->ajax()) {
            // return $this->renderDataTables($paps, $fundSources, $mfos);
        }
        return view('paps.index', compact('fundSources','mfos', 'gaa', 'stf'));
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
                // return $paps->majorFinalOutput?->abbreviation;
            })
            ->editColumn('name', function($paps) {
                $getAllChildren = function ($program, $level = 0) use (&$getAllChildren) {
                    // Format current item's name with indentation
                    $output = str_repeat('&nbsp;&nbsp;', $level * 2) . $program->id . $program->name . '<br>';
                    
                    // Iterate over children and recursively call the function
                    foreach ($program->programActivityProjects as $child) {
                        $output .= $getAllChildren($child, $level + 1);
                    }
            
                    return $output;
                };
            
                // Start with the parent
                return $getAllChildren($paps);
            })
            ->addColumn('action', function ($paps) use ($fundSources, $mfos) {
                return view('paps.actions.btn', compact('paps', 'fundSources', 'mfos'));
            })
            ->rawColumns(['name'])
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

    // public function getPapsByFundSource($fundSourceId)
    // {
    //     // Query PAPs based on the selected Fund Source and MFO
    //     $paps = ProgramActivityProject::where('fund_source_id', $fundSourceId)
    //                                    ->get();
    //     return response()->json($paps);
    // }

    // public function getPapsByMfo($mfoId)
    // {
    //     // Query PAPs based on the selected Fund Source and MFO
    //     $paps = ProgramActivityProject::where('mfo_id', $mfoId)
    //                                    ->get();
    //     return response()->json($paps);
    // }

    // public function getPapsByFundSourceAndMfo($fundSourceId, $mfoId)
    // {
    //     // Query PAPs based on the selected Fund Source and MFO
    //     $paps = ProgramActivityProject::where('fund_source_id', $fundSourceId)
    //                                    ->where('mfo_id', $mfoId)
    //                                    ->get();
    //     return response()->json($paps);
    // }

    public function getPaps(Request $request)
    {
        $query = ProgramActivityProject::query();

        // Apply filters based on the request
        if ($request->has('fundSourceId')) {
            $query->where('fund_source_id', $request->fundSourceId);
        }

        if ($request->has('mfoId')) {
            $query->where('mfo_id', $request->mfoId);
        }

        $paps = $query->get(['id', 'name']); // Adjust as necessary to fetch needed fields

        return response()->json($paps);
    }


    public function getFundSourceAndMfoByPaps($papId)
    {
        // Find the ProgramActivityProject by papId
        $pap = ProgramActivityProject::with(['fundSource', 'majorFinalOutput'])
                                       ->findOrFail($papId);

        // Return the fund_source_id and mfo_id as a JSON response
        return response()->json([
            'status' => 'success',
            'fund_source_id' => $pap->fund_source_id,
            'mfo_id' => $pap->mfo_id,
        ]);
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
