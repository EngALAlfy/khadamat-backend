<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\SuccessResource;
use App\Models\FilmCategory;
use Illuminate\Http\Request;

class FilmCategoryController extends Controller
{
    public function index()
    {
        $filmsCategories = FilmCategory::orderBy('created_at')->get();
        return new SuccessResource(['data' => $filmsCategories]);
    }
}
