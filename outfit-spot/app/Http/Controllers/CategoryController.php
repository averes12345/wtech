<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use function Symfony\Component\Translation\t;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Category $category)
    {
        $products = $category->products;

        dump($products);

        return view('category-page');
    }

    public function byCategory(Category $category)
    {
        $products = $category->products()
            ->with('colorSizeVariants.mainImage')
            ->get();

        $products_sum = $category
            ->products()
            ->withCount('colorSizeVariants')
            ->get();


        dump($products);

        return view('category-page', compact('category','products', 'products_sum'));
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
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
