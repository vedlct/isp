<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
        $this->middleware('guest')->except('logout');
    }

//    public function redirectTo()
//    {
//
//        if (Auth::user()->fkusertype == USER_TYPE['Admin'] || Auth::user()->fkusertype == USER_TYPE['Emp']) {
//            return route('admin.dashboard');
//        }
//        elseif (Auth::user()->fkusertype == USER_TYPE['Admin']) {
//
//            $cvStatus1=Employee::where('fkuserId',Auth::user()->userId)->first();
//
//            if ($cvStatus1 != null && $cvStatus1->cvStatus == 1){
//
//                return route('job.all');
//
//            }else {
//                return route('candidate.cvPersonalInfo');
//            }
//
//
//
//        }
//
//    }
}
