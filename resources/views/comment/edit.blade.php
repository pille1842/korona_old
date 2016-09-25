@extends('layouts.app')

@section('content')
	<form class="form" method="post" action="{{ action('CommentController@update', $comment) }}">
		<div class="form-group">
			<label for="body">
				{{ trans('app.edit_comment') }}
			</label>
			<textarea name="body" id="body" class="form-control">{{ $comment->body }}</textarea>
		</div>
		<button class="btn btn-primary" type="submit">{{ trans('app.post_comment') }}</button>
		{!! csrf_field() !!}
		{!! method_field('put') !!}
	</form>
@endsection
