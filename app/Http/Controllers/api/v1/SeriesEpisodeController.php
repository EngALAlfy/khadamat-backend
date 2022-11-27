<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\SuccessResource;
use App\Models\SeriesEpisode;
use Illuminate\Http\Request;

class SeriesEpisodeController extends Controller
{
    public function index($series_id)
    {
        $episodes = SeriesEpisode::with('series')->where('series_id' , $series_id)->get();
        return new SuccessResource(['data' => $episodes]);
    }

}
