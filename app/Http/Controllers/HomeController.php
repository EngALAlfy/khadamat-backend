<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CoinPack;
use App\Models\Item;
use App\Models\Page;
use App\Models\SubSubCategory;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $allItemsCount = Item::count();
        $sponsoredItemsCount = Item::where('sponsored', true)->count();
        $unSponsoredItemsCount = Item::where('sponsored', false)->count();

        $categoriesCount = Category::count();
        $subCategoriesCount = SubCategory::count();
        $subSubCategoriesCount = SubSubCategory::count();

        $adminsCount = User::where('role', "admin")->count();
        $bannedAdminsCount = User::where('role', "admin")->where('banned', true)->count();

        $usersCount = User::where('role', "user")->count();
        $bannedUsersCount = User::where('role', "user")->where('banned', true)->count();

        $pagesCount = Page::count();
        $coinPacksCount = CoinPack::count();

        return view('home', compact('allItemsCount', 'sponsoredItemsCount'
            , 'unSponsoredItemsCount', 'categoriesCount', 'subCategoriesCount', 'subSubCategoriesCount',
            'adminsCount', 'usersCount', 'pagesCount', 'coinPacksCount' , 'bannedAdminsCount' , 'bannedUsersCount'));
    }
}
