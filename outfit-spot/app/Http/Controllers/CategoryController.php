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

        if ($request->filled('colors')) {
            $query->whereHas('colorSizeVariants', function($q) use ($request) {
                $q->whereIn('colors_id', $request->colors);
            });
        }

        $products = $query
            ->paginate(9)
            ->withQueryString();

        $products->getCollection()->transform(function($product) {
            if (request()->filled('colors')) {
                $variant = $product->colorSizeVariants
                    ->whereIn('colors_id', request('colors'))
                    ->first();
            } else{
                $variant = $product->colorSizeVariants->first();
            }

            $product->mainImage = $variant
                ? $variant->mainImage
                : null;

            $product->variant = $variant;

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
