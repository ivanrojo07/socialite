<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class FacebookLoginController extends Controller
{
    //

    public function login(Request $request)
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function callback(Request $request)
    {
        $user_fb = Socialite::driver('facebook')->user();
        $user = User::firstOrCreate(
            ['email' =>  $user_fb->email],
            [
                'name' => $user_fb->name,
                'email' => $user_fb->email,
                'password' => Hash::make($user_fb->id)
            ]);

        auth()->login($user,true);
        return redirect()->route('home');
    }
}
