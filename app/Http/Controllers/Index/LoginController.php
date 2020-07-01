<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use App\Mail\SendCode;
use Illuminate\Support\Facades\Mail;
use App\Members;


class LoginController extends Controller
{
    public function login(){
    	return view('index/login'); 
    }
     public function reg(){
    	return view('index/reg'); 
    }
   // 用户登录名称 zhangyuanyuan@1557689869344608.onaliyun.com
//AccessKey ID LTAI4G1sRnWZxxQVZiRABMqQ
//SECRET nQ2V3CDXCJtkBOJmA08Qe2Rtjspnmg
     public function send(Request $request){
    	$name=$request->name;
    	$reg='/^1[3|4|5|6|7|8|9]\d{9}$/';
    	$reg_email='/^\w{3,}@([a-z]{2,7}|[0-9]{3})\.(com|cn)$/';

        $code=rand(1000,9999);
    	if(preg_match($reg,$name)){
    		
            $res=$this->sendSms($name,$code);
            if($res['Message']=='OK'){
                $request->session()->put('code',$code);
                return json_encode(['code'=>'00000','msg'=>'手机号验证码发送成功']);
                
            }

    	}else if(preg_match($reg_email,$name)){
          $this->sendMail($name,$code);
          $request->session()->put('code',$code);
           return json_encode(['code'=>'00000','msg'=>'邮箱验证码发送成功']);
           
    	}else{
    		return json_encode(['code'=>'00000','msg'=>'请输入正确的手机号或邮箱']);
    	}
    }
    public function sendMail($mail,$code){
        Mail::to($mail)->send(new SendCode($code));
    }

    public function sendSms($mobile,$code){

                // Download：https://github.com/aliyun/openapi-sdk-php
                // Usage：https://github.com/aliyun/openapi-sdk-php/blob/master/README.md

                AlibabaCloud::accessKeyClient('LTAI4G1sRnWZxxQVZiRABMqQ', 'nQ2V3CDXCJtkBOJmA08Qe2Rtjspnmg')
                                        ->regionId('cn-hangzhou')
                                        ->asDefaultClient();

                try {
                    $result = AlibabaCloud::rpc()
                                          ->product('Dysmsapi')
                                          // ->scheme('https') // https | http
                                          ->version('2017-05-25')
                                          ->action('SendSms')
                                          ->method('POST')
                                          ->host('dysmsapi.aliyuncs.com')
                                          ->options([
                                                        'query' => [
                                                          'RegionId' => "cn-hangzhou",
                                                          'PhoneNumbers' =>$mobile,
                                                          'SignName' => "归零",
                                                          'TemplateCode' => "SMS_190284270",
                                                          'TemplateParam' => "{code:$code}",
                                                        ],
                                                    ])
                                          ->request();
                    return $result->toArray();
                } catch (ClientException $e) {
                    return $e->getErrorMessage() . PHP_EOL;
                } catch (ServerException $e) {
                    return $e->getErrorMessage() . PHP_EOL;
                }
    }
    //注册
    public function regadd(Request $request){
        $post=$request->except('_token');
        //dump($post);
        //取cookie
        $code=$request->session()->get('code');
        //dd($code);
        //验证验证码正确
        if($post['code']!=$code){
            return redirect('/reg')->with('msg','验证码不对');
        }
        //判断密码一致
        if($post['pwd']!=$post['repwd']){
            return redirect('/reg')->with('msg','密码不一致');
        }
        //入库

        $reg='/^1[3|4|5|6|7|8|9]\d{9}$/';
        $reg_email='/^\w{3,}@([a-z]{2,7}|[0-9]{3})\.(com|cn)$/';

        //正则验证
        if(preg_match($reg,$post['name'])){
            $post['moblie']=$post['name'];

        }else if(preg_match($reg_email,$post['name'])){
            $post['email']=$post['name'];
        }else{
            return json_encode(['code'=>'00000','msg'=>'请输入正确的手机号或邮箱']);
        }
        $post['pwd']=encrypt($post['pwd']);
        unset($post['repwd']);
        unset($post['code']);
       // dd($post);
        $res= Members::create($post);
        if($res){
            return redirect('/login');
        }
        

    }
    //登录
    public function loginadd(Request $request){
       $post=$request->except('_token');
       $post=request()->all();
        //更具用户名查询记录
       $login=Members::where('name',$post['name'])->first();
       if(!$login){
         return redirect('/login')->with('msg','用户或密码不对');
       }
        if(decrypt($login->pwd)!=$post['pwd']){
          return  redirect('/login')->with('msg','用户名或密码不对');
      }

       request()->session()->put('login',$login);
       if(isset($post['refer'])){
          return redirect($post['refer']);
       }
       if($login){
          return redirect('/');
       }
       
    }
}
