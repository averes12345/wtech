<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ProductColorSize;
use App\Models\Brand;
use App\Models\Color;

class AdminHome extends Controller
{

    public function index(){
        $brands = Brand::all();
        $colors = Color::take(10)->get();
        $products = ProductColorSize::with('product', 'mainImage')->paginate(2);
        /* dd($products); */

        return view('admin-home-page', compact('products', 'brands', 'colors'));
    }
}
