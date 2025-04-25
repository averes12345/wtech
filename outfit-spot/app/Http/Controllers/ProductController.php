<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductColorSize;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product, string $currentVariantId)
    {
        $category = $product->category;
        $brand = $product->brand;
        $allVariants = $product->colorSizeVariants;
        $currentVariant = $allVariants->firstWhere('id', $currentVariantId);
        $currentVariant->mainImage = $currentVariant->mainImage ?? $currentVariant->images->first();

        $colors = $allVariants
            ->map->color
            ->unique('id')
            ->values();

        $sizes = $allVariants
            ->map->size
            ->unique('id')
            ->values();

        return view('product-page', compact('product', 'category', 'brand', 'colors', 'sizes', 'currentVariant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
