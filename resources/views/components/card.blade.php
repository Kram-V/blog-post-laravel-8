<div class="card" style="width: 18rem;">
            
    <div class="card-body px-5">
        <h5 class="card-title text-center"><strong>{{ $text_header }}</strong></h5>
        @if (count($contents))
            <ol>
                @foreach ($contents as $content) 
                    <li>{{ $content }}</li> 
                @endforeach
            </ol>
        @else
            <p class="text-center">{{ $no_text_content }}</p>
        @endif
       

    </div>
</div>