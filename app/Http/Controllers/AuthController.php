<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twitchls\Auth\Twitch;

class AuthController extends Controller
{
    /**
     * Twitch Auth.
     *
     * @var Twitch
     */
    protected $auth;

    public function __construct(Twitch $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Redirects to Twitch.
     *
     * @return Response
     */
    public function login()
    {
        return $this->auth->redirect();
    }

    /**
     * Handles the Twitch callback.
     * Redirects to home.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function callback(Request $request)
    {
        \Session::put('user', $this->auth->getUser());

        return redirect('/');
    }

    /**
     * Logout the current Twitch user.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function logout(Request $request)
    {
        $request->session()->forget('user');

        return redirect('/');
    }
}
