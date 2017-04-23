<?php

namespace App\Http\Controllers\wap;

use App\Article;
use App\Fenlei;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    public function Index ()
    {
//        $fenleis=Fenlei::all();
        $articles = Article::latest()->paginate(10);//
        //dd($articles);
        //return $articles;
        return view('wap.index', compact('articles'));
    }
    public function upload()
    {
        return view('wap.upload');
    }



}
