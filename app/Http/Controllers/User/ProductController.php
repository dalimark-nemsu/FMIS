<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\BudgetaryRequirement;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Check if the request is AJAX for DataTables
        if ($request->ajax()) {
            // Base query
            $products = Product::query()->select(['id', 'photo', 'code', 'product_description', 'uom', 'price']);

            // Apply search filter for description only
            if ($request->has('search') && $request->input('search')) {
                $search = $request->input('search');
                $products->where('product_description', 'like', "%$search%");
            }

            return DataTables::of($products)
                ->addColumn('photo', function ($product) {
                    return '<img src="' . $product->photo . '" alt="Product Image" style="width: 50px; height: 50px; border-radius: 4px;">';
                })
                ->addColumn('action', function ($product) {
                    return '<button class="btn btn-success btn-sm add-to-cart"
                                data-id="' . $product->id . '"
                                data-description="' . $product->description . '"
                                data-price="' . $product->price . '">Add to Cart</button>';
                })
                ->rawColumns(['photo', 'action']) // Allow HTML in these columns
                ->make(true);
        }

        // If not AJAX, return a paginated API response
        $query = Product::query();

        if ($request->has('search') && $request->input('search')) {
            $search = $request->input('search');
            $query->where('product_description', 'like', "%$search%");
        }

        return response()->json($query->paginate(4));
    }

    public function saveCartItems(Request $request, $activityId)
    {
        try {
            // Validate the incoming data
            $validated = $request->validate([
                'cartItems' => 'required|array|min:1',
                'cartItems.*.general_description' => 'required|string|max:255',
                'cartItems.*.uom' => 'required|string|max:50',
                'cartItems.*.quantity' => 'required|integer|min:1',
                'cartItems.*.unit_cost' => 'required|numeric|min:0',
            ]);

            // Loop through the cart items and save each as a BudgetaryRequirement
            foreach ($validated['cartItems'] as $item) {
                BudgetaryRequirement::create([
                    'itemable_type' => 'App\Models\Activity', // Assign the correct polymorphic type
                    'itemable_id' => $activityId,             // The ID of the activity
                    'general_description' => $item['general_description'],
                    'uom' => $item['uom'],
                    'quantity' => $item['quantity'],
                    'unit_cost' => $item['unit_cost'],
                ]);
            }

            // Return success response
            return response()->json([
                'message' => 'Budgetary requirements saved successfully.'
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'error' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to save budgetary requirements.'
            ], 500);
        }
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
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
