@extends("layouts.app")


@section("title", "Edit Post")


@section("content")
    <h1 class="text-center mt-5">Edit Post</h1>

    <form action="{{ route("posts.update", ['post' => $post->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method("PUT")
        @include("posts.partials.form")

        <div class="d-grid gap-2 mt-3">
            <button type="submit" class="btn btn-dark">Update</button>
        </div> 
    </form>
@endsection