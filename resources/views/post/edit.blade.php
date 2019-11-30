@extends('layouts.app')

@section('content')
	<div class="col-md-12">
		@if (session('status'))
		    <div class="alert alert-success">
		        {{ session('status') }}
		    </div>
		@endif
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Edit Blog Post</h5>
				<form id="post-form" action="{{ route('post.update', $post) }}" method="post" enctype="multipart/form-data">
					@csrf
					@method('PATCH')
					@include('post.form')
				</form>
			</div>
		</div>
	</div>
@endsection