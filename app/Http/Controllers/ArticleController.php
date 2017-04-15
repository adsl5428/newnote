<?php

namespace App\Http\Controllers;

use App\Article;
use App\Fenlei;
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

        $articles = Article::latest()->get();
        //dd($articles);
        //return $articles;
        return view('index', compact('articles'));
    }
    public function show($id)
    {
        $article=Article::findorfail($id);
//        dd($article);
        return view('article.show',compact('article'));
    }
    public function create1()
    {
        $input=Input::except('_token');
        $article=new Article();
        $article->title=$input['title'];
//        dd($input['title']);
//        dd($article->title);
        $article->save();
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
}
