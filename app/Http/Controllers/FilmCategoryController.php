<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\FilmCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class FilmCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $filmCategories = FilmCategory::with('createdUser:id,name')->get();
        return view('film-categories.index' , compact('filmCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('film-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|max:255',
            'image' => 'required',
        ]);


        $imagename = Time() . "-" . $request->file('image')->getClientOriginalName();

        $request->file('image')->storePubliclyAs('images', $imagename, 'uploads');

        $category = new FilmCategory;

        $category->name = $request->name;
        $category->image = $imagename;
        $category->created_by = Auth::user()->id;

        $category->save();

        return back()->with('status', trans('added successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FilmCategory  $filmCategory
     */
    public function show(FilmCategory $filmCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FilmCategory  $filmCategory
     */
    public function edit(FilmCategory $filmCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FilmCategory  $filmCategory
     */
    public function update(Request $request, FilmCategory $filmCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FilmCategory  $filmCategory
     */
    public function destroy(FilmCategory $filmCategory)
    {

        $filmCategory->films()->delete();
        $filmCategory->delete();

        return back()->with('status', 'deleted successfully');
    }
}
