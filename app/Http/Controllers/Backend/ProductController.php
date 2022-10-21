<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Auth;
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
        $products = Product::all();
        return view('backend.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('backend.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $productsData = $request->except(['categories', 'images']);
        $productsData['user_id'] = Auth::id();

        $product = Product::create($productsData);
        $product->categories()->attach($request->categories);

        if ($request->hasFile('images')) {
            $images = $request->file('images');

            foreach ($images as $image) {
                $path = $image->store('product_images/' . $product->id, 'public');

                $productImages = new ProductImage();
                $productImages->path = $path;
                $productImages->product_id = $product->id;
                $productImages->save();
            }
        }

        flash()->addSuccess("The Product [ $request->title ] has been added successfully.");
        return redirect()->route('backend.products.index');
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
        $categories = Category::all();
        $productCategoriesIds = [];

        foreach ($product->categories as $category) {
            $productCategoriesIds[] = $category->id;
        }

        return view('backend.products.edit', compact('categories', 'product', 'productCategoriesIds'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $productsData = $request->except(['categories', 'images']);
        $product->update($productsData);
        $product->categories()->sync($request->categories);


        if ($request->hasFile('images')) {

            foreach ($product->images as $image) {

                if (Storage::disk('public')->exists($image->path)) {
                    // Remove old image
                    Storage::disk('public')->delete($image->path);
                }

                $image->delete();
            }

            $images = $request->file('images');

            foreach ($images as $image) {
                $path = $image->store('product_images/' . $product->id, 'public');

                $productImages = new ProductImage();
                $productImages->path = $path;
                $productImages->product_id = $product->id;
                $productImages->save();
            }
        }

        flash()->addSuccess("The Product [ $request->title ] has been updated successfully.");
        return redirect()->route('backend.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        foreach ($product->images as $image) {
            if (Storage::disk('public')->exists($image->path)) {
                // Remove old image
                Storage::disk('public')->delete($image->path);
            }
        }

        $product->delete();

        flash()->addSuccess("The Product [ $product->title ] has been deleted successfully.");
        return redirect()->route('backend.products.index');
    }
}
