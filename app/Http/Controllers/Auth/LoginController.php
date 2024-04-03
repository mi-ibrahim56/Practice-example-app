<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Notification;
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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected function redirectPath()
    {
    // Return the path to which you want to redirect users after login
    return '/dashboard'; // Adjust this to your dashboard route
    }
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user){
        if (!$user->hasVerifiedEmail()) {
            $user->sendEmailVerificationNotification(); // Send verification email if not verified
            Auth::logout(); // Log out the user
            return redirect('/logout')->with('error', 'Your email is not verified. Please verify your email address.');
        }
    
        // Proceed with default login behavior if the email is verified
        return redirect()->intended($this->redirectPath());
    }
    
    
    
}
