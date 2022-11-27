<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\ValidateErrorResource;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $profile = User::withCount('items')->find(Auth::user()->id);
        return new SuccessResource($profile);
    }

    public function check()
    {
        if (Auth::user()->phone_verified == 1 || Auth::user()->phone_verified == true) {
            return new SuccessResource([]);
        } else {
            return new ErrorResource(['data' => 'phone not verified']);
        }

    }

    public function phone()
    {
        if (Auth::user()->phone != null) {
            return new SuccessResource(Auth::user());
        } else {
            return new ErrorResource(['data' => 'phone is null']);
        }

    }

    /**
     * Display a listing of the resource.
     *
     */
    public function items()
    {
        $items = Item::where('archived' , 0)->with('createdUser:id,name', 'category', 'subcategory', 'subsubcategory')->where('created_by', Auth::user()->id)->orderByDesc('sponsored')->orderByRaw('sponsored_index = 0 , sponsored_index')->orderByDesc('created_at')->get();
        return new SuccessResource($items);
    }

    public function archived()
    {
        $items = Item::where('archived' , 1)->with('createdUser:id,name', 'category', 'subcategory', 'subsubcategory')->where('created_by', Auth::user()->id)->orderByDesc('sponsored')->orderByRaw('sponsored_index = 0 , sponsored_index')->orderByDesc('created_at')->get();
        return new SuccessResource($items);
    }


    public function archive($id)
    {
        $item = Item::find($id);
        $item->archived = 1;
        $item->save();

        return new SuccessResource([]);
    }

    public function unarchive($id)
    {
        $item = Item::find($id);
        $item->archived = 0;
        $item->save();

        return new SuccessResource([]);
    }


    /**
     * Display a listing of the resource.
     *
     */
    public function deleteItem(Item $item)
    {
        $item->delete();
        return new SuccessResource([]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function updatePhoto(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'photo' => 'required',
        ]);

        if ($validator->fails()) {
            return new ValidateErrorResource($validator->errors());
        }

        $photoname = Time() . "-" . $request->file('photo')->getClientOriginalName();
        $request->file('photo')->storePubliclyAs('images', $photoname, 'uploads');

        Auth::user()->photo = $photoname;
        Auth::user()->save();

        return new SuccessResource([]);
    }

    public function updateName(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:5|max:255',
        ]);

        if ($validator->fails()) {
            return new ValidateErrorResource($validator->errors());
        }

        Auth::user()->name = $request->name;
        Auth::user()->save();

        return new SuccessResource([]);
    }


    public function apiPhoneVerified()
    {
        $user = Auth::user();

        if ($user == null) {
            return new ErrorResource(['data' => 'no user']);
        }

        if ($user->banned == 1) {
            return new ErrorResource(['data' => 'user is banned']);
        }

        $user->phone_verified = true;
        $user->save();

        return new SuccessResource($user);
    }

    public function addPoints(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'points' => 'required',
        ]);

        if ($validator->fails()) {
            return new ValidateErrorResource($validator->errors());
        }

        Auth::user()->points += $request->points;
        Auth::user()->save();

        return new SuccessResource([]);
    }


    public function getUser($id)
    {
        $profile = User::withCount('items')->find($id);
        if($profile == null){
            return new ErrorResource(["data" => 'user not found']);
        }

        if(empty($profile)){
            return new ErrorResource(["data" => 'the user not found']);
        }

        return new SuccessResource($profile);
    }

    public function userItems($id)
    {
        $items = Item::where('archived' , 0)->with('createdUser:id,name', 'category', 'subcategory')->where('created_by', $id)->orderByDesc('sponsored')->orderByRaw('sponsored_index = 0 , sponsored_index')->orderByDesc('created_at')->get();
        return new SuccessResource($items);
    }
}
