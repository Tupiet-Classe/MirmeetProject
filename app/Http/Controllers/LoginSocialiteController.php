<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\UserController;

class LoginSocialiteController extends Controller
{
    public function Google(Request $request)
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback(Request $request)
    {
        $user = Socialite::driver('google')->user();

        $userexist = User::where('external_id', $user->id)->where('external_auth', 'google')->first();


        if($userexist){
            Auth::login($userexist);
        } else{
            $userexist = User::create([

                'name' => $user->name,
                'username' => $user->name,
                'email' => $user->email,
                'avatar' => $user->avatar,
                'external_id' => $user->id,
                'external_auth' => 'google',
            ]);

            Auth::login($userexist);
        }
        return redirect('/dashboard');
    }

    public function Github(Request $request)
    {
        return Socialite::driver('github')->redirect();
    }

    public function githubCallback(Request $request)
    {
        $user = Socialite::driver('github')->user();
    //dd($user);
    $userexist = User::where('email', $user->email)->first();

    if($userexist){
        Auth::login($userexist);
    } else {
        $userexist = User::create([
            'name' => $user->nickname,
            'username' => $user->nickname,
            'email' => $user->email,
            'avatar' => $user->avatar,
            'external_id' => $user->id,
            'external_auth' => 'github',
        ]);
        Auth::login($userexist);
    }

    return redirect('/dashboard');

    }
}
