<?php

namespace App\Http\Controllers;

use App\Article;
use App\Fenlei;
use App\Reply;
use function compact;
use function dd;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use const null;
use function redirect;
use function session;
use function view;

class ArticleController extends Controller
{
    public function Index ()
    {
        $fenleis=Fenlei::all();                     //数据库 读取所有分类
        $articles = Article::latest()->paginate(10);//从新到旧读取文章 , 每10条一个分页
        //dd($articles);
        //return $articles;
        return view('index', compact('articles','fenleis')); //将分类 和 文章传入视图模板 并显示
    }
    public function show($id)
    {
        $article=Article::findorfail($id);  //读取该 id 的文章
      //  dd($id);
        $replys=Reply::where('article_id',$id)->get(); //读取该 id 的回复
       // dd($replys);
        return view('article.show',compact('article','replys'));  //将回复 和 文章传入视图模板 并显示
    }
    public function create1()
    {
        $input=Input::except('_token');//获取post上来的参数, _token值不要
     //   dd($input);
        /*
        这里应该对传上来的 参数 进行验证
        就像注册 验证 那样.
        */
        $article=new Article();         //模型实例化
        $article->title=$input['title'];
        $article->content=$input['content'];
        $article->fenlei=$input['fenlei'];
        $article->editor=session('name'); //填上对应的值
//        dd($input['title']);
//        dd($article->title);
        $article->save();           //存入数据库
        return redirect('/');       //返回首页
    }
    public function create()    //创建文章 响应
    {
//        return 123;
        if(session('name')==null)
        {return redirect('/login');}  //用session判断是否登录状态, 如果不是登录状态,跳转到登录页面
        else{
            $fenlei=Fenlei::all();  //模型 读取分类
//            dd($fenlei);
            return view('article.create',compact('fenlei'));//将分类传入模板引擎,供创建文章 选择分类
        }
    }
    public function fenlei($id)     //获取对应分类的文章
    {
        $articles=Article::where('fenlei',$id)->get();   //得到对应分类的 文章
        $fenleis=Fenlei::all();                           //得到所有分类
        foreach ($fenleis as $fl)
        {
            if ($fl->id==$id)
            {
                $leiming=$fl->name;
                break;
            }
        }                                           //遍历对比 要的分类
        //dd($leiming);
        return view('article.fenshow',compact('articles','fenleis','leiming'));
                                                    //文章  全部分类  本次类名 传入视图模板引擎
    }
}
