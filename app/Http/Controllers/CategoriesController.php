<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $categories = Category::with('createdUser:id,name')->orderByDesc('created_at')->get();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {

        $imagename = Time() . "-" . $request->file('image')->getClientOriginalName();

        $path = $request->file('image')->storePubliclyAs('images', $imagename, 'uploads');

        $category = new Category;

        $category->name = $request->name;
        $category->image = $imagename;
        $category->created_by = Auth::user()->id;

        $category->save();

        return Redirect::back()->with('status', trans('added successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Category $category
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Category $category
     */
    public function edit(Category $category)
    {
        return view('categories.update', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Category $category
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'nullable|max:255',
            'image' => 'nullable',
        ]);

        if ($request->has('name')) {
            if ($category->name != $request->name) {
                $category->name = $request->name;
            }
        }


        if ($request->hasFile('image')) {

            if ($category->image != $request->file('image')->getFilename()) {

                $imagename = Time() . "-" . $request->file('image')->getClientOriginalName();
                $request->file('image')->storePubliclyAs('images', $imagename, 'uploads');

                $category->image = $imagename;
            }
        }

        $category->save();

        return Redirect::route('admin.categories.index')->with('status', 'updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Category $category
     */
    public function destroy(Category $category)
    {
        $category->items()->delete();
        $category->subcategories()->delete();
        $category->subsubcategories()->delete();
        $category->delete();

        return back()->with('status', 'deleted successfully');
    }
}
