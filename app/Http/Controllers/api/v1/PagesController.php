<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PagesController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $page
     */
    public function show(Page $page)
    {
        return view('pages.show' , compact('page'));
    }

}
