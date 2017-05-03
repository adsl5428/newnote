<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Storage;
use Illuminate\Http\Request;

use App\Http\Requests;

class FileController extends Controller
{
    // 文件上传方法
    public function upload(Request $request)
    {
        if ($request->isMethod('post')) {

            $file = Input::file('file');
            //dd($request);
            if($file -> isValid()){
                $entension = $file -> getClientOriginalExtension(); //上传文件的后缀.
                $newName = date('YmdHis').mt_rand(100,999).'.'.$entension;
                $path = $file -> move(base_path().'/uploads',$newName);
                $filepath = 'uploads/'.$newName;
                dd(base_path().'/uploads',$newName);
                return $filepath;
            }


            //var_dump($_FILES["file"]['tmp_name']);
            //var_dump($_FILES["file"]['tmp_name'][1]);
            //dd(Input::all());
            if(isset($_FILES['file'])){
                $aid = intval($_POST['aid']);
                $nickname = ($_POST['nickname']);
                //获取图片的临时路径
                $image = $_FILES["file"]['tmp_name'];
                //只读方式打开图片文件
                $fp = fopen($image, "r");
                //读取文件（可安全用于二进制文件）
                $file = fread($fp, $_FILES["file"]["size"]); //二进制数据流
                //保存地址
                $imgDir = 'uploads/';
                //要生成的图片名字
                //$filename = date("Ym")."/".md5(time().mt_rand(10, 99)).".jpg"; //新图片名称
                $filename = "2017new.jpg";
                //新图片的路径
                $newFilePath = $imgDir.$filename;
                $data = $file;
                $newFile = fopen($newFilePath,"w"); //打开文件准备写入
                fwrite($newFile,$data); //写入二进制流到文件
                fclose($newFile); //关闭文件
                //写入数据库
                $sql = "update account set nickname = '".$nickname."', img = '".$filename."' where aid = ".$aid;

                if(!$db->query($sql)) {
                    Json_out(array('result'=>'imgfail'));
                    exit;
                    }else{
                    Json_out(array('result'=>'imgsuccess'));
                    exit;
                    }
            } else{
                $aid = intval($_REQUEST['aid']);
                $nickname = $_REQUEST['nickname'];

                $sql = "update `account` set nickname = '".$nickname."' where aid = ".$aid;

                if(!$db->query($sql)) {
                    Json_out(array('result'=>'fail'));
                    exit;
                    }else{
                    Json_out(array('result'=>'noimgsuccess'));
                    exit;
                    }
            }

            $file = $request->file('picture');
            // 文件是否上传成功
            if ($file->isValid()) {

                // 获取文件相关信息
                $originalName = $file->getClientOriginalName(); // 文件原名
                $ext = $file->getClientOriginalExtension();     // 扩展名
                $realPath = $file->getRealPath();   //临时文件的绝对路径
                $type = $file->getClientMimeType();     // image/jpeg

                // 上传文件
                $filename = date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $ext;
//                var_dump( $realPath);
                // 使用我们新建的uploads本地存储空间（目录）
                $bool = Storage::disk('uploads')->put($filename, file_get_contents($realPath));
//                var_dump($bool);
            }
        }
        else{

            return view('wap.upload');
        }

        //return view('upload');
    }
}
