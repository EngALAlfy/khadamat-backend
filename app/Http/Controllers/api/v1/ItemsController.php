<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\ValidateErrorResource;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $items = Item::where('archived' , 0)->with('createdUser:id,name,email,phone,photo')->orderByDesc('sponsored')->orderByRaw('sponsored_index = 0 , sponsored_index')->orderByDesc('created_at')->get();
        return new SuccessResource($items);
    }



    public function search($searchTerm)
    {
        $items = Item::query()
            ->where('name', 'LIKE', "%{$searchTerm}%")
            ->orWhere('desc', 'LIKE', "%{$searchTerm}%")->with('createdUser:id,name,email,phone,photo')->orderByDesc('sponsored')->orderByRaw('sponsored_index = 0 , sponsored_index')->orderByDesc('created_at')->get();
        return new SuccessResource($items);
    }

    public function searchCategory($subsubcategory_id,$searchTerm)
    {
        $items = Item::query()
            ->where('name', 'LIKE', "%{$searchTerm}%")
            /*->orWhere('desc', 'LIKE', "%{$searchTerm}%")->*/
            ->with('createdUser:id,name,email,phone,photo')->orderByDesc('sponsored')->orderByRaw('sponsored_index = 0 , sponsored_index')->orderByDesc('created_at')->
            where('subsubcategory_id' , $subsubcategory_id)->get();

        return new SuccessResource($items);
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
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'subsubcategory_id' => 'required',
            'image' => 'required',
        ]);

        if ($validator->fails()) {
            return new ValidateErrorResource($validator->errors());
        }


        if (Auth::user()->points <= 0 && $request->input('sponsored') == 1) {
            return new ErrorResource(['data' => 'no enough points']);
        }


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
        if ($request->hasFile('image2')) {
            $imagename2 = Time() . "-" . $request->file('image2')->getClientOriginalName();
            $request->file('image2')->storePubliclyAs('images', $imagename2, 'uploads');
        }
        // image 3
        if ($request->hasFile('image3')) {
            $imagename3 = Time() . "-" . $request->file('image3')->getClientOriginalName();
            $request->file('image3')->storePubliclyAs('images', $imagename3, 'uploads');
        }
        // image 4
        if ($request->hasFile('image4')) {
            $imagename4 = Time() . "-" . $request->file('image4')->getClientOriginalName();
            $request->file('image4')->storePubliclyAs('images', $imagename4, 'uploads');
        }

        $category_id = $request->category_id;
        $subcategory_id = $request->subcategory_id;
        $subsubcategory_id = $request->subsubcategory_id;

        $item = new Item;

        $item->name = $request->input('name');
        $item->desc = $request->input('desc');
        $item->category_id = $category_id;
        $item->subcategory_id = $subcategory_id;
        $item->subsubcategory_id = $subsubcategory_id;
        $item->image = $imagename;
        $item->image1 = $imagename1;
        $item->image2 = $imagename2;
        $item->image3 = $imagename3;
        $item->image4 = $imagename4;

        if ($request->input('sponsored') == 1) {
            Auth::user()->points -= 1;
            Auth::user()->save();
        }

        $item->sponsored = $request->input('sponsored');
        $item->sponsored_index = 0;

        $item->created_by = Auth::user()->id;

        $item->save();


        return new SuccessResource([]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        $item = Item::with('createdUser:id,name,email,phone,photo', 'category:id,name', 'subcategory:id,name' , 'subsubcategory:id,name')->find($id);
        return new SuccessResource($item);
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'desc' => 'required|max:255',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'subsubcategory_id' => 'required',
        ]);

        if ($validator->fails()) {
            return new ValidateErrorResource($validator->errors());
        }

        $item = Item::find($id);

        if($item == null){
            return new ErrorResource(['data' => 'no item found']);
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
        if ($request->hasFile('image2')) {
            $imagename2 = Time() . "-" . $request->file('image2')->getClientOriginalName();
            $request->file('image2')->storePubliclyAs('images', $imagename2, 'uploads');
            $item->image2 = $imagename2;

        }
        // image 3
        if ($request->hasFile('image3')) {
            $imagename3 = Time() . "-" . $request->file('image3')->getClientOriginalName();
            $request->file('image3')->storePubliclyAs('images', $imagename3, 'uploads');
            $item->image3 = $imagename3;

        }
        // image 4
        if ($request->hasFile('image4')) {
            $imagename4 = Time() . "-" . $request->file('image4')->getClientOriginalName();
            $request->file('image4')->storePubliclyAs('images', $imagename4, 'uploads');
            $item->image4 = $imagename4;
        }

        $category_id = $request->category_id;
        $subcategory_id = $request->subcategory_id;
        $subsubcategory_id = $request->subsubcategory_id;


        $item->desc = $request->input('desc');
        $item->category_id = $category_id;
        $item->subcategory_id = $subcategory_id;
        $item->subsubcategory_id = $subsubcategory_id;


        $item->save();

        return new SuccessResource([]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function stopSponsored(Item $item)
    {
        if ($item->created_by == Auth::user()->id) {
            $item->sponsored = false;
            $item->sponsored_index = 0;
            $item->save();
            return new SuccessResource([]);
        } else {
            return new ErrorResource(['data' => 'this is not your item']);
        }

    }

    public function startSponsored(Item $item)
    {
        if ($item->created_by == Auth::user()->id) {

            if (Auth::user()->points <= 0) {
                return new ErrorResource(['data' => 'no enough points']);
            }

            $item->sponsored = true;

            Auth::user()->points -= 1;
            Auth::user()->save();

            $item->save();
            return new SuccessResource([]);
        } else {
            return new ErrorResource(['data' => 'this is not your item']);
        }
    }
}
