<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        $category->load('children');
        $products = $category->products()
            ->where('status', 'published')
            ->paginate(12);

        return view('shop.category', compact('category', 'products'));
    }
}
