<div class="comments" data-count="{{ count($comments) }}">
    @forelse ($comments as $comment)
        <div class="comment likable dislikable row" id="comment-{{ $comment->id }}">
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
                    @if ($comment->updated_at != $comment->created_at)
                        &middot;
                        {{ trans('app.last_edit') }}
                        {{ $comment->getUpdateTimeDifference() }}
                    @endif
                    &middot;
                    <button
                        class="btn btn-xs btn-like {{ $comment->wasLikedBy(Auth::user()) ? 'btn-success' : 'btn-default' }}"
                        data-id="{{ $comment->id }}" data-type="Korona\Comment">
                        <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                        <span class="likes-count">{{ count($comment->likes) }}</span>
                    </button>
                    &middot;
                    <button
                        class="btn btn-xs btn-dislike {{ $comment->wasDislikedBy(Auth::user()) ? 'btn-danger' : 'btn-default' }}"
                        data-id="{{ $comment->id }}" data-type="Korona\Comment">
                        <i class="fa fa-thumbs-down" aria-hidden="true"></i>
                        <span class="dislikes-count">{{ count($comment->dislikes) }}</span>
                    </button>
                    @if ($comment->user->id == Auth::user()->id)
                        &middot;
                        <a href="{{ action('CommentController@edit', $comment) }}"
                           class="btn-edit-comment">{{ trans('app.edit') }}</a>
                        &middot;
                        <a class="btn-delete-comment"
                           data-action="{{ action('CommentController@destroy', $comment) }}"
                           data-toggle="modal" data-target="#deleteCommentModal">{{ trans('app.delete') }}</a>                      </a>
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
                {{ trans('app.your_comment') }} {!! manual_link('Kommentare') !!}
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

<div class="modal fade" tabindex="-1" role="dialog" id="deleteCommentModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">{{ trans('app.really_delete_comment_title') }}</h4>
            </div>
            <div class="modal-body">
                <p>{{ trans('app.really_delete_comment_body') }}</p>
            </div>
            <div class="modal-footer">
                <form method="post" action="">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        {{ trans('app.close') }}
                    </button>
                    <button type="submit" class="btn btn-danger">
                        {{ trans('app.delete_comment') }}
                    </button>
                    {!! csrf_field() !!}
                    {!! method_field('delete') !!}
                </form>
            </div>
        </div>
    </div>
</div>