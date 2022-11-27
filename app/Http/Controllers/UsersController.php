<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use function PHPUnit\Framework\isNull;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $users = User::orderByDesc('created_at')->paginate(500);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\User $user
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\User $user
     */
    public function edit(User $user)
    {
        return view('users.update', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'nullable|max:255',
            'points' => 'required|numeric',
            'photo' => 'nullable',
        ]);


        if ($request->has('name')) {
            if ($user->name != $request->name) {
                $user->name = $request->name;
            }
        }
        if ($request->has('points')) {
            if ($user->points != $request->points) {
                $user->points = $request->points;
            }
        }

        if ($request->hasFile('photo')) {

            if ($user->photo != $request->file('photo')->getFilename()) {

                $imagename = Time() . "-" . $request->file('photo')->getClientOriginalName();
                $request->file('photo')->storePubliclyAs('images', $imagename, 'uploads');

                $user->photo = $imagename;
            }
        }

        $user->save();

        return Redirect::route('admin.users.index')->with('status', 'updated successfully');
    }

    /**
     * banned the specified resource from storage.
     *
     * @param \App\Models\User $user
     */
    public function banned(User $user)
    {
        if(Auth::user()->id == $user->id){
            return back()->with('error' , 'cannot banned yourself');
        }

        $user->banned = true;
        $user->save();
        return back()->with('status', 'banneded successfully');
    }

    public function unbanned(User $user)
    {
        $user->banned = false;
        $user->save();
        return back()->with('status', 'unbanneded successfully');
    }

    public function makeAdmin(User $user)
    {
        if(Auth::user()->id == $user->id){
            if($user->role == 'admin'){
                return back()->with('error' , 'already admin');
            }
            return back()->with('error' , 'you cannot add yourself to admin');
        }

        $user->role = "admin";
        $user->save();
        return back()->with('status', 'become admin successfully');
    }

    public function removeAdmin(User $user)
    {
        if(Auth::user()->id == $user->id){
            return back()->with('error' , 'cannot remove yourself from admin');
        }

        $user->role = 'user';
        $user->save();
        return back()->with('status', 'remove admin successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\User $user
     */
    public function destroy(User $user)
    {
        if(Auth::user()->id == $user->id){
            return back()->with('error' , 'cannot delete yourself');
        }

        $user->delete();
        return back()->with('status', 'deleted successfully');
    }
}
