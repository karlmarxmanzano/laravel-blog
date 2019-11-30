@extends('layouts.app')

@section('content')
	@auth
		<div>
			@if (session('status'))
			    <div class="alert alert-success">
			        {{ session('status') }}
			    </div>
			@endif
			<div class="card">
				<div class="card-body">
					<h5 class="card-title">New Blog Post</h5>
					<form id="post-form" action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
						@csrf
						@method('POST')
						@include('post.form')
					</form>
				</div>
			</div>
		</div>
	@endauth
	<div class="py-4">
		@foreach($posts as $post)
			<div class="row">
				<div class="col-md-12">
					<div class="col-md-4 float-left">
						<div class="d-flex flex-column">
							<img src="{{ asset('storage/images/'. $post->img) }}" class="d-block" />
						</div>
					</div>
					<div class="col-md-8 float-right">
						<div class="d-flex flex-column">
							<div class="p-2">
								<h5>{{ $post->title }}</h5>
								<p><i>by @if($post->user_id == auth()->id()) you @else {{ $post->user->name ?? 'Anonymous' }} @endif </i> on {{ $post->created_at->toFormattedDateString() }}</p>
							</div>
							<div class="p-1">
								@can('update', $post)
									<a href="{{ route('post.edit', $post) }}" class="btn btn-outline-info btn-sm" role="button" aria-pressed="true">Edit</a>
								@endcan
								@can('delete', $post)
									<a href="" class="btn btn-outline-danger btn-sm" role="button" onclick="event.preventDefault(); document.getElementById('delete-post').submit();">
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
								<span class="fa fa-comments"aria-hidden="true"></span>
								<small>
									@if (count($post->comments) > 0)
										{{ $post->comments()->count() }} {{ Str::plural('comment', $post->comments()->count()) }}
									@else
										No comments Found.
									@endif  
								</small>
							</div>
							<div class="p-2">
								<p><a href="{{ route('post.show', ['post' => $post]) }}">Read more &rarr;</a></p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<hr />
		@endforeach
		
	<div class="col-md-12">
		<div class="d-flex justify-content-center">
			{{ $posts->links() }}
		</div>
	</div>
@endsection