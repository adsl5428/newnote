<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{$article->title}}</title>
</head>
@include('app')
<h1>{{$article->title}}</h1>
{{$article->created_at}}  ----   {{$article->editor}}

<h5>{{$article->content}}</h5>
<hr>

@if (count ($replys)>0)
    @foreach($replys as $reply)
        {{$reply->created_at}}  ----   {{$reply->name}}
        <h5>{{$reply->content}}</h5>
        <hr>
@endforeach
@endif