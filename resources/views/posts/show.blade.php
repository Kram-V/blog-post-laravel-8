@extends("layouts.app")


@section("title", "Post")

@section("content")

    {{-- @if ($post["is_new"])
        <h2>THE POST IS NEW</h2>
    @else
        <h2>THE POST IS OLD</h2>
    @endif --}}

    <div class="mb-5">
        <h1 class="text-center mt-5">Show Post</h1>

    
       
        @if ($post->image)
            <img style="width: 100px; height: 100px" src="{{ asset('storage/' . $post->image->path) }}" />
        @else
            {{ "" }}
        @endif

        @tags(["tags" => $post->tags])
        @endtags
    
        <h1>{{ $post->title }}</h1>
        <p>{{ $post->content }}</p>

     

        @added(['date_created' => $post->created_at->diffForHumans(), 'name' => $post->user->name, "userId" => $post->user->id])
        @endadded
    </div>


    @commentForm(["route" => route("comment.posts", ['post' => $post->id])])
    @endcommentForm


    <div>
        <h3>Comments</h3>

        @if ($post->comments->count())
            @foreach ($post->comments as $comment)
                <p>{{ $comment->content }}</p>
                
                @added(['date_created' =>  $comment->created_at->diffForHumans(), "name" => $comment->user->name, "userId" => $comment->user->id])

                @endadded
            @endforeach
        @else 
            <p>No Comments Yet</p>
        @endif
    </div>

    {{-- @isset($post["has_comments"])
        <h2>IT HAS COMMENTS</h2>
    @endisset --}}
    
@endsection