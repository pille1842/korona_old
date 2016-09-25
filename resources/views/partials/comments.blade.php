<div class="comments" data-count="{{ count($comments) }}">
    @forelse ($comments as $comment)
        <div class="comment likable dislikable row">
            <div class="col-sm-1">
            <img class="img-responsive"
                 src="http://placehold.it/50x50" alt="{{ $comment->user->member->nickname }}">
            </div>
            <div class="col-sm-11">
                <a href="{{ $comment->user->getUrl() }}" class="post-user">{{ $comment->user->member->nickname }}</a>
                <div class="post-body">
                    {!! $comment->getFormattedBody() !!}
                </div>
                <div class="post-date">
                    {{ $comment->getCreationTimeDifference() }}
                    &middot;
                    <button class="btn btn-default btn-xs btn-like {{ $comment->wasLikedBy(Auth::user()) ? 'btn-success' : '' }}"
                        data-id="{{ $comment->id }}" data-type="Korona\Comment">
                        <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                        <span class="likes-count">{{ count($comment->likes) }}</span>
                    </button>
                    &middot;
                    <button class="btn btn-default btn-xs btn-dislike {{ $comment->wasDislikedBy(Auth::user()) ? 'btn-danger' : '' }}"
                        data-id="{{ $comment->id }}" data-type="Korona\Comment">
                        <i class="fa fa-thumbs-down" aria-hidden="true"></i>
                        <span class="dislikes-count">{{ count($comment->dislikes) }}</span>
                    </button>
                    @if ($comment->user->id == Auth::user()->id)
                        &middot; <a class="btn-edit-comment" data-id="{{ $comment->id }}">{{ trans('app.edit') }}</a>
                        &middot; <a class="btn-delete-comment" data-id="{{ $comment->id }}">{{ trans('app.delete') }}</a>
                    @endif
                    &middot; <a class="btn-flag-comment" data-id="{{ $comment->id }}">{{ trans('app.flag') }}</a>
                </div>
            </div>
        </div>
    @empty
        {{ trans('app.no_comments') }}
    @endforelse

    <div class="row form-comment">
        <form class="form" method="post" action="{{ action('CommentController@store') }}">
            <div class="form-group">
                <label for="body">
                {{ trans('app.your_comment') }}
                </label>
                <input type="text" class="form-control" name="body" id="body"
                       placeholder="{{ trans('app.write_a_comment') }}">
            </div>
            <button class="btn btn-primary pull-right" type="submit">{{ trans('app.post_comment') }}</button>
            <input type="hidden" name="commentable_type" value="{{ $commentableType }}">
            <input type="hidden" name="commentable_id" value="{{ $commentableId }}">
            {!! csrf_field() !!}
        </form>
    </div>
</div>
