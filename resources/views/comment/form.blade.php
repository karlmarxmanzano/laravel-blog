@guest
    <div class="form-group" >
        <label for="comment_name">Name</label>
        <input type="text" class="form-control @error('commentor_name') is-invalid @enderror" id="commentor_name" name="commentor_name" value="{{ old('commentor_name') }}" autocomplete="commentor_name" placeholder="Enter name">

        @error('commentor_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
@endguest
<div class="form-group">
    <label for="comment">Add comment</label>
    <textarea class="form-control @error('comment') is-invalid @enderror" id="comment" name="comment" rows="3" value="{{ old('comment') }}" required=""></textarea>

    @error('comment')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<button type="submit" class="btn btn-primary">Save</button>