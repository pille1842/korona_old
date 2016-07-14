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
use Korona\Like;
use Korona\Dislike;
use Korona\Comment;
use Auth;

class ReactionController extends Controller
{
    /**
     * Instanziiere einen ReactionController
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Gib eine View mit allen Kommentaren für ein kommentierbares Objekt zurück
     * @param  \Illuminate\Http\Request  $request Die Anfrage
     * @return \Illuminate\Http\Response Die Kommentar-View
     */
    public function getComments(Request $request)
    {
        $this->validate($request, [
            'commentable_type' => 'required|in:Korona\Post',
            'commentable_id'   => 'required|integer',
        ]);

        $class = '\\'.$request->input('commentable_type');
        $target = $class::findOrFail($request->input('commentable_id'));

        return $this->returnCommentsView($target);
    }

    /**
     * Speichere einen neuen Kommentar zu einem kommentierbaren Objekt
     * @param  \Illuminate\Http\Request  $request Die Anfrage
     * @return \Illuminate\Http\Response Die ergänzte Kommentar-View
     */
    public function postComment(Request $request)
    {
        $this->validate($request, [
            'commentable_type' => 'required|in:Korona\Post',
            'commentable_id'   => 'required|integer',
            'body'             => 'required',
        ]);

        $class = '\\'.$request->input('commentable_type');
        $target = $class::findOrFail($request->input('commentable_id'));
        $comment = new Comment();
        $comment->user_id = Auth::user()->id;
        $comment->body = $request->input('body');
        $target->comments()->save($comment);

        return $this->returnCommentsView($target);
    }

    /**
     * Speichere ein "Like" zu einem geeigneten Objekt
     * @param  \Illuminate\Http\Request  $request Die Anfrage
     * @return \Illuminate\Http\Response Ein JSON-Objekt mit der Anzahl von Likes und Dislikes
     */
    public function postLike(Request $request)
    {
        $this->validate($request, [
            'likable_type' => 'required|in:Korona\Post,Korona\Comment',
            'likable_id'   => 'required|integer',
        ]);

        $class = '\\'.$request->input('likable_type');
        $target = $class::findOrFail($request->input('likable_id'));
        if (!$target->wasLikedBy(Auth::user())) {
            if ($target->wasDislikedBy(Auth::user())) {
                $target->dislikes()->where(['user_id' => Auth::user()->id])->delete();
            }
            $like = new Like();
            $like->user_id = Auth::user()->id;
            $target->likes()->save($like);
        } else {
            $target->likes()->where(['user_id' => Auth::user()->id])->delete();
        }

        return response()->json([
            'status' => 'OK',
            'likes_count' => $target->likes()->count(),
            'dislikes_count' => $target->dislikes()->count(),
        ]);
    }

    /**
     * Speichere ein "Dislike" zu einem geeigneten Objekt
     * @param  \Illuminate\Http\Request  $request Die Anfrage
     * @return \Illuminate\Http\Response Ein JSON-Objekt mit der Anzahl von Likes und Dislikes
     */
    public function postDislike(Request $request)
    {
        $this->validate($request, [
            'dislikable_type' => 'required|in:Korona\Post,Korona\Comment',
            'dislikable_id'   => 'required|integer',
        ]);

        $class = '\\'.$request->input('dislikable_type');
        $target = $class::findOrFail($request->input('dislikable_id'));
        if (!$target->wasDislikedBy(Auth::user())) {
            if ($target->wasLikedBy(Auth::user())) {
                $target->likes()->where(['user_id' => Auth::user()->id])->delete();
            }
            $dislike = new Dislike();
            $dislike->user_id = Auth::user()->id;
            $target->dislikes()->save($dislike);
        } else {
            $target->dislikes()->where(['user_id' => Auth::user()->id])->delete();
        }

        return response()->json([
            'status' => 'OK',
            'likes_count' => $target->likes()->count(),
            'dislikes_count' => $target->dislikes()->count(),
        ]);
    }

    /**
     * Gib eine Kommentar-View zurück
     * @param  mixed $target        Ein kommentierbares Objekt
     * @return \Illuminate\View\View Die Kommentar-View
     */
    private function returnCommentsView($target)
    {
        $target->fresh();
        $comments = $target->comments()->orderBy('created_at')->get();

        return view('partials.comments', ['comments' => $comments]);
    }
}
