<div class="comments" data-count="{{ count($comments) }}">
    @forelse ($comments as $comment)
        <div class="comment likable dislikable row">
            <div class="col-sm-2">

            </div>
            <div class="col-sm-10">
                <a href="{{ $comment->user->getUrl() }}" class="post-user">{{ $comment->user->member->nickname }}</a>
                <div class="post-body">
                    {!! $comment->getFormattedBody() !!}
                </div>
                <div class="post-date">
                    {{ $comment->getCreationTimeDifference() }}
                    &middot;
                    <button class="btn btn-default btn-xs btn-like {{ $comment->wasLikedBy(Auth::user()) ? 'btn-primary' : '' }}"
                        data-id="{{ $comment->id }}" data-type="Korona\Comment">
                        <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                        <span class="likes-count">{{ count($comment->likes) }}</span>
                    </button>
                    &middot;
                    <button class="btn btn-default btn-xs btn-dislike {{ $comment->wasDislikedBy(Auth::user()) ? 'btn-primary' : '' }}"
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
</div>