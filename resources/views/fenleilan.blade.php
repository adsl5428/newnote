@if (count ($fenleis)>0)
    @foreach($fenleis as $fenlei)
        <a href="{{url('/fenlei',$fenlei->id)}}" >{{$fenlei->name}}</a>
    @endforeach
@endif