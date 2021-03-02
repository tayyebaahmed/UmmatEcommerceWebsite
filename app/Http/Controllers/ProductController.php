<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\Unit;
use App\Cart;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image as Image;
use Auth; 
use Session;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::paginate(5);
        return view('admin.products.index', compact('products'));
    }
   
    public function create()
    {
        $categories = Category::all();
        $units = Unit::all();

        return view('admin.products.create', compact('products', 'categories', 'units'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:4',
            'description' => 'required|min:4',
            'price' => 'required|numeric',
            'photo' => 'mimes:jpg,jpeg',
        ]);
         
        $product = new Product();
        $product->title = $request->input('title');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->discount = $request->input('discount'); 
        $product->unit_id = $request->input('unit_id');
        $product->category_id = $request->input('category_id'); 

        //Image insert.
        // if(!empty($request->file('thumbnail')))
        // {
        //     $originalImage= $request->file('thumbnail');
        //     $savedFileName = $product->title.'.'.$originalImage->getClientOriginalExtension();
        //     $image = Image::make($originalImage);
        //     $originalPath =  storage_path().'/app/public/products/';
        //     $image->resize(512,512);
        //     $image->save($originalPath.$savedFileName);
        //     $product->photo = $savedFileName; 
        // }

        $product->updated_by = Auth::user()->email;
        $product->save();

        //$products = Product::create($request->only('title', 'description', 'discount', 'price'));
        return back()->with('message', 'Product Added Successfully!');
    }

    public function edit($id)
    {
        $categories = Category::all();
        $units = Unit::all();
        $product = Product::find($id);
        return view('admin.products.edit', compact('product', 'categories', 'units'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|min:4',
            'description' => 'required|min:4',
            'price' => 'required|numeric',
            'photo' => 'mimes:jpg,jpeg',
          ]);
    
        $product = Product::find($id);
        $product->title = $request->get('title');
        $product->description = $request->get('description');
        $product->price = $request->get('price');
        $product->discount = $request->get('discount');
        $product->category_id = $request->get('category_id'); 
        $product->unit_id = $request->get('unit_id');
        
        // if(!empty($request->file('thumbnail')))
        // {
        //     $oldImage = storage_path().'/app/public/products/'.$product->photo; // get previous image from folder
        //     if($product->photo)
        //     {
        //         if (File::exists($oldImage))  // unlink or remove previous image from folder
        //         {
        //             unlink($oldImage);
        //         }
        //     }
        //     $originalImage= $request->file('thumbnail');
        //     $savedFileName = $product->title.'.'.$originalImage->getClientOriginalExtension();
        //     $image = Image::make($originalImage);
        //     $originalPath =  storage_path().'/app/public/products/';
        //     $image->resize(512,512);
        //     $image->save($originalPath.$savedFileName);
        //     $product->photo = $savedFileName;
        // }

        $product->updated_by = Auth::user()->email;
        $product->save();
    
        return back()->with('message', 'Product has been updated');
    }

    public function show($id)
    {
       $product = Product::join('categories', 'products.category_id', 'categories.id')
        ->select('products.*', 'categories.title as category_title')
        ->where('products.id', $id)->first();
        return view('admin.products.show')->with('product', $product);
    }

    public function recoverProduct($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        if($product->restore())
            return back()->with('message','Product Successfully Restored!');
        else
            return back()->with('message','Error Restoring Category');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if($product->delete()){
            return redirect('/admin/product')->with('message','Product Successfully Trashed!');
        }else{
            return redirect('/admin/product')->with('message','Error Deleting Record');
        }
    }

    public function trash()
    {
        $products = Product::onlyTrashed()->paginate(3);
        return view('admin.products.index', compact('products'));
    }

    public function productShow($id)
    {
        $product = Product::join('categories', 'products.category_id', 'categories.id')
        ->select('products.*', 'categories.title as category_title')
        ->where('products.id', $id)->first();
        return view('products.productShow', compact('product'));
    }

    public function allList()
    {
        $products = Product::join('categories', 'products.category_id', 'categories.id')
        ->select('products.*', 'categories.title as category_title')->get();
        return view('layouts.partials.allList', compact('products'));
    }

    public function featuredList()
    {
        $products = Product::join('categories', 'products.category_id', 'categories.id')
        ->select('products.*', 'categories.title as category_title')
        ->where('products.featured', 1)->get();
        return view('layouts.partials.featuredList', compact('products'));
    }

    public function getAddToCart(Request $request, $id){
        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);

        $request->session()->put('cart', $cart);
        return redirect()->back();
    }

    public function getCart() {
        if (!Session::has('cart')) {
            return view('products.shopping-cart', ['products' => null]);
        }
        $oldCart = Session::get('cart');
        $cart  = new Cart($oldCart);
        return view('products.shopping-cart',['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }

    public function getCheckout() {
        if (!Session::has('cart')) {
            return view('products.shopping-cart', ['products' => null]);
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrice;
        return view('layouts.partials.checkout', ['total' => $total]);
    }

    public function postCheckout(Request $request) {
        if (!Session::has('cart')) {
            return redirect()->back();
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        Stripe::setApiKey('pk_test_jO5UFi2UpL4Guj2OV8YXQmu600nrAkiWSf');
        try {
            $charges = Charge::create(array(
                "amount" => $cart->totalPrice * 100,
                "currency" => "inr",
                "source" => $request->input('stripeToken'),
                "description" => "Test Charges"
            ));
            $order = new Order();
            $order->cart = serialize($cart);
            $order->address = $request->input('address');
            $order->name = $request->input('name');
            $order->payment_id = $charges->id;
            Auth::user()->orders()->save($order);
        } catch (\Exception $e) {
            return redirect()->route('checkout')->with('error', $e->getMessage());
        }
        Session::forget('cart');
        return redirect()->back()->with('success','Successfully purchased products!');
    }
    public function deductByOne($id) {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->deductByOne($id);
        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }
        return redirect()->back();
    }
    public function removeItem($id){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }
        return redirect()->back();
    }
}
