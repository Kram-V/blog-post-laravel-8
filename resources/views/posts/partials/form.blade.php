<div class="form-group">
    <label for="title">Title *</label>
    <input class="form-control" id="title" type="text" name="title" value="{{ old("title", optional($post ?? null)->title) }}" />
</div>

@error("title")
    <div class="text-danger">{{ $message }}</div>
@enderror

<div class="form-group">
    <label for="content">Content *</label>
    <textarea class="form-control" id="content" name="content">{{ old("content", optional($post ?? null)->content) }}</textarea>
</div>

@error("content")
    <div class="text-danger">{{ $message }}</div>
@enderror

<div class="form-group">
    <label for="image">Image *</label>
    <input class="form-control" id="image" type="file" name="image" />
</div>

@error("image")
    <div class="text-danger">{{ $message }}</div>
@enderror

{{-- YOU CAN USE THIS PATTERN FOR ERROR MESSAGE --}}
{{-- @if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}