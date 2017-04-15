<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>notebook</title>
</head>
@include('app')
    <a href="" >123</a>
    <a href="" >123</a>
    <a href="" >123</a>
    <a href="" >123</a>
<hr>
<h2>最新文章</h2>
<a href="{{url('/create')}}">发表文章</a>
@if (count ($articles)>0)
    @foreach($articles as $article)
        <h2><a href="{{URL('/article',$article->id)}}">{{$article->title}}</a></h2>
        <content>
            <div class="body">
                {{$article->editor}} ---- {{$article->created_at}}
            </div>

        </content>
    @endforeach
@endif
<body>

</body>
</html>