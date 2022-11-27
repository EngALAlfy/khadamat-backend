<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\SuccessResource;
use App\Models\SeriesCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SeriesCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $seriesCategories = SeriesCategory::orderBy('created_at')->get();
        return new SuccessResource(['data' => $seriesCategories]);
    }
}
