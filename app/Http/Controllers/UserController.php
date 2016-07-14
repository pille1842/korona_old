<?php
/*
 * Korona - A free community management system for German-language fraternities
 * Copyright (C) 2016 Eric Haberstroh <eric@erixpage.de>
 *
 * This file is part of Korona.
 *
 * Korona is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Korona is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Korona.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace Korona\Http\Controllers;

use Illuminate\Http\Request;
use Korona\Http\Requests;
use Auth;
use Korona\User;

class UserController extends Controller
{
    /**
     * Erzeuge eine neue Instanz des Controllers
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Zeige die Profilseite des Nutzers an
     * @param  Illuminate\Http\Request Die Anfrage
     * @return Illuminate\Http\Response View des Nutzerprofils
     */
    public function getMyProfile(Request $request)
    {
        $user = Auth::user();
        $posts = $user->posts()->orderBy('touched_at', 'desc')->paginate(15);
        return view('user.myprofile', ['user' => $user, 'posts' => $posts]);
    }

    /**
     * Zeige ein bestimmtes Nutzerprofil an
     * @param  string $handle URL-freundliches Handle des Nutzers
     * @return Illuminate\Http\Response View des Nutzerprofils
     */
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
