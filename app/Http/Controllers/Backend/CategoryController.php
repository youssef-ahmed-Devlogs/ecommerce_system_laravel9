<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('backend.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('backend.categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:2', 'max:100'],
            'cover' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048']
        ]);

        $data = $request->all();

        if ($request->hasFile('cover')) {
            $cover = $request->file('cover')->store('categories_covers', 'public');
            $data['cover'] =  $cover;
        }

        Category::create($data);

        flash()->addSuccess("The Category [ $request->name ] has been added successfully.");
        return redirect()->route('backend.categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $current_category = $category;
        $categories = Category::where('id', '!=', $current_category->id)->get();
        return view('backend.categories.edit', compact('current_category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => ['required', 'min:2', 'max:100'],
            'cover' => ['image', 'mimes:jpeg,png,jpg', 'max:2048']
        ]);

        $data = $request->all();

        if ($request->hasFile('cover')) {

            if ($category->cover && Storage::disk('public')->exists($category->cover)) {
                // Remove old image
                Storage::disk('public')->delete($category->cover);
            }

            $cover = $request->file('cover')->store('categories_covers', 'public');
            $data['cover'] =  $cover;
        }

        $category->update($data);

        flash()->addSuccess("The Category [ $category->name ] has been updated successfully.");
        return redirect()->route('backend.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {

        if ($category->cover && Storage::disk('public')->exists($category->cover)) {
            // Remove old image
            Storage::disk('public')->delete($category->cover);
        }

        $category->delete();

        flash()->addSuccess("The Category [ $category->name ] has been deleted successfully.");
        return redirect()->route('backend.categories.index');
    }
}
