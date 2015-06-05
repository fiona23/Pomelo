@extends('_layouts.default')

@section('content')
    <div class="content-wrapper">
        <p>{{ $nickname }}</p>
        <div id="mytoken" value="{{ csrf_token() }}"></div>
        @if ( $auth !== $title)
        <button id="{{ $title }}" class="{{ $class }} sf-follow-btn">{{ $btnHTML }}</button>
        @endif
        <a href="{{ url(Request::url().'/exchange') }}">{{ $title }}想交换</a>
        <div class="postcards-wrapper">
            @foreach ($postcards as $postcard)
            <div class="want-exchange-postcards" style="background:url({{ url($postcard->cutpath) }})">
                <?php
                //Exchange::whereRaw('postcard_id=? and demand_user = ?',[$postcard->id, $auth]));
                    if (count(DB::select('select * from exchanges
                                          where postcard_id=? 
                                          and demand_user = ?', [$postcard->id, $auth]))) {
                        $statusText = '取消';
                    } else {
                        $statusText = '我想换';
                    }
                ?>
                @if ( $auth !== $title)
                <button data-postcard="{{ $postcard->id }}" class='exchange-btn'><?php echo $statusText;?></button>
                @endif
                <a href="{{ url(Request::url().'/exchange/'.$postcard->id) }}">
                <div class="overlay"></div>
                </a>
            </div>
            @endforeach
        </div>
        <a href="">{{ $title }}收到的明信片</a>
        <div class="postcards-wrapper">
            @foreach ($postcardsWall as $postcard)
                <div class="each-postcard" style="background:url({{ url($postcard->cutpath) }})">
                    <div class="overlay"></div>
                </div>
            @endforeach
        </div>
    </div>
    
@stop

@section('jspath')
people.js
@stop