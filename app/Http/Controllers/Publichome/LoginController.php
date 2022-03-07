<?php

namespace App\Http\Controllers\Publichome;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:user')->except('logout');
    }

    public function index() {
        return view('public.login.index');
    }

    protected function guard()
    {
        return Auth::guard('user');
    }

    protected function credentials(Request $request) {
        return  array_merge($request->only($this->username(), 'password'), ['user_role_id' => 2, 'email_verification' => 1, 'status' => 1]);
    }

    public function logout(Request $request) {
        Auth::guard('user')->logout();
        return redirect(route('home'));
    }
}
