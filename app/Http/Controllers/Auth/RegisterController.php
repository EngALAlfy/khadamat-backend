<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\ValidateErrorResource;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     */
    public function apiRegister(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:5|max:255',
            'username' => 'required|unique:users|min:6|max:50',
            'password' => 'required|min:6|max:50',
            'phone' => 'required|numeric|unique:users|min:7',
            'country_code' => 'required|min:1|max:5',
            'email' => 'required|email|unique:users|max:255',
        ]);

        if ($validator->fails()) {
            return new ValidateErrorResource($validator->errors());
        }

        $user = new User([
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'phone' => $request->input('country_code').$request->input('phone'),
            'method' => 'password',
            'role' => 'user',
            'points' => 0,
            'banned' => false,
            'password' => Hash::make($request->input('password')),
        ]);

        $user->save();
        $user->generateToken();

        return new SuccessResource($user);
    }

    public function apiGoogleRegister(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:5|max:255',
            'username' => 'required|unique:users|min:6|max:50',
            'phone' => 'required|numeric|unique:users|min:7',
            'photo' => 'required',
            'country_code' => 'required|min:1|max:5',
            'email' => 'required|email|unique:users|max:255',
        ]);

        if ($validator->fails()) {
            return new ValidateErrorResource($validator->errors());
        }

        $user = new User([
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'photo' => $request->input('photo'),
            'phone' => $request->input('country_code').$request->input('phone'),
            'method' => 'google',
            'role' => 'user',
            'points' => 0,
            'banned' => false,
        ]);

        $user->save();
        $user->generateToken();

        return new SuccessResource($user);
    }

    public function apiFacebookRegister(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:5|max:255',
            'username' => 'required|unique:users|min:6|max:50',
            'phone' => 'required|numeric|unique:users|min:7',
            'photo' => 'required',
            'country_code' => 'required|min:1|max:5',
            'email' => 'required|email|unique:users|max:255',
        ]);

        if ($validator->fails()) {
            return new ValidateErrorResource($validator->errors());
        }

        $user = new User([
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'photo' => $request->input('photo'),
            'phone' => $request->input('country_code').$request->input('phone'),
            'method' => 'facebook',
            'role' => 'user',
            'points' => 0,
            'banned' => false,
        ]);

        $user->save();
        $user->generateToken();

        return new SuccessResource($user);
    }
}
