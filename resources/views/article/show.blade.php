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


