@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<form method="post" action="{{ action('PostController@update', $post) }}">
				<div class="form-group">
					<label for="txtPostBody">{{ trans('posts.edit_post') }}</label>
					<textarea name="body" id="txtPostBody" class="form-control">{{ $post->body }}</textarea>
				</div>
				<button type="submit" class="btn btn-primary pull-right">
					{{ trans('posts.save') }}
				</button>
				{!! csrf_field() !!}
				{!! method_field('put') !!}
			</form>
		</div>
	</div>
@endsection
