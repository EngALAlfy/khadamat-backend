<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use function PHPUnit\Framework\returnArgument;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    public function username(): string
    {
        $username = request()->input('username');

        if (is_numeric($username)) {
            return 'phone';
        } elseif (filter_var($username, FILTER_VALIDATE_EMAIL)) {
            return 'email';
        }

        return 'username';
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function credentials(Request $request)
    {

        $username = request()->input('username');

        if (is_numeric($username)) {
            return ['phone' => $username, 'password' => $request->password];
        } elseif (filter_var($username, FILTER_VALIDATE_EMAIL)) {
            return ['email' => $username, 'password' => $request->password];
        }

        return $request->only($this->username(), 'password');
    }

    public function apiLogin(Request $request)
    {
        // return new ErrorResource(['data'=>$this->credentials($request)]);

        $user = User::where($this->username(), $request->input("username"))->first();


        if ($user == null) {
            return new ErrorResource(['data' => 'no user']);
        }

        if ($user->method != "password") {
            $method = $user->method;
            return new ErrorResource(['data' => 'this user use ' . $method . ' method']);
        }

        if ($user->banned == 1) {
            return new ErrorResource(['data' => 'user is banned']);
        }

        if ($this->attemptLogin($request)) {
            $user = $this->guard()->user();
            $user->generateToken();

            return new SuccessResource($user);
        }

        return new ErrorResource(["data" => "false username or password"]);
    }

    public function apiGoogleLogin(Request $request)
    {
        $token = $request->input('token');

        $tokenParts = explode(".", $token);
        $tokenPayload = base64_decode($tokenParts[1]);
        $jwtPayload = json_decode($tokenPayload);

        $user = User::where('email', $jwtPayload->email)->first();

        if ($user == null) {
            return new ErrorResource(['data' => 'no user']);
        }

        if ($user->method != "google") {
            $method = $user->method;
            return new ErrorResource(['data' => 'this user use ' . $method . ' method']);
        }

        if ($user->banned == 1) {
            return new ErrorResource(['data' => 'user is banned']);
        }

        $user->generateToken();

        return new SuccessResource($user);

    }

    public function apiPhoneLogin(Request $request)
    {
        $token = $request->input('token');

        $tokenParts = explode(".", $token);
        $tokenPayload = base64_decode($tokenParts[1]);
        $jwtPayload = json_decode($tokenPayload);

        $phone = str_replace("+" , "" , $jwtPayload->phone_number);

        $user = User::where('phone', $phone)->first();

        if ($user == null) {
            $user = new User;
            $user->phone = $phone;
            $user->name = "user-" . Str::random(6);
        }

        if ($user->banned == 1) {
            return new ErrorResource(['data' => 'user is banned']);
        }

        $user->generateToken();

        return new SuccessResource($user);
    }

    public function apiFacebookLogin(Request $request)
    {

        $token = $request->input('token');

        $tokenParts = explode(".", $token);
        $tokenPayload = base64_decode($tokenParts[1]);
        $jwtPayload = json_decode($tokenPayload);

        $user = User::where('email', $jwtPayload->email)->first();

        if ($user == null) {
            return new ErrorResource(['data' => 'no user']);
        }

        if ($user->method != "facebook") {
            $method = $user->method;
            return new ErrorResource(['data' => 'this user use ' . $method . ' method']);
        }

        if ($user->banned == 1) {
            return new ErrorResource(['data' => 'user is banned']);
        }

        $user->generateToken();

        return new SuccessResource($user);
    }

    public function apiResetPassword(Request $request)
    {
        $phone = $request->input('phone');
        $password = $request->input('password');

        $user = User::where('phone', $phone)->first();

        if ($user == null) {
            return new ErrorResource(['data' => 'no user']);
        }

        if ($user->method != "password") {
            $method = $user->method;
            return new ErrorResource(['data' => 'this user use ' . $method . ' method']);
        }

        if ($user->banned == 1) {
            return new ErrorResource(['data' => 'user is banned']);
        }

        $user->password = Hash::make($password);
        $user->save();

        return new SuccessResource($user);
    }

    public function apiChangePassword(Request $request)
    {
        $id = $request->input('id');
        $password = $request->input('password');

        $user = User::find($id);

        if ($user == null) {
            return new ErrorResource(['data' => 'no user']);
        }

        if ($user->method != "password") {
            $method = $user->method;
            return new ErrorResource(['data' => 'this user use ' . $method . ' method']);
        }

        if ($user->banned == 1) {
            return new ErrorResource(['data' => 'user is banned']);
        }

        $user->password = Hash::make($password);
        $user->save();

        return new SuccessResource($user);
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
}
