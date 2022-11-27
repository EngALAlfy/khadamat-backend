<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $items = Item::with('createdUser:id,name', 'category:id,name', 'subcategory:id,name', 'subsubcategory:id,name')
            ->orderByDesc('sponsored')
            ->orderByRaw('sponsored_index = 0 , sponsored_index')
            ->orderByDesc('created_at')->paginate(500);

        return view('items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $categories = Category::with('subcategories.subsubcategories')->orderByDesc('created_at')->get();
        return view('items.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            //'name' => 'required|unique:items|min:5|max:255',
            'desc' => 'required|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|max:15',
            'category' => 'required',
            'image' => 'required',
        ]);

        // main image
        $imagename = Time() . "-" . $request->file('image')->getClientOriginalName();
        $request->file('image')->storePubliclyAs('images', $imagename, 'uploads');

        $imagename1 = null;
        $imagename2 = null;
        $imagename3 = null;
        $imagename4 = null;

        // image 1
        if ($request->hasFile('image1')) {
            $imagename1 = Time() . "-" . $request->file('image1')->getClientOriginalName();
            $request->file('image1')->storePubliclyAs('images', $imagename1, 'uploads');
        }
        // image 2
        if ($request->hasFile('image1')) {

            $imagename2 = Time() . "-" . $request->file('image2')->getClientOriginalName();
            $request->file('image2')->storePubliclyAs('images', $imagename2, 'uploads');
        }
        // image 3

        if ($request->hasFile('image1')) {
            $imagename3 = Time() . "-" . $request->file('image3')->getClientOriginalName();
            $request->file('image3')->storePubliclyAs('images', $imagename3, 'uploads');
        }
        // image 4

        if ($request->hasFile('image1')) {
            $imagename4 = Time() . "-" . $request->file('image4')->getClientOriginalName();
            $request->file('image4')->storePubliclyAs('images', $imagename4, 'uploads');
        }

        $category_id = explode(':', $request->category)[0];
        $subcategory_id = explode(':', $request->category)[1];
        $subsubcategory_id = explode(':', $request->category)[2];

        $item = new Item;

        $item->name = $request->name;
        $item->desc = $request->desc;
        $item->category_id = $category_id;
        $item->subcategory_id = $subcategory_id;
        $item->subsubcategory_id = $subsubcategory_id;
        $item->image = $imagename;
        $item->image1 = $imagename1;
        $item->image2 = $imagename2;
        $item->image3 = $imagename3;
        $item->image4 = $imagename4;


        if($request->has('phone')){
            $item->phone = $request->phone;
        }

        if($request->has('email')){
            $item->email = $request->email;
        }

        $item->sponsored = false;
        $item->sponsored_index = 0;
        $item->created_by = Auth::user()->id;

        $item->save();

        return back()->with('status', trans('added successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Item $item
     */
    public function show(Item $item)
    {
        //
    }

    public function sponsored(Item $item)
    {
        $item->sponsored = true;
        $item->save();
        return back()->with('status' , 'sponsored successfully');
    }

    public function stopSponsored(Item $item)
    {
        $item->sponsored = false;
        $item->sponsored_index = 0;
        $item->save();
        return back()->with('status' , 'sponsored successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Item $item
     */
    public function edit(Item $item)
    {
        $categories = Category::with('subcategories.subsubcategories')->orderByDesc('created_at')->get();
        return view('items.update', compact('item', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Item $item
     */
    public function update(Request $request, Item $item)
    {

        $validated = $request->validate([
            'name' => 'nullable|max:255',
            'desc' => 'nullable',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|max:15',
            'sponsored' => 'nullable',
            'sponsored_index' => 'nullable|numeric',
            'image' => 'nullable',
            'image1' => 'nullable',
            'image2' => 'nullable',
            'image3' => 'nullable',
            'image4' => 'nullable',
        ]);

        if (Auth::user()->points <= 0 && $request->input('sponsored') == 1) {
            return back()->with('error', trans('no enough points'));
        }

        // image
        if ($request->hasFile('image')) {
            $imagename = Time() . "-" . $request->file('image')->getClientOriginalName();
            $request->file('image')->storePubliclyAs('images', $imagename, 'uploads');
            $item->image = $imagename;
        }

        // image 1
        if ($request->hasFile('image1')) {
            $imagename1 = Time() . "-" . $request->file('image1')->getClientOriginalName();
            $request->file('image1')->storePubliclyAs('images', $imagename1, 'uploads');
            $item->image1 = $imagename1;
        }

        // image 2
        if ($request->hasFile('image1')) {
            $imagename2 = Time() . "-" . $request->file('image2')->getClientOriginalName();
            $request->file('image2')->storePubliclyAs('images', $imagename2, 'uploads');
            $item->image2 = $imagename2;
        }

        // image 3
        if ($request->hasFile('image1')) {
            $imagename3 = Time() . "-" . $request->file('image3')->getClientOriginalName();
            $request->file('image3')->storePubliclyAs('images', $imagename3, 'uploads');
            $item->image3 = $imagename3;
        }

        // image 4
        if ($request->hasFile('image1')) {
            $imagename4 = Time() . "-" . $request->file('image4')->getClientOriginalName();
            $request->file('image4')->storePubliclyAs('images', $imagename4, 'uploads');
            $item->image4 = $imagename4;
        }

        if ($request->has('category')) {
            $category_id = explode(':', $request->category)[0];
            $subcategory_id = explode(':', $request->category)[1];
            $subsubcategory_id = explode(':', $request->category)[2];


            $item->category_id = $category_id;
            $item->subcategory_id = $subcategory_id;
            $item->subsubcategory_id = $subsubcategory_id;

        }

        if ($request->has('name')) {
            if ($item->name != $request->name) {
                $item->name = $request->name;
            }
        }

        if ($request->has('desc')) {
            if ($item->desc != $request->desc && $request->desc != null) {
                $item->desc = $request->desc;
            }
        }

        if ($request->has('sponsored')) {

            if($request->filled('sponsored') == true){
                Auth::user()->points -= 1;
                Auth::user()->save();
            }

            $item->sponsored = $request->filled('sponsored');
        }

        if ($request->has('sponsored_index')) {
            $item->sponsored_index = $request->sponsored_index;
        }

        if($request->has('phone')){
            $item->phone = $request->phone;
        }

        if($request->has('email')){
            $item->email = $request->email;
        }

        $item->save();

        return Redirect::route('admin.items.index')->with('status', trans('updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Item $item
     */
    public function destroy(Item $item)
    {
        $item->delete();
        return back()->with('status', 'deleted successfully');
    }
}
