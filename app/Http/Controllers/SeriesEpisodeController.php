<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Series;
use App\Models\SeriesEpisode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SeriesEpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Series $series
     */
    public function index(Series $series)
    {
        $episodes = SeriesEpisode::where('series_id' , $series->id)->with('createdUser:id,name')->get();
        return view('series-episodes.index', compact('episodes' , 'series'));
    }

    /**
     * Show the form for creating a new resource.
     * @param Series $series
     */
    public function create(Series $series)
    {
        return view('series-episodes.create' , compact('series'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Series $series
     */
    public function store(Request $request , Series $series)
    {
        $request->validate([
            'name' => 'required|max:255',
            'desc' => 'required|max:255',
            'image' => 'required',
            'order' => 'required|min:1',
        ]);


        $imagename = Time() . "-" . $request->file('image')->getClientOriginalName();
        $request->file('image')->storePubliclyAs('images', $imagename, 'uploads');

        $episode = new SeriesEpisode;

        if ($request->hasFile('file')) {
            $filename = Time() . "-" . $request->file('file')->getClientOriginalName();
            $request->file('file')->storePubliclyAs('videos', $filename, 'uploads');
            $episode->file = $filename;
        }

        $episode->order = $request->order;
        $episode->name = $request->name;
        $episode->desc = $request->desc;
        $episode->url = $request->url;
        $episode->series_id = $series->id;
        $episode->image = $imagename;
        $episode->created_by = Auth::user()->id;

        $episode->save();

        return back()->with('status', trans('added successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SeriesEpisode  $seriesEpisode
     */
    public function show(SeriesEpisode $seriesEpisode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SeriesEpisode  $seriesEpisode
     */
    public function edit(SeriesEpisode $seriesEpisode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SeriesEpisode  $seriesEpisode
     */
    public function update(Request $request, SeriesEpisode $seriesEpisode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SeriesEpisode  $seriesEpisode
     */
    public function destroy(SeriesEpisode $seriesEpisode)
    {
        $seriesEpisode->delete();
        return back()->with('status', "deleted successfully");
    }
}
