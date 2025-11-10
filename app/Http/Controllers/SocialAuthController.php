<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function  googleRedirect()
    {
        return Socialite::driver('google')
        ->scopes(['openid', 'profile', 'email', 'https://www.googleapis.com/auth/user.phonenumbers.read'])
        ->redirect();
    }

    public function googleCallback()
    {
        $user = Socialite::driver('google')->user();


        $accessToken = $user->token;

        $response = Http::withToken($accessToken)
            ->get('https://people.googleapis.com/v1/people/me?personFields=phoneNumbers');

        $phone = optional($response->json()['phoneNumbers'][0])['value'] ?? null;

        dd($phone);
        
        $oldUser = User::where('email', $user->email)->first();

        if ($oldUser) {
            auth()->login($oldUser);
            return redirect()->route('home');
        }

        $user = User::create([
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'password' => bcrypt('Password123345678'),
            'social_id' => $user->id,
        ]);

        auth()->login($user);

        return redirect()->route('home');

    }
}
