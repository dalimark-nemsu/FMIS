<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Fetch all products with their related categories
        $products = Product::with('productCategories')->get();
        $categories = ProductCategory::all(); // Fetch categories for the dropdown
        return view('products.index', compact('products', 'categories'));
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
        $validated = $request->validate([
            'product_code' => 'nullable|string|max:255',
            'product_description' => 'required|string|max:255',
            'uom' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'is_available' => 'required|boolean',
            'source' => 'required|in:dbm,local',
            'product_categories' => 'nullable|array',
            'product_categories.*' => 'exists:product_categories,id',
        ]);

        $product = Product::create($validated);

        // Attach categories to the product
        if (!empty($validated['product_categories'])) {
            $product->productCategories()->attach($validated['product_categories']);
        }

        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'product_code' => 'nullable|string|max:255',
            'product_description' => 'required|string|max:255',
            'uom' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'is_available' => 'required|boolean',
            'source' => 'required|in:dbm,local',
            'product_categories' => 'nullable|array',
            'product_categories.*' => 'exists:product_categories,id',
        ]);

        $product->update($validated);

        // Sync categories with the product
        if (!empty($validated['product_categories'])) {
            $product->productCategories()->sync($validated['product_categories']);
        }

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->productCategories()->detach(); // Detach all categories
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }

    // Import CNAS
    public function importCNAS(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls', // Validate file type
        ]);

        $file = $request->file('file');
        $data = Excel::toArray([], $file);

        // Debug the imported data
        // dd($data);


        if (empty($data[0])) {
            return redirect()->back()->withErrors(['file' => 'The uploaded file is empty.']);
        }

        $rows = $data[0];
        $headerIndex = null;

        // Find the header row
        foreach ($rows as $index => $row) {
            if (isset($row[0]) && strtolower(trim($row[0])) === 'product code') {
                $headerIndex = $index;
                break;
            }
        }

        // If no header row is found, return an error
        if ($headerIndex === null) {
            return redirect()->back()->withErrors(['file' => 'Invalid file format. Header row not found.']);
        }

        // Initialize counters for processed rows
        $processedCount = 0;

        // Process rows after the header
        for ($i = $headerIndex + 1; $i < count($rows); $i++) {
            $row = $rows[$i];
            $productCode = $row[0] ?? null;

            // Skip rows without a valid product code
            if (!$productCode) {
                continue;
            }

            // Check if the product exists
            $product = Product::where('product_code', $productCode)->first();

            if ($product) {
                // Update availability to false
                $product->update(['is_available' => false]);
                $processedCount++;
            }
        }

        return redirect()->back()->with('success', "{$processedCount} CNAS products updated successfully!");
    }


    //Import CSE
    public function importCSE(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls', // Validate file type
        ]);

        $file = $request->file('file');
        $data = Excel::toArray([], $file);

        // Debug the imported data
        // dd($data);

        if (empty($data[0])) {
            return redirect()->back()->withErrors(['file' => 'The uploaded file is empty.']);
        }

        $rows = $data[0];
        $headerIndex = null;

        // Find the header row
        foreach ($rows as $index => $row) {
            if (isset($row[0]) && strtolower(trim($row[0])) === 'product code') {
                $headerIndex = $index;
                break;
            }
        }

        // If no header row is found, return an error
        if ($headerIndex === null) {
            return redirect()->back()->withErrors(['file' => 'Invalid file format. Header row not found.']);
        }

        // Initialize counters
        $addedCount = 0;
        $updatedCount = 0;

        // Process rows after the header
        for ($i = $headerIndex + 1; $i < count($rows); $i++) {
            $row = $rows[$i];
            $productCode = $row[0] ?? null;
            $description = $row[1] ?? null;
            $uom = $row[2] ?? 'N/A'; // Default to 'N/A' if UOM is missing
            $price = $row[3] ?? 0;
            $quantity = $row[4] ?? 0;
            $remarks = $row[5] ?? null;

            // Skip rows without a valid product code
            if (!$productCode) {
                continue;
            }

            // Check if the product exists
            $product = Product::where('product_code', $productCode)->first();

            if ($product) {
                // Update existing product
                $product->update([
                    'product_description' => $description ?? $product->product_description,
                    'uom' => $uom ?? $product->uom,
                    'price' => $price ?? $product->price,
                    'is_available' => $quantity > 0, // Determine availability based on quantity
                    'remarks' => $remarks ?? $product->remarks,
                ]);
                $updatedCount++;
            } else {
                // Save new product
                Product::create([
                    'product_code' => $productCode,
                    'product_description' => $description,
                    'uom' => $uom,
                    'price' => $price,
                    'is_available' => $quantity > 0,
                    'remarks' => $remarks,
                    'source' => 'dbm',
                ]);
                $addedCount++;
            }
        }

        return redirect()->back()->with('success', "{$updatedCount} products updated and {$addedCount} new products added successfully!");
    }





}
