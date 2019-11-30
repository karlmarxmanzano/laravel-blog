<div class="form-group">
    <label for="post_title">Title</label>
    <input type="text" class="form-control @error('post_title') is-invalid @enderror" id="post_title" name="post_title" value="{{ old('post_title') ?? $post->title ?? '' }}" autocomplete="post_title">
	
	@error('post_title')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="form-group">
    <label for="post_body">Post</label>
    <textarea class="form-control @error('post_body') is-invalid @enderror" id="post_body" name="post_body" rows="3">{{ old('post_body') ?? $post->body ?? '' }}</textarea>

    @error('post_body')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="form-group">
    <div class="custom-file">
        <input type="file" class="custom-file-input @error('post_img') is-invalid @enderror" id="post_img" name="post_img" value="{{ old('post_img') ?? $post->img ?? '' }}" onchange="var fileName = $(this).val(); $(this).next('.custom-file-label').html(fileName);">
        <label class="custom-file-label" for="post_img">Choose image</label>
    </div>

    @error('post_img')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<button type="submit" class="btn btn-primary">Save</button>