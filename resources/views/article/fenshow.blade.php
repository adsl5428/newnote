
@include('app')
@include('fenleilan')
<hr>
<a href="{{url('/create')}}">发表文章</a>
<h2>{{$leiming}}</h2>
<hr>
@if (count ($articles)>0)
    @foreach($articles as $article)
        <h3><a href="{{URL('/article',$article->id)}}">{{$article->title}}</a></h3>
        <content>
            <div class="body">
                {{$article->editor}} ---- {{$article->created_at}}
            </div>

        </content>
    @endforeach
@endif