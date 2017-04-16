
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>个人中心</title>
</head>

@include('app')

<h1>this is my info page</h1>
<hr>
@if (count ($articles)>0)
    @foreach($articles as $article)
        <h3><a href="{{URL('/article',$article->id)}}">{{$article->title}}</a></h3>
        {{--<h2><a href="{{URL('/article/edit',$article->id)}}">编辑</a></h2>--}}
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