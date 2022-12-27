<p>
    @foreach ($tags as $tag)
        <span href="" class="badge bg-success">{{ $tag->name }}</span>
    @endforeach
</p>