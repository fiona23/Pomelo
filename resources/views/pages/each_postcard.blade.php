@extends('_layouts.default')

@section('content')
    
    <section class="fleft">
        <a href=""><h2>{{ $title }}想交换</h2></a>
        <img id="each-postcard" data-postcard="{{ $postcard->id }}" class="postcard" src="{{ url($src) }}" alt="">
        
        @if( $title !== $auth)
            
           <!--  <form action="{{ url('exchange/sure') }}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="demand_user" value="{{ $auth }}">
                --> <!-- <input type="hidden" name="postcard_id" value="{{ $postcard->id }}"> -->
                <button id="exchange-btn" data-postcard="{{ $postcard->id }}" type="submit">{{ $status }}</button>
            <!-- </form> -->

        @endif
        <p>上传于{{ $postcard->created_at }}</p>
        
            @foreach ($postcard->hasManyComments as $comment)
        <div class="postcard-comment">
            <div class="author">
                <a href="/people/{{ $comment->name }}" class="author-name">{{ $comment->name }}</a href="/people/{{ $comment->name }}">
                <time class="time">{{ $comment->created_at }}</time>
            </div>
            <div class="comment-content">
                <p>{{ $comment->content }}</p>
            </div>
        </div><!-- comments -->

            @endforeach
            
        <div class="comment-form">
            <form action="{{ url('comment/store' )}}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="postcard_id" value="{{ $postcard->id }}">
                <input type="hidden" name="name" value="{{ $auth }}">
                <textarea name="content" id="" cols="30" rows="4"></textarea>
                <button type="submit">提交</button>
            </form>
        </div><!-- comment-form -->

    </section>    

    @if ($title == $auth)

        <sidebar class="fleft" id="demand-users">
            <p>谁想交换这张明信片</p>
            @foreach($demandUsers as $demandUser)
                <a data-user="{{ $demandUser->demand_user }}">{{ $demandUser->demand_user }}</a>
            @endforeach
        </sidebar>

    @endif
@stop

@section('jspath')
exchange.js
@stop