<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\SuccessResource;
use App\Models\Item;
use App\Models\SubSubCategory;
use Illuminate\Http\Request;

class SubSubCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function select($subCategory)
    {
        $subsubcategories = SubSubCategory::where('subcategory_id' , $subCategory)->orderByDesc('created_at')->get()->makeHidden('created_by');
        return new SuccessResource($subsubcategories);
    }

    /**
     * Display the specified resource.
     */
    public function show($category_id , $subcategory_id , $subsubcategory_id)
    {
        $items = Item::where('archived' , 0)->with('createdUser:id,name,email,phone,photo', 'category:id,name', 'subcategory:id,name' , 'subsubcategory:id,name')
            ->where('category_id' , $category_id)
            ->where('subcategory_id' , $subcategory_id)
            ->where('subsubcategory_id' , $subsubcategory_id)
            ->orderByDesc('sponsored')
            ->orderByRaw('sponsored_index = 0 , sponsored_index')
            ->orderByDesc('created_at')->get();

        $items->each->addView();

        return new SuccessResource($items);
    }
}
