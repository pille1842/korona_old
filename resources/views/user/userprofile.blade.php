@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            User {{ $user->member->getFullName() }}

            @each('partials.post', $posts, 'post')

            {{ $posts->links() }}
        </div>
    </div>
@endsection
