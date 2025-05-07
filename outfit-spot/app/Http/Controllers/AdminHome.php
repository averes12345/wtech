<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

use App\Models\ProductColorSize;
use App\Models\Brand;
use App\Models\Color;

class AdminHome extends Controller
{

    public function index(Request $request){
        /* dump($request->all()); */
        $brands = Brand::all();
        $colors = Color::take(10)->get();
        $query = ProductColorSize::selectRaw('MIN(id) as id, products_id, colors_id')
            ->groupBy('products_id', 'colors_id')
            ->with('product', 'mainImage');

        $query->when($request->filled('search'), function ($query) use ($request) {
            $query->whereHas('product', function ($q) use ($request) {
                $q->where('name', 'ILIKE', '%' . $request->search . '%')
                  ->orWhere('description', 'ILIKE', '%' . $request->search . '%');
            });
        });

        $query->when($request->has('brands'), function ($query) use ($request) {
            $query->whereHas('product', function ($q) use ($request) {
                $q->whereIn('brand_id', $request->input('brands'));
            });
        });
        $query->when($request->has('colors'), function ($query) use ($request) {
            $query->whereIn('colors_id', $request->input('colors'));
        });
        $query->when($request->filled('min_price'), function ($query) use ($request) {
            $query->whereHas('product', function ($q) use ($request) {
                $q->where('price', '>=', $request->input('min_price'));
            });
        });
        $query->when($request->filled('max_price'), function ($query) use ($request) {
            $query->whereHas('product', function ($q) use ($request) {
                $q->where('price', '<=', $request->input('max_price'));
            });
        });

        /* $products = ProductColorSize::with('product', 'mainImage')->paginate(60); */
        $products = $query->paginate(60)->appends($request->query());
        /* dd($products); */

        return view('admin-home-page', compact('products', 'brands', 'colors'));
    }

    public function delete($id){
        DB::transaction(function () use ($id){
            $specificProduct = ProductColorSize::findOrFail($id);

            $specificProducts = ProductColorSize::where('products_id', $specificProduct->products_id)
                ->where('colors_id', $specificProduct->colors_id)
                ->get();

            $imagePaths = $specificProduct->images->pluck('image_path')
                ->map(function ($path) {
                    $cleanPath = ltrim(preg_replace('#^(\.\./)+#', '', $path), '/');
                    return public_path($cleanPath);
                })
                ->toArray();
            $specificProducts->each->delete();
            foreach ($imagePaths as $path) {
                if(file_exists($path)){
                    if(unlink($path)){
                        Log::info("Image : \"$path\" deleted.");
                    } else{
                        Log::warning("Could not delete image at: \"$path\" .");
                    }
                } else{
                    Log::warning("Image not found at: \"$path\" .");
                }
            }
        });
        return redirect()->back();
    }
}
