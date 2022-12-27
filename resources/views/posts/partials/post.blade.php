<div class="mb-5">

    @tags(["tags" => $post->tags])
    @endtags

    <a href="{{ route("posts.show", ["post" => $post->id]) }}"><h1>{{ $post->title }}</h1></a>
   
    @added(['date_created' => $post->created_at->diffForHumans(), 'name' => $post->user->name, 'userId' => $post->user->id])
    @endadded

    <p>{{ $post->content }}</p>

    <p>({{ $post->comments_count }} {{ $post->comments_count == 1 ? "Comment" : "Comments" }})</p>
  
    <div class="d-flex gap-2">
        {{-- update NAME IS THE REGISTERED POLICY --}}
        @can('update', $post)
            <a href="{{ route("posts.edit", ['post' => $post->id]) }}" class="btn btn-primary">
                Edit
            </a>
        @endcan
       

        {{-- delete NAME IS THE REGISTERED POLICY --}}
        @can('delete', $post)
            <form action="{{ route("posts.destroy", ['post' => $post->id]) }}" method="POST">
                @csrf
                @method("DELETE")

                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        @endcan
      
    </div>
</div>