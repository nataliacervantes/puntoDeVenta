<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Jobs\ProductImageJob;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {

        $product = Product::create($request->all());

        if($request->image != null || $request->image2 != null || $request->image != null && $request->image2 != null){
            ProductImageJob::dispatch($request->image,$request->image2,$product->id)->onQueue('product-images');
        }
        $images =ProductImage::where('product_id',$product->id)->get();
        return view('product.detail',compact('product','images'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        $images =ProductImage::where('product_id',$id)->get();
        return view('product.detail',compact('product','images'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);

        return view('product.create',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProductRequest $request, $id)
    {
        $product = Product::find($id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->qty = $request->qty;
        $product->save();

        if($request->image != null || $request->image2 != null || $request->image != null && $request->image2 != null){
            ProductImageJob::dispatch($request->image,$request->image2,$product->id)->onQueue('product-images');
        }

        $images =ProductImage::where('product_id',$product->id)->get();

        return view('product.detail',compact('product','images'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return 'success';
    }
}
