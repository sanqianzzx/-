<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;
use DB;

class MailController extends Controller
{
    //
    
    public function send(){
        $ecode = ""; 
        for ($i=0;$i<4;$i++) {  
               
            $randcode = mt_rand(0,9);    
            $ecode .= $randcode;
        }

        $name = "您的验证码是: $ecode"; 
     // Mail::send()的返回值为空，所以可以其他方法进行判断 
        Mail::send('emails.test',['name'=>$name],function($message){ 
        $email = $_GET['email'];
        $to = $email; $message ->to($to)->subject('时迁博客'); 
        }); 
        echo $ecode;
    }

    public function do(){
        $uname = session()->get("username");
        DB::table("user")->where("uname",$uname)->update(["email"=>$_POST['email']]);

        return redirect("/myindex");
    }

    public function pwd(){

        $uname = session()->get("username");
        $npwd = md5($_POST['npwd']);

        $res = DB::table("user")->where("uname",$uname)->update(["password"=>$npwd]);
        
        if($res){
            echo "<script>alert('修改成功');location.href='/'</script>";
        }else{
            echo "<script>alert('由于某些原因修改失败,请稍后再试');location.href='/'</script>";
        }
        
    }
}
