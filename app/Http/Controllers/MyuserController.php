<?php

namespace App\Http\Controllers;

use App\Article;
use App\Myuser;
use function compact;
use function dd;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use const null;
use function redirect;
use function session;
use function view;

class MyuserController extends Controller
{
    public function myinfo()  //我的页面
    {
        if(session('name')==null)
        {
            return redirect('/login');
        }                                  //个人页面,如果未登录跳转登录 页
        $articles=Article::where('editor',session('name'))->get(); //获取 我的文章列表
        return view('user.myinfo',compact('articles'));    //输出 到视图 模板
    }
    public function login1()    //登录
    {
        $input=Input::all();    //获取post的参数
 //       dd($input);
        $user=Myuser::where('name',$input['name'])->where('password',$input['password']) ->get(); //验证账号密码
            if (count($user)<=0)
            {
                $hi='账号或密码错误,请确认!';
                return view('user.login',compact('hi'));    //账号密码错误返回 错误消息
            }
            else
            {
                session(['name'=>$input['name']]);
                //return view('user.myinfo');
                return redirect('myinfo');
            }                                         //登录成功把name 放到 session的name键 ,以后判断是否登录用
    }


    public function login()    //测试的登录 页面, 无视
    {
        $hi=null;
        return view('user.login',compact('hi'));
    }
    public function register()   //请求注册, 返回注册页面即可
    {
        return view('user.register');
    }

    public function store()   //提交注册信息
    {
        $input = Input::except('_token');   //不要token 收其他的
       // dd($input);
        $rules =[                               //规则
            'name'=>'required | between:5,15 ', //name 不能为空,长度在5-15 . 这里还缺用户名是否存在的检测
            'password'=>'required | confirmed', //密码. 不能为空 , 且和重复密码一样  重复密码的name硬性为password_confirmation
            'email' => 'email',                 //邮箱 符合邮箱格式

        ];
        $message=           //如果不符合规则 返回的消息, 一条规则 匹配一条错误消息
            [
                'name.required'=>'用户名不能为空.',
                'name.between'=>'用户名必须在5到15之间.',
                'password.required'=>'密码不能为空.',
                'password.confirmed'=>'两次密码不一样.',
                'email.email'=>'邮箱格式不正确',
            ];

        $validator=Validator::make($input,$rules,$message); //对传入值 验证

        if($validator->passes())        //验证通过
        {
            $re =Myuser::create(Input::except('_token','password_confirmation'));//除了_token和重复密码,其他写入数据库
            if($re){
                return redirect('login');  //返回到登录页面 , 这里应该有一个注册成功 提醒 再返回登录页面
            }else{
                return back()->with('errors','注册失败，请稍后重试！');
            }

        }
        else
        {
            return back()->withErrors($validator);  //返回错误消息
            //dd($validator->errors()->all());
        }

    }

    public function logout()        //登出  session中name的值 设为空, 并跳到登录页面
    {
        session(['name'=>null]);
        $hi='';
        return view('user.login',compact('hi'));
    }
}
