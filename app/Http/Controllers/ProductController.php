<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->query('category');
        $products = Product::query()
            ->when($category && $category !== 'semua', fn($q) => $q->byCategory($category))
            ->inStock()
            ->orderByDesc('created_at')
            ->with('media')
            ->paginate(6);

        $categories = Product::select('category')->distinct()->pluck('category')->toArray();

        if ($request->ajax()) {
            return view('pages.products._list', compact('products'))->render();
        }

        return view('pages.products.index', [
            'products' => $products,
            'categories' => $categories,
            'selectedCategory' => $category ?? 'semua',
        ]);
    }

    public function show(Product $product)
    {
        return view('pages.products.show', compact('product'));
    }
}
