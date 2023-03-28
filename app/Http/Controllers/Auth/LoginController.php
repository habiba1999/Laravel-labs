<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;

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

    public function redirect($provider) {

        return Socialite::driver($provider)->redirect();
    }
        public function callback ($provider) {
            
            
            $SocialUser = Socialite::driver($provider)->stateless()->user();
         //dd($SocialUser);
           $user = User::updateOrCreate([
            'provider_id' => $SocialUser->id,
        ], [
            'name' => User::generateUsername($SocialUser->nickname),
            'email' => $SocialUser->email,
            'password' => Hash::make(Str::random(8)),//create password random
            'provider_token' => $SocialUser->token,
            'provider_refresh_token' => $SocialUser->refreshToken,
        ]);
     
        Auth::login($user);
        
        return redirect('home');
            // dd($user);
         
            // $user->token
        }
}
