<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    public function index()
    {
        $products = Product::join('categories', 'products.category_id', 'categories.id')
        ->select('products.*', 'categories.title as category_title')
        ->where('products.featured', 1)->get();
        return view('home', compact('products'));
    }
}
