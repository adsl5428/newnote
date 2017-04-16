@if (count ($fenleis)>0)
    @foreach($fenleis as $fenlei)
        <a href="#" >{{$fenlei->name}}</a>
    @endforeach
@endif