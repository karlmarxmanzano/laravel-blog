@extends('layouts.app')

@section('content')
	<div class="col-md-12">
		<div class="d-flex flex-column">
			<div class="p-2">
				<blockquote class="blockquote">
					<h1 class="display-4 text-justify">{{ $post->title }}</h1>
					<footer class="blockquote-footer">
						<cite title="Source Title">
							@if($post->user_id == auth()->id()) 
								you 
							@else
								{{ $post->user->name ?? 'Anonymous' }} 
							@endif
						</cite> 
						on {{ $post->created_at->toFormattedDateString() }}
					</footer>
				</blockquote>
			</div>
			<div class="p-2">
				@can('update', $post)
					<a href="{{ route('post.edit', $post) }}" class="btn btn-outline-info" role="button" aria-pressed="true">Edit</a>
				@endcan
				@can('delete', $post)
					<a class="btn btn-outline-danger" role="button" onclick="event.preventDefault(); document.getElementById('delete-post').submit();">
		            	Delete
		        	</a>
		        	<form id="delete-post" action="{{ route('post.destroy', ['post' => $post]) }}" method="post" style="display: none;">
		                @csrf
		                @method('DELETE')
		            </form>
				@endcan
			</div>
			<div class="p-2">
				<p class="text-justify">{{ $post->body }}</p>
			</div>
			<div class="p-2">
				<img class="img-fluid mx-auto d-block" src="{{ asset('storage/images/'. $post->img) }}">
			</div>
			<div class="p-2">
				<span class="fa fa-comments"aria-hidden="true"></span>
				<small>
					@if (count($post->comments) > 0)
						{{ $post->comments()->count() }} {{ Str::plural('comment', $post->comments()->count()) }}.
					@else
						No comments Found.
					@endif  
				</small>
			</div>
			<div class="pt-12 pl-4">
				@foreach($post->comments as $comment)
					<div class="d-flex flex-row">
					  	<div class="p-2">
							<p class="text-justify">
								<b>{{ $comment->user->name ?? $comment->name ?? 'Anonymous' }}</b> {{ $comment->comment }}
								<small>
									{{ $comment->created_at->diffForHumans() }}
								</small>
							</p>
						</div>
						<div class="p-2">
							<!-- @can('update', $comment)
								<a href=""><span class="btn-edit"><i class="fa fa-pencil" aria-hidden="true"></i></span></a>
							@endcan -->
						</div>
						<div class="p-2">
							@can('delete', $comment)
								<a href="" class="btn-trash"><span><i class="fa fa-trash" aria-hidden="true" onclick="event.preventDefault(); document.getElementById('delete-comment').submit();"></i></span></a>
								<form id="delete-comment" action="{{ route('comment.destroy', ['comment' => $comment]) }}" method="post" style="display: none;">
					                @csrf
					                @method('DELETE')
					            </form>
							@endcan
						</div>
					</div>
				@endforeach
			</div>
			<div class="pt-2">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Add new comment</h5>
						<form id="comment-form" action="{{ route('comment.store', ['post' => $post]) }}"  method="post">
							@csrf
							@method('POST')
							@include('comment.form')
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>	
@endsection