<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Series;
use App\Models\SeriesCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SeriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $series = Series::with('createdUser:id,name' , 'category')->get();
        return view('series.index' , compact('series'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $seriesCategories = SeriesCategory::all();
        return view('series.create' , compact('seriesCategories'));
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
            'desc' => 'required|max:1000',
            'image' => 'required',
            'series_category_id' => 'required',
        ]);


        $imagename = Time() . "-" . $request->file('image')->getClientOriginalName();
        $request->file('image')->storePubliclyAs('images', $imagename, 'uploads');

        $series = new Series;

        $series->name = $request->name;
        $series->desc = $request->desc;
        $series->series_category_id = $request->series_category_id;
        $series->image = $imagename;
        $series->created_by = Auth::user()->id;

        $series->save();

        return back()->with('status', trans('added successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Series  $series
     */
    public function show(Series $series)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Series  $series
     */
    public function edit(Series $series)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Series  $series
     */
    public function update(Request $request, Series $series)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Series  $series
     */
    public function destroy(Series $series)
    {
        $series->delete();
        return back()->with('status', "deleted successfully");
    }
}
