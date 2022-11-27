<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SubCategoryResource;
use App\Models\SubSubCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $categories = SubCategory::withCount('items')->orderByDesc('created_at')->get()->makeHidden('created_by');;
        return new SuccessResource($categories);
    }


    /**
     * Display a listing of the resource.
     *
     */
    public function select($category)
    {
        $subcategories = SubCategory::where('category_id' , $category)->orderByDesc('created_at')->get()->makeHidden('created_by');
        return new SuccessResource($subcategories);
    }

    public function show($category_id, $subcategory_id)
    {
        //$items = Item::with('createdUser:id,name', 'category', 'subcategory')->where('category_id' , $category_id)->where('subcategory_id' , $subcategory_id)->orderByDesc('sponsored')->orderByRaw('sponsored_index = 0 , sponsored_index')->orderByDesc('created_at')->get();
        //return new SuccessResource($items);

        $subSubCategory = SubSubcategory::with('createdUser:id,name', 'category', 'subcategory')
            ->withCount('items')->where('category_id', $category_id)
            ->where('subcategory_id', $subcategory_id)
            ->orderByDesc('created_at')->get();
        return new SuccessResource($subSubCategory);
    }

}
