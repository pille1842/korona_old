@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<form method="post" action="{{ action('PostController@update', $post) }}">
				<div class="form-group">
					<label for="txtPostBody">{{ trans('posts.edit_post') }}</label>
					<textarea name="body" id="txtPostBody" class="form-control">{{ $post->body }}</textarea>
				</div>
				<div class="pull-right">
					<a href="{{ action('PostController@show', $post) }}" class="btn btn-default">
						{{ trans('app.cancel') }}
					</a>
					<button type="submit" class="btn btn-primary">
						{{ trans('posts.save') }}
					</button>
				</div>
				{!! csrf_field() !!}
				{!! method_field('put') !!}
			</form>
		</div>
	</div>
@endsection
