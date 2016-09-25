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
use Korona\Post;
use Auth;

class PostController extends Controller
{
    /**
     * Erzeuge eine neue Instanz dieses Controllers
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Gib eine View mit allen Posts dieses Nutzers zurück
     * @return \Illuminate\Http\Response View
     */
    public function index()
    {
        $posts = Post::where(['user_id' => Auth::user()->id])
                     ->orderBy('created_at', 'desc')
                     ->paginate(15);
        return view('post.index', ['posts' => $posts]);
    }

    /**
     * Zeige ein Formular zur Erstellung eines neuen Posts an
     * @return \Illuminate\Http\Response View
     */
    public function create()
    {
        //
    }

    /**
     * Speichere einen neu erzeugten Post in der Datenbank
     * @param  \Illuminate\Http\Request  $request Die Anfrage
     * @return \Illuminate\Http\Response View mit dem neu erzeugten Post
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Zeige einen Post an
     * @param  int  $id ID des Posts
     * @return \Illuminate\Http\Response View des Posts
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);

        return view('post.show', ['post' => $post]);
    }

    /**
     * Zeige ein Formular zur Bearbeitung eines Posts an
     * @param  int  $id ID des Posts
     * @return \Illuminate\Http\Response Bearbeitungsformular
     */
    public function edit($id)
    {
        //
    }

    /**
     * Speichere Änderungen an diesem Post in der Datenbank
     * @param  \Illuminate\Http\Request  $request Anfrage
     * @param  int  $id ID des Posts
     * @return \Illuminate\Http\Response View des Posts
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Lösche den Post aus der Datenbank
     * @param  int  $id ID des Posts
     * @return \Illuminate\Http\Response View
     */
    public function destroy($id)
    {
        //
    }
}
