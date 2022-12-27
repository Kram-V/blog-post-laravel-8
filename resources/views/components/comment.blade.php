@auth
<form action="{{ $route }}" method="POST">
    @csrf
    <textarea class="form-control" id="content" type="text" name="content">{{ old("content") }}</textarea>

    @error("content")
        <div class="text-danger">{{ $message }}</div>
    @enderror

    <div class="d-grid gap-2 mt-3">
        <button type="submit" class="btn btn-dark">Comment</button>
    </div> 
</form>
@endauth
