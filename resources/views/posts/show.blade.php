@extends('layouts.master')

@section ('content')
	<div class="col-sm-8 blog-main">	
		<h1>{{ $post->title }}</h1>

		{{ $post->body }}	

		<hr>

		<div class="comments">
			<ul class="list-group">
			@foreach ($post->comments as $comment)
				<li class="list-group-item">
					<strong>
						{{ $comment->created_at->diffForHumans() }}: &nbsp;
					</strong>
					{{ $comment->body }}
				</li>
			@endforeach
			</ul>
		</div>

		<hr>

		<div class="card">
			<div class="card-block">
				<form method="POST" action="/posts/{{ $post->id }}/comments">
					{{ csrf_field() }}
					
					<div class="form-group">
		    		<textarea name="body" class="form-control" placeholder="Enter a Comment"></textarea>
					</div>

					<div class="form-group">
						<div class="form-group"> 
		  				<button type="submit" class="btn btn-primary">Add Comment</button>
		  				<button type="button" class="btn btn-danger" id="delete-post">Delete Post</button>
		  				<a href="/posts/{{ $post->id }}/update" type="button" class="btn btn-success">Update Post</a>
		 				 </div> 
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
<script type="text/javascript">
	$( document ).ready(function() {
			$('#delete-post').click(function() {
				$('#delete-post').prop('disabled', true);
				axios.delete('/posts/{{ $post->id }}')
				.then(function() {
					window.location.href = '/'
				});
			});
	})
</script>
@endsection