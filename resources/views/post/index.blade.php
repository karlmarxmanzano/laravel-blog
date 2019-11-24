@extends('layout.app')

@section('content')
	
	<div>
		@foreach($posts as $post)
			<h3> {{ $post->name ?? 'Anonymous' }} </h3>
			<h3> {{ $post->post }} </h3>

			<a class="btn btn-info" href="{{ route('post.show', ['post' => $post]) }}">View</a>
			<a class="btn btn-warning" href="{{ route('post.edit', ['post' => $post]) }}">Edit</a>
			<a class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('delete-post').submit();">
            	Delete
        	</a>
            <form id="delete-post" action="{{ route('post.destroy', ['post' => $post]) }}" method="post" style="display: none;">
                @csrf
                @method('DELETE')
            </form>

			<div>
				@foreach($post->comments as $comment)
					<p>{{ $comment->comment }}</p>
				@endforeach
			</div>

			<form id="comment-form" action="{{ route('comment.store') }}"  method="post">
				@csrf
				@method('POST')

				<input type="text" class="form-control" id="post_id" name="post_id" value="{{ $post->id }}">


				<div class="form-group" >
				    <label for="comment_name">Name</label>
				    <input type="text" class="form-control" id="comment_name" name="comment_name" placeholder="Enter name">
				 </div>
				<div class="form-group">
				    <label for="comment">Add comment</label>
				    <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
				</div>
				<button type="submit" class="btn btn-primary">Save</button>
			</form>
		@endforeach
	</div>

	<div>
		<form id="post-form" action="{{ route('post.store') }}" method="post">
			@csrf
			@method('POST')
			<div class="form-group" >
			    <label for="name">Name</label>
			    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
			 </div>
			<div class="form-group">
			    <label for="post">Post</label>
			    <textarea class="form-control" id="post" name="post" rows="3"></textarea>
			</div>
			<button type="submit" class="btn btn-primary">Save</button>
		</form>
	</div>

@endsection