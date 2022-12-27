@extends("layouts.app")




@section("title", "Show User")


@section("content")
    <div class="row">
        <div class="col-4">
            <img src="{{ $user->image ?  asset('storage/' . $user->image->path) : asset('avatar.png') }}" width="100" class="img-thumbnail" alt="..." />
        </div>

        <div class="col-8">
            <h3>{{ $user->name }}</h3>
        </div>

        @commentForm(["route" => route("comment.users", ['user' => $user->id])])
        @endcommentForm
    </div>

    <div>
        <h3>Comments</h3>

        @if ($user->commentsOn->count())
            @foreach ($user->commentsOn as $comment)
                <p>{{ $comment->content }}</p>
                
                @added(['date_created' =>  $comment->created_at->diffForHumans(), "name" => $comment->user->name, "userId" => $comment->user->id])

                @endadded
            @endforeach
        @else 
            <p>No Comments Yet</p>
        @endif
    </div>
@endsection