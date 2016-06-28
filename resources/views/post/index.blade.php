@extends('layouts.app')

@section('content')
    <div class="col-md-10 col-md-offset-1">
        <h1>{{ trans('posts.list_all_my_posts') }}</h1>

        @each('partials.post', $posts, 'post');

        {{ $posts->links() }}
    </div>
@endsection