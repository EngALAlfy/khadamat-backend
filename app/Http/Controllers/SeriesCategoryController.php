<?php

namespace App\Http\Controllers;

use App\Models\FilmCategory;
use App\Models\SeriesCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SeriesCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $seriesCategories = SeriesCategory::with('createdUser:id,name')->get();
        return view('series-categories.index', compact('seriesCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {

        return view('series-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'image' => 'required',
        ]);


        $imagename = Time() . "-" . $request->file('image')->getClientOriginalName();

        $request->file('image')->storePubliclyAs('images', $imagename, 'uploads');

        $category = new SeriesCategory;

        $category->name = $request->name;
        $category->image = $imagename;
        $category->created_by = Auth::user()->id;

        $category->save();

        return back()->with('status', trans('added successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\SeriesCategory $seriesCategory
     */
    public function show(SeriesCategory $seriesCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\SeriesCategory $seriesCategory
     */
    public function edit(SeriesCategory $seriesCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\SeriesCategory $seriesCategory
     */
    public function update(Request $request, SeriesCategory $seriesCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\SeriesCategory $seriesCategory
     */
    public function destroy(SeriesCategory $seriesCategory)
    {

        $series = $seriesCategory->series();

        foreach ($series->get() as $serie) {
            $serie->episodes()->delete();
        }

        $series->delete();
        $seriesCategory->delete();

        return back()->with('status', 'deleted successfully');
    }
}
