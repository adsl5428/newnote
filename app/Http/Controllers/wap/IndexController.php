<?php

namespace App\Http\Controllers\wap;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        return view('wap.index');
    }
}
