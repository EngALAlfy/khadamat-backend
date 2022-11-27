<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\FilmCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $films = Film::with('createdUser:id,name','category')->get();
        return view('films.index', compact('films'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $filmCategories = FilmCategory::all();
        return view('films.create', compact('filmCategories'));
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
            'desc' => 'required|max:1000',
            'image' => 'required',
            'film_category_id' => 'required',
        ]);


        $imagename = Time() . "-" . $request->file('image')->getClientOriginalName();
        $request->file('image')->storePubliclyAs('images', $imagename, 'uploads');

        $film = new Film;

        if ($request->hasFile('file')) {
            $filename = Time() . "-" . $request->file('file')->getClientOriginalName();
            $request->file('file')->storePubliclyAs('videos', $filename, 'uploads');
            $film->file = $filename;
        }

        $film->name = $request->name;
        $film->desc = $request->desc;
        $film->url = $request->url;
        $film->film_category_id = $request->film_category_id;
        $film->image = $imagename;
        $film->created_by = Auth::user()->id;

        $film->save();

        return back()->with('status', trans('added successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Film $film
     */
    public function show(Film $film)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Film $film
     */
    public function edit(Film $film)
    {
        $filmCategories = FilmCategory::all();
        return view('films.update', compact('filmCategories' , 'film'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Film $film
     */
    public function update(Request $request, Film $film)
    {

        if ($request->hasFile('file')) {
            $imagename = Time() . "-" . $request->file('image')->getClientOriginalName();
            $request->file('image')->storePubliclyAs('images', $imagename, 'uploads');
            $film->image = $imagename;
        }

        if ($request->hasFile('file')) {
            $filename = Time() . "-" . $request->file('file')->getClientOriginalName();
            $request->file('file')->storePubliclyAs('videos', $filename, 'uploads');
            $film->file = $filename;
        }

        if ($request->has('name')) {
            $film->name = $request->name;
        }


        if ($request->has('desc')) {
            $film->desc = $request->desc;
        }


        if ($request->has('url')) {
            $film->url = $request->url;
        }


        if ($request->has('film_category_id')) {
            $film->film_category_id = $request->film_category_id;
        }


        $film->save();

        return back()->with('status', trans('updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Film $film
     */
    public function destroy(Film $film)
    {
        $film->delete();
        return back()->with('status', "deleted successfully");
    }
}
