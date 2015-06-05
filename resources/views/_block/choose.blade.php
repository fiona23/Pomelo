@foreach ($postcards as $postcard)
    <div class="want-exchange-postcards" style="background:url({{ url($postcard->cutpath) }})">
        <p class='exchange-btn'>选定</p>
        <a data-postcard="{{ $postcard->id }}" href="javascript:void(0)"> 
        <div class="overlay"></div>
        </a>
    </div>
@endforeach