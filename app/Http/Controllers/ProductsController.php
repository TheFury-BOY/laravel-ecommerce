<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class ProductsController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        if (request()->category) {
            $products = Product::with('categories')->whereHas('categories', function ($query) {
                //récupére le slug dans l'url
                $query->where('slug', request()->category);
            })->orderBy('created_at', 'DESC')->paginate(6);
        } else {
            $products = Product::with('categories')->orderBy('created_at', 'DESC')->paginate(6);
        }

        return view('products.index')->with('products', $products);
    }


    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    * @param Product slug $slug
    */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        return view('products.show')->with('product', $product);
    }

    public function search()
    {
        request()->validate([
            'search' => 'required|min:4',
        ]);

        $search = request()->input('qry');

        $products = Product::where('title', 'like', "%$search%")
                ->orWhere('description', 'like', "%$search%")
                ->paginate(6);

                return view('products.search')->with('products', $products);
    }
}
