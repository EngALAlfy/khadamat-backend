<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\SuccessResource;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $categories = Category::withCount('items')->orderByDesc('created_at')->get()->makeHidden('created_by');
        return new SuccessResource($categories);
    }


    /**
     * Display a listing of the resource.
     *
     */
    public function select()
    {
        $categories = Category::orderByDesc('created_at')->get()->makeHidden('created_by');
        return new SuccessResource($categories);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        $subcategories = SubCategory::withCount('items')->where('category_id' , $id)->get()->makeHidden('created_by');
        return new SuccessResource($subcategories);
    }

}
