@extends('layout.app')

@section('content')
	<h3> {{ $post->name ?? 'Anonymous' }} </h3>
	<h3> {{ $post->post }} </h3>

	@foreach($post->comments as $comment)
		<p>{{ $comment->comment }}</p>
	@endforeach
				
@endsection