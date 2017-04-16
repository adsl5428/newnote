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
        $fenleis=Fenlei::all();
        $articles = Article::latest()->get();
        //dd($articles);
        //return $articles;
        return view('index', compact('articles','fenleis'));
    }
    public function show($id)
    {
        $article=Article::findorfail($id);
      //  dd($id);
        $replys=Reply::where('article_id',$id)->get();
       // dd($replys);
        return view('article.show',compact('article','replys'));
    }
    public function create1()
    {
        $input=Input::except('_token');
     //   dd($input);
        $article=new Article();
        $article->title=$input['title'];
        $article->content=$input['content'];
        $article->fenlei=$input['fenlei'];
        $article->editor=session('name');
//        dd($input['title']);
//        dd($article->title);
        $article->save();
        return redirect('/');
    }
    public function create()
    {
//        return 123;
        if(session('name')==null)
        {return redirect('/login');}
        else{
            $fenlei=Fenlei::all();
//            dd($fenlei);
            return view('article.create',compact('fenlei'));
        }
    }
    public function fenlei($id)
    {
        $articles=Article::where('fenlei',$id)->get();
        $fenleis=Fenlei::all();
        foreach ($fenleis as $fl)
        {
            if ($fl->id==$id)
            {
                $leiming=$fl->name;
                break;
            }
        }
        //dd($leiming);
        return view('article.fenshow',compact('articles','fenleis','leiming'));
    }
}
