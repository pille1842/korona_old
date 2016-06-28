<?php

namespace Korona\Http\Controllers;

use Illuminate\Http\Request;
use Korona\Http\Requests;
use Auth;
use Korona\User;

class UserController extends Controller
{
    /**
     * Erzeuge eine neue Instanz des Controllers.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Zeige die Profilseite des Nutzers an
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function getMyProfile(Request $request)
    {
        $user = Auth::user();
        $posts = $user->posts()->orderBy('touched_at', 'desc')->paginate(15);
        return view('user.myprofile', ['user' => $user, 'posts' => $posts]);
    }

    public function getUserProfile($handle)
    {
        $user = User::where(['handle' => $handle])->first();
        if ($user === null) {
            abort(404);
        } elseif ($user->id == Auth::user()->id) {
            return redirect('profile');
        }
        $posts = $user->posts()->orderBy('touched_at', 'desc')->paginate(15);
        return view('user.userprofile', ['user' => $user, 'posts' => $posts]);
    }
}
