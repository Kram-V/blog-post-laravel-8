@extends("layouts.app")


@section("title", "New Post")


@section("content")
  
    <h1 class="text-center mt-5">New Post</h1>

    <form action="{{ route("posts.store") }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include("posts.partials.form")
        
        <div class="d-grid gap-2 mt-3">
            <button type="submit" class="btn btn-dark">Create</button>
        </div> 
    </form>
   
@endsection