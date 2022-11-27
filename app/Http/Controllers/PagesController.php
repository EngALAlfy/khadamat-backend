<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $pages = Page::all();
        return view('pages.index' , compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {

        $page = Page::find($request->input('name'));

        if(!$page){
            $page = new Page;
            $page->id = $request->input('name');
        }

        $page->content =  $request->input('content');
        $page->created_by = Auth::user()->id;
        $page->save();

        return back()->with('status' , 'added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $page
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page  $page
     */
    public function edit(Page $page)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Page  $page
     */
    public function update(Request $request, Page $page)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     */
    public function destroy(Page $page)
    {
        $page->delete();
        return back()->with('status', 'deleted successfully');
    }
}
