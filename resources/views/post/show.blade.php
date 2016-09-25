@extends('layouts.app')

@section('content')
	@include('partials.post', ['post' => $post, 'isCommentsView' => true])

	<div class="col-sm-10 col-sm-push-2">
		@include('partials.comments',
				 ['comments' => $post->comments,
				  'commentableType' => 'Korona\Post',
				  'commentableId' => $post->id])
	</div>
@endsection
