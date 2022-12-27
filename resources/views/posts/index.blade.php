@extends("layouts.app")


@section("title", "Posts")


@section("content")

    <h1 class="text-center mt-5">List of Post</h1>

    <div class="d-flex justify-content-center gap-5">
        <div>
            <div class="card" style="width: 18rem;">
            
                <div class="card-body px-5">
                    <h5 class="card-title text-center"><strong>First Five Posts</strong></h5>

                    @if (count($first_five_posts))
                        <ol>
                            @foreach ($first_five_posts as $post)
                                
                                <li><a href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a></li>
                            
                            @endforeach
                        </ol>
                    @else
                        <p class="text-center">No Posts Show</p>
                    @endif
                       
       
                </div>
            </div>
        </div>

        <div>
            @card(['text_header' => 'Most Active Users', 'no_text_content' => 'No Most Active Users'])
                @slot('contents', collect($most_active_users)->pluck('name'))
            @endcard
        </div>
    </div>

    @if (count($posts))
        @foreach ($posts as $post)
            @include("posts.partials.post")
        @endforeach
    @else
        <h1>NO POSTS FOUND</h1>
    @endif

@endsection 