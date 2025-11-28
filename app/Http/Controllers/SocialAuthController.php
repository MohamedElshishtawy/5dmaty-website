<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function  googleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback()
    {
        $user = Socialite::driver('google')->user();

        $oldUser = User::where('email', $user->email)->first();

        if ($oldUser) {
            Auth::login($oldUser);
            return redirect()->route('home');
        }

        $user = User::create([
            'name' => $user->name,
            'email' => $user->email,
            'password' => bcrypt('Password123345678'),
            'social_id' => $user->id,
        ]);

        Auth::login($user);

        return redirect()->route('home');

    }
}
