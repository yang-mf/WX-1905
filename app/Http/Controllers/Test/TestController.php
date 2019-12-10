<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function index()
    {
        $data=DB::table('b')->get();
        dd($data);
        echo '2345';
    }
    public function info()
    {
        phpinfo();
    }

    public function wx(){
        $token = '2259b56f5898cd6192c50d338723d9e4';       //开发提前设置好的 token
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        $echostr = $_GET["echostr"];

        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );

        if( $tmpStr == $signature ){        //验证通过
            echo $echostr;
        }else{
            die("not ok");
        }
    }

    public function receiv(){
        $log_file="wx_log";
        //将接收的数据记录到日志文件
        $xml_str=file_get_contents("php://input");
//        print_r($xml_str);
        $data=date('Y-m-d H:i:s').$xml_str;
        file_put_contents($log_file,$data,FILE_APPEND);//追加写

        $xml_obj=simplexml_load_string($xml_str);
//        dd($xml_obj);
        $event=$xml_obj->Event;
        if($event=='subscribe'){
            $openid=$xml_obj->FromUserName;  //获取用户的openid
            //获取用户信息
            $url='https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$this->access_token.'&openid='.$openid.'&lang=zh_CN';
            $user_info=file_get_contents($url);


        }
    }


    /*
     * 获取用户的信息
     * */
    public function GetUserInfo()
    {
        $info = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token='.config('access_token').'&openid=OPENID&lang=zh_CN';
    }



}
