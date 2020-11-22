<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('twitch')->redirect();
    }

    /**
     * Logs the user out and redirects to home
     *
     * @return \Illuminate\Http\Response
     */
    public function handleLogout()
    {
        Auth::logout();

        return redirect()->route('home');
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $social = Socialite::driver('twitch')->user();

        $user = User::firstOrCreate(
            [
                'id' => $social->getId()
            ],
            [
                'refresh_token' => $social->refreshToken,
                'token' => $social->token,
                'email' => $social->getEmail(),
                'name' => $social->getName()
            ]
        );

        Auth::login($user);

        return redirect()->route('home');
    }
}
