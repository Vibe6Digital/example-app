<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->get();
        return view('products.index', ['products' => $products]);
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'required|string|max:255',
            'sku' => 'required|string|max:255|unique:products,sku',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:Active,Inactive',
        ]);


        if ($validator->fails()) {
            return redirect(route('products.create'))->withErrors($validator)->withInput();
        }

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->category = $request->category;
        $product->sku = $request->sku;
        $product->status = $request->status;
        $product->save();

        // Handle image upload
        if ($request->hasFile('image')) {

            $imagePath = $request->image;

            $imageName = $product->name . '-' . time() . '.' . $imagePath->getClientOriginalExtension(); // productName-1698765432.jpg
            $imagePath->move(public_path('uploads/products'), $imageName);
            // Save the image name to the database
            $product->image = $imageName;
            $product->save();
        }
        return redirect(route('products.create'))->with('success', 'Product Added successfully.');
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
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('products.edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {
        $product = Product::findOrFail($id);
        $oldimg = $product->image;

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'required|string|max:255',
            'sku' => 'required|string|max:255|unique:products,sku,' . $id,
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:Active,Inactive',
        ]);


        if ($validator->fails()) {
            return redirect(route('products.edit', $product->id))->withErrors($validator)->withInput();
        }

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->category = $request->category;
        $product->sku = $request->sku;
        $product->status = $request->status;
        $product->save();

        // Handle image upload
        if ($request->hasFile('image')) {
            if ($oldimg != null && File::exists(public_path('uploads/products/' . $oldimg))) {
                File::delete(public_path('uploads/products/' . $oldimg));
            }
            $imagePath = $request->image;

            $imageName = $product->name . '-' . time() . '.' . $imagePath->getClientOriginalExtension(); // productName-1698765432.jpg
            $imagePath->move(public_path('uploads/products'), $imageName);
            // Save the image name to the database
            $product->image = $imageName;
            $product->save();
        }
        return redirect(route('products.index'))->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id )
    {
        $product = Product::findOrFail($id);

        if ($product->image != null && File::exists(public_path('uploads/products/' . $product->image))) {
                File::delete(public_path('uploads/products/' . $product->image));
            }
        $product->delete();
        return redirect(route('products.index'))->with('success', 'Product deleted successfully.');
    }
}
