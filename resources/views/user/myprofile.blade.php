@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <form method="post" action="{{ action('PostController@store') }}" class="form">
                <div class="form-group">
                    <label for="txtPostBody">{{ trans('posts.new_post') }}</label>
                    <textarea class="form-control" name="body" id="txtPostBody"
                              placeholder="{{ trans('posts.placeholder') }}">{{ old('body') }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary pull-right">
                    {{ trans('posts.make_post') }}
                </button>
                {!! csrf_field() !!}
                <input type="hidden" name="postable_type" value="Korona\User">
                <input type="hidden" name="postable_id" value="{{ Auth::user()->id }}">
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            @each('partials.post', $posts, 'post')

            {{ $posts->links() }}
        </div>
    </div>
@endsection
