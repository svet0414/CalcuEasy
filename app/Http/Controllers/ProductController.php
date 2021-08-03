<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Validation\Validator as ContractsValidationValidator;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Validator as ValidationValidator;

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
        return view('products')->with('products', $products);
        // $products = Product::latest()->paginate(5);

        //return view('products', compact('products'))
        //->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function fetchProducts(){

            $products=Product::all();
            return response()->json([
                'products'=>$products,
            ]);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $prod = Product::all();
        return view('products')->with('prod', $prod);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $prodID = $request->id;
        // $product   =   Product::updateOrCreate(
        //     ['id' => $prodID],
        //     ['name' => $request->name, 'price' => $request->price]
        // );

        // return Response::json($product);
        //     $storedData =$request->validate([
        //         'name' => 'required|max:255',
        //         'price' => 'required',

        //     ]);
        //     $product = Product::create($storedData);
        //     return redirect('/products')->with('success','Product created!');
        //     //$this->validate($request,[
        //         //'name' => 'required|max:255',
        //         //'price' => 'required',

        //     //]);
        //    // $prod = new Product;
        //     //$prod->name = $request->input('name');
        //     //$prod->price = $request->input('price');
        //     //$prod-> save();
        //     //return redirect('/products')->with('success','Product created!');

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
        ]);
        if($validator->fails()){
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
            ]);

        }
        else{
            $product= new Product;
            $product->name = $request->input('name');
            $product->price = $request->input('price');
            $product->save();
            return response()->json([
                'status'=>200,
                'message'=>'Product Added Successfully'
            ]);
        }
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
    public function editProducts($id)
    {
        $product = Product::find($id);
        if($product){
            return response()->json([
                'status'=>200,
                'product'=>$product,
            ]);
        }
        else{
            return response()->json([
                'status'=>404,
                'message'=>'Product Not Found',
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function updateProducts(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
        ]);
        if($validator->fails()){
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
            ]);

        }
        else{
            $product= Product::find($id);
            if($product){
                $product->name = $request->input('name');
                $product->price = $request->input('price');
                $product->update();
                return response()->json([
                    'status'=>200,
                    'message'=>'Product Updated Successfully'
            ]);
            }
            else{
                return response()->json([
                    'status'=>404,
                    'message'=>'Product Not Found',
                ]);
            }
            $product->name = $request->input('name');
            $product->price = $request->input('price');
            $product->update();
            return response()->json([
                'status'=>200,
                'message'=>'Product Updated Successfully'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function deleteProducts($id)
    {
        $products = Product::find($id);
        $products->delete();
        return response()->json([
            'status'=>200,
            'message'=>'Product Deleted Successfully'
        ]);
    }
}
