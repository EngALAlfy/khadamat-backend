<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\SuccessResource;
use App\Models\Film;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    public function index($category_id)
    {
        $films = Film::with('category')->where('film_category_id' , $category_id)->orderBy('created_at')->get();
        return new SuccessResource(['data' => $films]);
    }
}
