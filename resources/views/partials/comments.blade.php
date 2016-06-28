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
                @if ($comment->user->id == Auth::user()->id)
                    &middot; <a class="btn-delete-comment" data-id="{{ $comment->id }}">{{ trans('app.delete') }}</a>
                @endif
                &middot; <a class="btn-flag-comment" data-id="{{ $comment->id }}">{{ trans('app.flag') }}</a>
            </div>
        </div>
    </div>
@empty
    {{ trans('app.no_comments') }}
@endforelse
