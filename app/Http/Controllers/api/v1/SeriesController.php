<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\SuccessResource;
use App\Models\Series;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index($category_id)
    {
        $series = Series::where('series_category_id' , $category_id)->orderBy('created_at')->get();
        return new SuccessResource(['data' => $series]);
    }

}
