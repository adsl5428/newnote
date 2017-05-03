<?php

namespace App\Http\Controllers\wap;


use function dd;
use Illuminate\Support\Facades\Input;
use Storage;

use App\Article;
use App\Fenlei;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use function view;

class ArticleController extends Controller
{

    public function upload(Request $request)
    {

        if ($request->isMethod('post')) {

            $file = Input::file('file');

            // 文件是否上传成功
            if ($file->isValid()) {

                // 获取文件相关信息
                $originalName = $file->getClientOriginalName(); // 文件原名
                $ext = $file->getClientOriginalExtension();     // 扩展名
                $realPath = $file->getRealPath();   //临时文件的绝对路径
                $type = $file->getClientMimeType();     // image/jpeg

                // 上传文件
                $filename = date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $ext;
                // 使用我们新建的uploads本地存储空间（目录）
                $bool = Storage::disk('uploads')->put($filename, file_get_contents($realPath));
                var_dump($bool);
                return 1;
            }
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
                $imgDir = 'account_imgs/';
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







        }

        return view('wap.upload');
    }

    public function up()
    {
        return view('wap.upload');
    }
    /*
    public function uploader()
    {
        return 123;
        $files = array();
        $success = 0;    //用户统计有多少张图片上传成功了

        foreach ($_FILES as $item) {
            $index = count($files);

            $files[$index]['srcName'] = $item['name'];    //上传图片的原名字
            $files[$index]['error'] = $item['error'];    //和该文件上传相关的错误代码
            $files[$index]['size'] = $item['size'];        //已上传文件的大小，单位为字节
            $files[$index]['type'] = $item['type'];        //文件的 MIME 类型，需要浏览器提供该信息的支持，例如"image/gif"
            $files[$index]['success'] = false;            //这个用于标志该图片是否上传成功
            $files[$index]['path'] = '';                //存图片路径

            // 接收过程有没有错误
            if($item['error'] != 0) continue;
            //判断图片能不能上传
            if(!is_uploaded_file($item['tmp_name'])) {
                $files[$index]['error'] = 8000;
                continue;
            }
            //扩展名
            $extension = '';
            if(strcmp($item['type'], 'image/jpeg') == 0) {
                $extension = '.jpg';
            }
            else if(strcmp($item['type'], 'image/png') == 0) {
                $extension = '.png';
            }
            else if(strcmp($item['type'], 'image/gif') == 0) {
                $extension = '.gif';
            }
            else {
                //如果type不是以上三者，我们就从图片原名称里面去截取判断去取得(处于严谨性)
                $substr = strrchr($item['name'], '.');
                if(FALSE == $substr) {
                    $files[$index]['error'] = 8002;
                    continue;
                }

                //取得元名字的扩展名后，再通过扩展名去给type赋上对应的值
                if(strcasecmp($substr, '.jpg') == 0 || strcasecmp($substr, '.jpeg') == 0 || strcasecmp($substr, '.jfif') == 0 || strcasecmp($substr, '.jpe') == 0 ) {
                    $files[$index]['type'] = 'image/jpeg';
                }
                else if(strcasecmp($substr, '.png') == 0) {
                    $files[$index]['type'] = 'image/png';
                }
                else if(strcasecmp($substr, '.gif') == 0) {
                    $files[$index]['type'] = 'image/gif';
                }
                else {
                    $files[$index]['error'] = 8003;
                    continue;
                }
                $extension = $substr;
            }

            //对临时文件名加密，用于后面生成复杂的新文件名
            $md5 = md5_file($item['tmp_name']);
            //取得图片的大小
            $imageInfo = getimagesize($item['tmp_name']);
            $rawImageWidth = $imageInfo[0];
            $rawImageHeight = $imageInfo[1];

            //设置图片上传路径，放在upload文件夹，以年月日生成文件夹分类存储，
            //rtrim(base_url(), '/')其实就是网站的根目录，大家自己处理
            $path = rtrim(base_url(), '/') . '/upload/' . date('Ymd') . '/';
            //确保目录可写
//            ensure_writable_dir($path);
            //文件名
            $name = "$md5.0x{$rawImageWidth}x{$rawImageHeight}{$extension}";
            //加入图片文件没变化到，也就是存在，就不必重复上传了，不存在则上传
            $ret = file_exists($path . $name) ? true : move_uploaded_file($item['tmp_name'], $serverPath . $name);
            if($ret === false) {
                $files[$index]['error'] = 8004;
                continue;
            }
            else {
                $files[$index]['path'] = $path . $name;        //存图片路径
                $files[$index]['success'] = true;            //图片上传成功标志
                $files[$index]['width'] = $rawImageWidth;    //图片宽度
                $files[$index]['height'] = $rawImageHeight;    //图片高度
                $success ++;    //成功+1
            }
        }

        //将图片已json形式返回给js处理页面  ，这里大家可以改成自己的json返回处理代码
        echo json_encode(array(
            'total' => count($files),
            'success' => $success,
            'files' => $files,
        ));
    }*/


}
