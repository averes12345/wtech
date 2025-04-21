<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
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

    public function byCategory(Category $category, Request $request)
    {

        $query = $category
            ->products()
            ->with('colorSizeVariants.mainImage');

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('brands')) {
            $query->whereIn('brand_id', $request->brands);
        }

        if ($request->filled('min_price')) {
            $query->where('price','>=',$request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price','<=',$request->max_price);
        }

        $query->with(['colorSizeVariants' => function($q) use($request) {
            if (request()->filled('colors')) {
                $q->whereIn('colors_id', request('colors'));
            }
            $q->with('mainImage');
        }]);

        $products = $query->get()
            ->map(function($product) {
                $product->uniqueVariants = $product
                    ->colorSizeVariants
                    ->unique('colors_id')
                    ->values();
                return $product;
            });

        $brands = Brand::all();
        $colors = Color::take(10)->get();

        return view('category-page', compact('category','products', 'brands', 'colors'));
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
