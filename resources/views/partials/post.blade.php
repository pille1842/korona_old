<div class="post likable dislikable">
    <div class="col-md-2">

    </div>
    <div class="col-md-10">
        <a href="{{ url('/u/' . $post->user->handle) }}" class="post-user">{{ $post->user->member->nickname }}</a>
        &rarr;
        <a href="{{ $post->postable->getUrl() }}" class="post-user">{{ $post->postable->getGenericName() }}</a>
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
            <button class="btn btn-default btn-small btn-like {{ $post->wasLikedBy(Auth::user()) ? 'btn-primary' : '' }}"
                data-id="{{ $post->id }}" data-type="Korona\Post">
                <span class="likes-count">{{ $post->likes->count() }}</span> <i class="fa fa-thumbs-up" aria-hidden="true"></i>
            </button>
            <button class="btn btn-default btn-small btn-dislike {{ $post->wasDislikedBy(Auth::user()) ? 'btn-primary' : '' }}"
                data-id="{{ $post->id }}" data-type="Korona\Post">
                <span class="dislikes-count">{{ $post->dislikes->count() }}</span> <i class="fa fa-thumbs-down" aria-hidden="true"></i>
            </button>
            <button class="btn btn-default btn-small btn-comments" data-id="{{ $post->id }}" data-type="Korona\Post">
                <span class="comments-count">{{ $post->comments->count() }}</span> <i class="fa fa-comments" aria-hidden="true"></i>
            </button>
            <div class="btn-group">
                <button class="btn btn-default btn-small dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-cog" aria-hidden="true"></i> <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                <li><a href="#" class="btn-permalink-post" data-id="{{ $post->id }}">
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