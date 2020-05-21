<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;

class MailController extends Controller
{
    //
    public function send(){
        $ecode = '';
        for ($i=0;$i<4;$i++) {      
            $randcode = mt_rand(0,9);    
            $ecode .= $randcode;
        }

        $name = "您的验证码是: $ecode"; 
     // Mail::send()的返回值为空，所以可以其他方法进行判断 
        Mail::send('emails.test',['name'=>$name],function($message){ 
        $to = 'sanqian_0430@qq.com'; $message ->to($to)->subject('时迁博客'); 
        }); 
    }
}
