<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class MyController extends Controller
{
    //
    public function index(){
        $user = session()->get("username");
        $email = DB::select("select email from user where uname = '{$user}'");
        
        if(empty($email[0])){
            $email = 0;
        }else{
            $email = $email[0]->email;
        }

        return view("/myself/index",["email"=>$email]);
    }

    public function good(){
        $user = session()->get("username");
        
        $res = DB::table('good')->where('guser','=',$user)->paginate(7);
        $article = DB::select("select garticle,aname from article,good where guser = '$user' and article.id = good.garticle");
        // var_dump($article);die;

        return view("/myself/good",['res'=>$res,'article'=>$article]);
    }

    public function message(){
        $user = session()->get("username");
        $res = DB::table('fankui')->where('user','=',$user)->where('read','=',1)->paginate(7);
        return view("/myself/message",['res'=>$res]);
    }

    public function history(){
        $user = session()->get("username");
        $res = DB::table('history')->where('hname','=',$user)->paginate(7);
        $article = DB::select("select harticle,aname from article,history where hname = '$user' and article.id = history.harticle");

        return view("/myself/history",['res'=>$res,'article'=>$article]);
    }

    public function mydetails($id){
        $user = session()->get("username");
        $res = DB::select("select * from fankui where id = $id");
        if($res && $res[0]->user == $user){
            return view("/myself/details",['res'=>$res]);
        }else{
            echo "<script>alert('您查看的内容不存在');location.href='/mymessage';</script>";
        }
        
    }

    public function remove_h(){

        $user = session()->get("username");
        $res = DB::table('history')->where('hname',$user)->delete();

    }
    public function remove_m(){

        $user = session()->get("username");
        $res = DB::table('history')->where('user',$user)->delete();

    }
}
