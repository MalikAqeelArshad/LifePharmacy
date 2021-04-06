<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('products.index', [
            'products' => Product::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return request()->all();
        $this->validate($request, [
            'title' => 'required|string|min:3|unique:products',
            'price' => 'required|numeric|gt:0',
        ]);

        if ($request->hasFile('logo')) {
            $this->validate($request, [
                'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $image = $request->file('logo');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/upload');
            $image->move($destinationPath, $name);
            // $this->save();
            $request['thumbnail'] = $name;
            $image_path = public_path('upload/'.$product->thumbnail);
            if(file_exists($image_path)) {
            	@unlink($image_path);
            }
        }

        auth()->user()->products()->create($request->all());

        session()->flash('success', "New product added successfully.");
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return 'show';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        // return request()->all();
        $this->validate($request, [
            'title' => 'required|string|min:3|unique:products,id,'.$product->id,
            'price' => 'required|numeric|gt:0',
        ]);

        if ($request->hasFile('logo')) {
            $this->validate($request, [
                'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $image = $request->file('logo');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/upload');
            $image->move($destinationPath, $name);
            // $this->save();
            $request['thumbnail'] = $name;
        }
        
        $product->update($request->all());
        session()->flash('success', "Product has been updated successfully.");
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $image_path = public_path('upload/'.$product->thumbnail);
        if(file_exists($image_path)) {
            @unlink($image_path);
        }
        $product->delete();
        session()->flash('success', "Product has been deleted successfully.");
        return redirect()->route('products.index');
    }
}
