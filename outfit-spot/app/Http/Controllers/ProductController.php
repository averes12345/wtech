<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductColorSize;
use App\Models\ProductImage;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

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
        $categories = Category::all();
        $brands = Brand::all();
        $colors = Color::all();
        $sizes = Size::all();

        return view('admin-addProduct-page', compact('categories', 'brands', 'colors', 'sizes'));
    }

    public function uploadImage(Request $request)
    {
//        // Validácia prijatých súborov
//        $request->validate([
//            'images.*' => 'required|image|mimes:jpg,jpeg,png|max:2048'
//        ]);

//        $urls = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                // Generuj unikátny názov súboru
                $filename = $file->getClientOriginalName();
                $file->move(public_path('img'), $filename);
                $path = 'img/' . $filename;
            }
        }

        return response()->json([
            'path' => $path
        ]);
    }


/**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = $request->input('category');
        $type = $request->input('type');
        $name = $request->input('name');
        $description = $request->input('description');
        $price = $request->input('price');
        $quantity = $request->input('quantity');
        $brand = $request->input('brand');
        $color = $request->input('color');
        $sizes = $request->input('size', []);
        $imagesInput = $request->input('images', '[]');

        $paths = is_string($imagesInput)
            ? json_decode($imagesInput, true)
            : Arr::wrap($imagesInput);

        $productData = [
            'category_id' => $category,
            'type' => $type,
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'brand_id' => $brand,
        ];

        $product = Product::create($productData);

        $variantIds = [];
        foreach ($sizes as $size) {
            $variant = $product->colorSizeVariants()->create([
                'colors_id' => $color,
                'sizes_id' => $size,
                'count_in_stock' => $quantity,
                'status' => 'in_stock',
            ]);
            $variantIds[] = $variant->id;
        }

        foreach ($variantIds as $variantId) {
            foreach ($paths as $index => $path) {
                ProductImage::create([
                    'product_color_sizes_id' => $variantId,
                    'image_path' => $path,
                    'alt' => 'An image of a product.',
                    'is_main' => ($index === 0),
                ]);
            }
        }



        return response()->noContent();
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product, string $currentVariantId)
    {
        $category = $product->category;
        $brand = $product->brand;

        $allVariants = $product->colorSizeVariants;
        $currentVariant = ProductColorSize::where('id', $currentVariantId)->first();
        $currentVariant->mainImage = $currentVariant->mainImage ?? $currentVariant->images->first();

        $sizes = $allVariants
            ->where('colors_id', $currentVariant->colors_id)
            ->values();

        return view('product-page', compact('product', 'category', 'brand', 'allVariants', 'sizes', 'currentVariant'));
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
