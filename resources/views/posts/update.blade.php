@extends('layouts.master')

@section('content')
	<div class="col-sm-8 blog-main">	
		<h1>Update a Post</h1>	

		  <div class="form-group">
		    <label for="title">Title</label>
		    <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}">
		  </div>

		  <div class="form-group">
		    <label for="body">Body</label>
		    <textarea id="body" name="body" class="form-control" rows="20">{{ $post->body }}</textarea>
		  </div>

		  <div class="form-group"> 
		  	<button type="button" id="update-post" class="btn btn-primary">Update</button>
		  </div> 
		 
		 	@include('layouts.errors')
	</div>
@stop

@section('scripts')
<script type="text/javascript">
	$( document ).ready(function() {
			$('#update-post').click(function() {
				$('#update-post').prop('disabled', true);
				axios.put('/posts/{{ $post->id }}', {title: $('#title').val(), body: $('#body').val()})
				.then(function() {
					window.location.href = '/posts/{{ $post->id }}';
				});
			});
	})
</script>
@stop