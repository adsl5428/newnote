@extends('master')
@section('title','我的记事本')
@section('content')
    <div class="page__bd page__bd_spacing">

        @if (count ($articles)>0)
            @foreach($articles as $article)
        <div class="weui-flex">
            <div class="weui-flex__item"><div class="placeholder">
                    {{--<article>--}}

                        <div class="media_bd">
                            <h4 class="media_title"><a href="{{URL('/article',$article->id)}}">{{$article->title}}</a></h4>
                            <p class="media_desc">作者:{{$article->editor}}  发布时间:{{$article->created_at}}</p>
                        </div>
                    {{--</article>--}}
                </div></div>
            {{--<div class="weui-flex__item"><div class="placeholder">weui</div></div>--}}
        </div>
            @endforeach
        @endif
    </div>
@endsection