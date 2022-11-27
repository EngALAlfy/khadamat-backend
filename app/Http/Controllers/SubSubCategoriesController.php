<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class SubSubCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $subsubcategories = SubSubCategory::with('createdUser:id,name' , 'category:id,name', 'subCategory:id,name')->orderByDesc('created_at')->get();
        return view('subsubcategories.index' , compact('subsubcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $categories = Category::with('subcategories')->orderByDesc('created_at')->get();
        return view('subsubcategories.create', compact('categories'));
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

        $category_id = explode(':', $request->category)[0];
        $subcategory_id = explode(':', $request->category)[1];


        $subsubcategory = new SubSubCategory;

        $subsubcategory->name = $request->name;
        $subsubcategory->category_id = $category_id;
        $subsubcategory->subcategory_id = $subcategory_id;
        $subsubcategory->image = $imagename;
        $subsubcategory->created_by = Auth::user()->id;

        $subsubcategory->save();

        return Redirect::back()->with('status' , trans('added successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubSubCategory  $subSubCategory
     */
    public function show(SubSubCategory $subSubCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubSubCategory  $subSubCategory
     */
    public function edit(SubSubCategory $subSubCategory)
    {
        return view('subsubcategories.update', compact('subSubCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubSubCategory  $subSubCategory
     */
    public function update(Request $request, SubSubCategory $subSubCategory)
    {
        $validated = $request->validate([
            'name' => 'nullable|max:255',
            'image' => 'nullable',
        ]);

        if ($request->has('name')) {
            if ($subSubCategory->name != $request->name) {
                $subSubCategory->name = $request->name;
            }
        }


        if ($request->hasFile('image')) {

            if ($subSubCategory->image != $request->file('image')->getFilename()) {

                $imagename = Time() . "-" . $request->file('image')->getClientOriginalName();
                $request->file('image')->storePubliclyAs('images', $imagename, 'uploads');

                $subSubCategory->image = $imagename;
            }
        }

        $subSubCategory->save();

        return Redirect::route('admin.subsubcategories.index')->with('status', 'updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubSubCategory  $subSubCategory
     */
    public function destroy(SubSubCategory $subSubCategory)
    {
        $subSubCategory->items()->delete();
        $subSubCategory->delete();
        return back()->with('status' , 'deleted successfully');
    }
}
