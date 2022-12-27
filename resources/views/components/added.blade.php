<p class="text-muted">
    Added {{ $date_created }} {{ !isset($name) ? '' : 'by' }} 

    @if (!isset($name) && !isset($userId))
        {{ "" }}
    @else
        <a href="{{ route("users.show", ['user' => $userId]) }}">{{ $name }}</a>
    @endif
</p>