<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Brand;

class BrandController extends Controller
{
    public function show(Brand $brand)
    {
        $products = $brand->products()
            ->where('status', 'published')
            ->paginate(12);

        return view('shop.brand', compact('brand', 'products'));
    }
}
