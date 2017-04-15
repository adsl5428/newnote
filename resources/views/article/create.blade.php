@include('app')

<form action="{{ URL('/create1') }}" method="post" >
    {{csrf_field()}}
    <lable>标题</lable>
    <input type="text" name="title"  value="test title"><br>
    <lable>内容</lable>
    <textarea type="textarea" name="content"  cols="30" rows="5">test content</textarea><br>
    <lable>分类</lable>
    <select name="fenlei">
        @foreach($fenlei as $lei)
        <option value="{{$lei->id}}">{{$lei->name}}</option>
            @endforeach
    </select>
<br>
    <input type="submit"  value="发表">
</form>