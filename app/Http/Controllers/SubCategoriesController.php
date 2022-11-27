<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class SubCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $subcategories = SubCategory::with('createdUser:id,name' , 'category:id,name')->orderByDesc('created_at')->get();
        return view('subcategories.index' , compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $categories = Category::orderByDesc('created_at')->get();
        return  view('subcategories.create' , compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $imagename = Time() . "-" . $request->file('image')->getClientOriginalName();

        $path = $request->file('image')->storePubliclyAs('images' , $imagename ,'uploads');

        $subcategory = new SubCategory;

        $subcategory->name = $request->name;
        $subcategory->category_id = $request->category_id;
        $subcategory->image = $imagename;
        $subcategory->created_by = Auth::user()->id;

        $subcategory->save();

        return Redirect::back()->with('status' , trans('added successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     */
    public function show(SubCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     */
    public function edit(SubCategory $subCategory)
    {
        return view('subcategories.update', compact('subCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubCategory  $subCategory
     */
    public function update(Request $request, SubCategory $subCategory)
    {
        $validated = $request->validate([
            'name' => 'nullable|max:255',
            'image' => 'nullable',
        ]);

        if ($request->has('name')) {
            if ($subCategory->name != $request->name) {
                $subCategory->name = $request->name;
            }
        }


        if ($request->hasFile('image')) {

            if ($subCategory->image != $request->file('image')->getFilename()) {

                $imagename = Time() . "-" . $request->file('image')->getClientOriginalName();
                $request->file('image')->storePubliclyAs('images', $imagename, 'uploads');

                $subCategory->image = $imagename;
            }
        }

        $subCategory->save();

        return Redirect::route('admin.subcategories.index')->with('status', 'updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubCategory  $subCategory
     *
     */
    public function destroy(SubCategory $subCategory)
    {
        $subCategory->subsubcategories()->delete();
        $subCategory->items()->delete();
        $subCategory->delete();
        return back()->with('status' , 'deleted successfully');
    }
}
