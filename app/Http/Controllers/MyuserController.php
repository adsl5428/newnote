<?php

namespace App\Http\Controllers;

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
    public function myinfo()
    {
        if(session('name')==null)
        {
            return redirect('/login');
        }
        return view('user.myinfo');
    }
    public function login1()
    {
        $input=Input::all();
 //       dd($input);
        $user=Myuser::where('name',$input['name'])->where('password',$input['password']) ->get();
            if (count($user)<=0)
            {
                $hi='账号或密码错误,请确认!';
                return view('user.login',compact('hi'));
            }
            else
            {
                session(['name'=>$input['name']]);
                return view('user.myinfo');
            }
    }


    public function login()
    {
        $hi=null;
        return view('user.login',compact('hi'));
    }
    public function register()
    {
        return view('user.register');
    }

    public function store()
    {
        $input = Input::except('_token');
       // dd($input);
        $rules =[
            'name'=>'required | between:5,15 ',
            'password'=>'required | confirmed',
            'email' => 'email',
        ];
        $message=
            [
                'name.required'=>'用户名不能为空.',
                'name.between'=>'用户名必须在5到15之间.',
                'password.required'=>'密码不能为空.',
                'password.confirmed'=>'两次密码不一样.',
                'email.email'=>'邮箱格式不正确',
            ];

        $validator=Validator::make($input,$rules,$message);

        if($validator->passes())
        {
            $re =Myuser::create(Input::except('_token','password_confirmation'));
            if($re){
                return redirect('login');
            }else{
                return back()->with('errors','注册失败，请稍后重试！');
            }

        }
        else
        {
            return back()->withErrors($validator);
            //dd($validator->errors()->all());
        }

    }

    public function logout()
    {
        session(['name'=>null]);
        $hi='';
        return view('user.login',compact('hi'));
    }
}
