<?php

namespace App\Http\Controllers;

use App\Models\CoinPack;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CoinPacksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $coinpacks = CoinPack::with("createdUser:id,name")->get();
        return view('coinpacks.index', compact('coinpacks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('coinpacks.create');
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

        $coinPack = new CoinPack;

        $coinPack->name = $request->name;
        $coinPack->price = $request->price;
        $coinPack->count = $request->count;
        $coinPack->image = $imagename;
        $coinPack->created_by = Auth::user()->id;

        $coinPack->save();

        return Redirect::back()->with('status', trans('added successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\CoinPack $coinPack
     * @return \Illuminate\Http\Response
     */
    public function show(CoinPack $coinPack)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\CoinPack $coinPack
     */
    public function edit(CoinPack $coinPack)
    {
        return view('coinpacks.update', compact('coinPack'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CoinPack $coinPack
     */
    public function update(Request $request, CoinPack $coinPack)
    {
        $validated = $request->validate([
            'name' => 'nullable|max:255',
            'count' => 'nullable|numeric',
            'price' => 'nullable|numeric',
            'image' => 'nullable',
        ]);


        if ($request->has('name')) {
            if ($coinPack->name != $request->name) {
                $coinPack->name = $request->name;
            }
        }
        if ($request->has('count')) {
            if ($coinPack->count != $request->count) {
                $coinPack->count = $request->count;
            }
        }
        if ($request->has('price')) {
            if ($coinPack->price != $request->price) {
                $coinPack->price = $request->price;
            }
        }


        if ($request->hasFile('image')) {

            if ($coinPack->image != $request->file('image')->getFilename()) {

                $imagename = Time() . "-" . $request->file('image')->getClientOriginalName();
                $request->file('image')->storePubliclyAs('images', $imagename, 'uploads');

                $coinPack->image = $imagename;
            }
        }

        $coinPack->save();

        return Redirect::route('admin.coinpacks.index')->with('status', 'updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\CoinPack $coinPack
     */
    public function destroy(CoinPack $coinPack)
    {
        $coinPack->delete();
        return back()->with('status' , 'deleted successfully');
    }
}
