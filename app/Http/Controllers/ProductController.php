<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('products')->with('products',$products);
       // $products = Product::latest()->paginate(5);

        //return view('products', compact('products'))
            //->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $prod = Product::all();
        return view('products')->with('prod',$prod);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $storedData =$request->validate([
            'name' => 'required|max:255',
            'price' => 'required',

        ]);
        $product = Product::create($storedData);
        return redirect('/products')->with('success','Product created!');
        //$this->validate($request,[
            //'name' => 'required|max:255',
            //'price' => 'required',

        //]);
       // $prod = new Product;
        //$prod->name = $request->input('name');
        //$prod->price = $request->input('price');
        //$prod-> save();
        //return redirect('/products')->with('success','Product created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $products = Product::findOrFail($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $storedData =$request->validate([
            'name' => 'required|max:255',
            'price' => 'required',

        ]);
        $product = Product::find($id);
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product-> save();
        return redirect('/products')->with('success','Product updated!');

       // $data = $request->validate([
           // 'name' => 'required|max:255',
            //'price' => 'required',

       // ]);

        //Product::whereId($id)->update($data);
        //return redirect('/products')->with('success', 'Product updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $products = Product::find($id);
        $products->delete();
        return redirect('/products')->with('success','Product deleted!');
    }
}
