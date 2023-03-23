<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    function __construct()
    {
        $this->middleware('admin');
    }
    public function index(Request $request)
    {

        $search = $request->search;
        if ($search != '') {
            $products = Product::where('name', 'like', '%' . $search . '%')->get();

        } else {

            $products = Product::all();
        }
        return view('products.index')->with('productsView', $products);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $prepareProduct = [
            'name' => $request->name,
            'price' => $request->price,
            'user_id' => Auth::id(),

        ];

        if ($request->image) {
            $file = Storage::disk('public')->put('images', $request->image);
            $prepareProduct['image'] = $file;
        }




        $product = Product::create($prepareProduct);

        return redirect()->route('products.index');
        // return Auth::id();
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
        return view('products.edit')->with('product', $product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {

        $file = Storage::disk('public')->put('images', $request->image);
        $prepareProduct = [
            'name' => $request->name,
            'price' => $request->price,
            'user_id' => Auth::id(),
            'image' => $file
        ];

        $productInst = Product::find($product->id);

        if ($productInst->Image && $request->image) {

            unlink('storage/' . $productInst->image);
        }

        $productInst->update($prepareProduct);

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $productInst = Product::find($product->id);

        if ($productInst->Image) {

            unlink('storage/' . $productInst->image);
        }
        $productInst->delete();

        return redirect()->route('products.index');
    }
}
