<div class="post likable dislikable">
    <div class="col-md-2">
    <img class="img-responsive" src="http://placehold.it/350x350" alt="{{ $post->user->member->nickname }}">
    </div>
    <div class="col-md-10">
        @if ($post->postable->getUrl() == $post->user->getUrl())
            <a href="{{ url('/u/' . $post->user->handle) }}"
               class="post-user">{{ $post->user->member->nickname }}</a>
        @else
            <a href="{{ url('/u/' . $post->user->handle) }}"
               class="post-user">{{ $post->user->member->nickname }}</a>
            &rarr;
            <a href="{{ $post->postable->getUrl() }}"
               class="post-user">{{ $post->postable->getGenericName() }}</a>
        @endif
        <br>
        <div class="post-date">
            {{ $post->getCreationTimeDifference() }}
            @if ($post->updated_at != null)
                ({{ trans('app.last_edit') }} {{ $post->getUpdateTimeDifference() }})
            @endif
        </div>
        <div class="post-body">
            {!! $post->getFormattedBody() !!}
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-2">
            <button class="btn btn-default btn-small btn-like {{ $post->wasLikedBy(Auth::user()) ? 'btn-success' : '' }}"
                data-id="{{ $post->id }}" data-type="Korona\Post">
                <span class="likes-count">{{ $post->likes->count() }}</span>
                <i class="fa fa-thumbs-up" aria-hidden="true"></i>
            </button>
            <button
                class="btn btn-default btn-small btn-dislike {{ $post->wasDislikedBy(Auth::user()) ? 'btn-danger' : '' }}"
                data-id="{{ $post->id }}" data-type="Korona\Post">
                <span class="dislikes-count">{{ $post->dislikes->count() }}</span>
                <i class="fa fa-thumbs-down" aria-hidden="true"></i>
            </button>
            @if ((isset($isCommentsView) && !$isCommentsView) || !isset($isCommentsView))
            <a href="{{ action('PostController@show', $post->id) }}"
               class="btn btn-default btn-small btn-comments">
                <span class="comments-count">{{ $post->comments->count() }}</span>
                <i class="fa fa-comments" aria-hidden="true"></i>
            </a>
            @endif
            <div class="btn-group">
                <button class="btn btn-default btn-small dropdown-toggle"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-cog" aria-hidden="true"></i> <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                <li><a href="#" class="btn-permalink-post" data-id="{{ $post->id }}"
                       data-toggle="modal" data-target="#permalinkModal{{ $post->id }}">
                    <i class="fa fa-link" aria-hidden="true"></i> {{ trans('posts.permalink') }}
                </a></li>
                <li><a href="#" class="btn-flag-post" data-id="{{ $post->id }}">
                    <i class="fa fa-flag" aria-hidden="true"></i> {{ trans('app.flag') }}
                </a></li>
                @if (Auth::user()->id == $post->user_id)
                    <li><a href="#" class="btn-edit-post" data-id="{{ $post->id }}">
                        <i class="fa fa-pencil" aria-hidden="true"></i> {{ trans('app.edit') }}
                    </a></li>
                    <li><a href="#" class="btn-delete-post" data-id="{{ $post->id }}">
                        <i class="fa fa-trash" aria-hidden="true"></i> {{ trans('app.delete') }}
                    </a></li>
                @endif
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="permalinkModal{{ $post->id }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">{{ trans('posts.permalink') }}</h4>
            </div>
            <div class="modal-body">
                <div class="input-group">
                    <input type="text" class="form-control input-permalink" id="input-permalink-{{ $post->id }}" value="{{ action('PostController@show', $post->id) }}" readonly>
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-default btn-clipboard"
                                data-clipboard-target="#input-permalink-{{ $post->id }}"
                                data-toggle="tooltip" title="{{ trans('app.copy_to_clipboard') }}">
                            <i class="fa fa-clipboard" aria-hidden="true"></i>
                        </button>
                    </span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    {{ trans('app.close') }}
                </button>
            </div>
        </div>
    </div>
</div>
