@forelse ($comments as $comment)
    <div class="comment row">
        <div class="col-sm-2">

        </div>
        <div class="col-sm-10">
            <a href="{{ $comment->user->getUrl() }}" class="post-user">{{ $comment->user->member->nickname }}</a>
            <div class="post-body">
                {!! $comment->getFormattedBody() !!}
            </div>
            <div class="post-date">
                {{ $comment->getCreationTimeDifference() }}
                &middot; <a class="btn-like-comment" data-id="{{ $comment->id }}">
                    <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                </a>
                &middot; <a class="btn-dislike-comment" data-id="{{ $comment->id }}">
                    <i class="fa fa-thumbs-down" aria-hidden="true"></i>
                </a>
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
