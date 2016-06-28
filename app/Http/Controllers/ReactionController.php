<?php

namespace Korona\Http\Controllers;

use Illuminate\Http\Request;
use Korona\Http\Requests;
use Korona\Like;
use Korona\Dislike;
use Korona\Comment;
use Auth;

class ReactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getComments(Request $request)
    {
        if (!$request->has('commentable_type') || !$request->has('commentable_id')) {
            // Bad Request
            return new JsonResponse(['status' => 'ERR', 'message' => trans('app.bad_request')], 400);
        }
        switch ($request->input('commentable_type')) {
            case 'Korona\Post':
                $target = \Korona\Post::findOrFail($request->input('commentable_id'));
                break;
            default:
                return new JsonResponse(['status' => 'ERR', 'message' => trans('app.bad_request')], 400);
        }
        return $this->returnCommentsView($target);
    }

    public function postComment(Request $request)
    {
        if (!$request->has('commentable_type') || !$request->has('commentable_id')) {
            // Bad Request
            return new JsonResponse(['status' => 'ERR', 'message' => trans('app.bad_request')], 400);
        }
        switch ($request->input('commentable_type')) {
            case 'Korona\Post':
                $target = \Korona\Post::findOrFail($request->input('commentable_id'));
                break;
            default:
                return new JsonResponse(['status' => 'ERR', 'message' => trans('app.bad_request')], 400);
        }
        $comment = new Comment();
        $comment->user_id = Auth::user()->id;
        $comment->body = $request->input('body');
        $target->comments()->save($comment);
        return $this->returnCommentsView($target);
    }

    public function postLike(Request $request)
    {
        if (!$request->has('likable_type') || !$request->has('likable_id')) {
            // Bad Request
            return new JsonResponse(['status' => 'ERR', 'message' => trans('app.bad_request')], 400);
        }
        switch ($request->input('likable_type')) {
            case 'Korona\Post':
                $target = \Korona\Post::findOrFail($request->input('likable_id'));
                break;
            default:
                return new JsonResponse(['status' => 'ERR', 'message' => trans('app.bad_request')], 400);
        }
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

    public function postDislike(Request $request)
    {
        if (!$request->has('dislikable_type') || !$request->has('dislikable_id')) {
            // Bad Request
            return new JsonResponse(['status' => 'ERR', 'message' => trans('app.bad_request')], 400);
        }
        switch ($request->input('dislikable_type')) {
            case 'Korona\Post':
                $target = \Korona\Post::findOrFail($request->input('dislikable_id'));
                break;
            default:
                return new JsonResponse(['status' => 'ERR', 'message' => trans('app.bad_request')], 400);
        }
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

    public function returnCommentsView($target)
    {
        $target->fresh();
        $comments = $target->comments()->orderBy('created_at')->get();
        return view('partials.comments', ['comments' => $comments]);
    }
}
