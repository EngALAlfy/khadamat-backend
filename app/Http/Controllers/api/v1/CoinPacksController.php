<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\SuccessResource;
use App\Models\CoinPack;
use Illuminate\Http\Request;

class CoinPacksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $coinPacks = CoinPack::all();
        return new SuccessResource($coinPacks);
    }

}
