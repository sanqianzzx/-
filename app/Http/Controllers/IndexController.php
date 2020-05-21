<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    //
    public function home(){
        $newtype = 0;
        if(session('article')){
            session()->forget('article');
        }
        
        if(isset($_GET['id']) && $_GET['id'] != 0){

            $text = DB::select("select * from article where type = {$_GET['id']} order by id desc");
            $newtype = $_GET['id'];
        }else{

            $text = DB::select("select * from article order by id desc");
        }
        
        $type = DB::select("select * from type");
        
        function cutstr_html($string,$sublength,$encoding = 'utf-8',$ellipsis = '…'){
            $string = strip_tags($string);
            $string = trim($string);
            $string = mb_ereg_replace("\t","",$string);
            $string = mb_ereg_replace("\r\n","",$string);
            $string = mb_ereg_replace("\r","",$string);
            $string = mb_ereg_replace("\n","",$string);
            $string = mb_ereg_replace(" ","",$string);
            $string = str_replace("&nbsp;","",$string);
            if(mb_strlen(trim($string),'utf-8') < $sublength){
                    return trim($string).$ellipsis;
            }else{
                    return mb_strcut(trim($string),0,$sublength,$encoding).$ellipsis;
            }
        }
        foreach($text as $k=>$v){
            
                //测试字符串
                // $str='<p style="microsoft yahei, arial; vertical-align: baseline; list-style-type: none; text-indent: 28px; line-height: 25px; text-align:center;margin-top: 12px; margin-bottom: 12px; padding: 0px; border: 0px; font-size: 14px;color:red;">   fherfhewkolfjlkdsjfld</p>';
                //调用方法测试
            $v->content = cutstr_html($string=$v->content,$sublength=50,$encoding='utf-8',$ellipsis='...');
        
            foreach($type as $kk=>$vv){
                if($v->type == $vv->id){
                    $v->type = $vv->tname;
                }
            }
        }

        // var_dump($text);die;
        
        return view('index',["type" => $type,"text" => $text,"newtype" => $newtype]);
    }


    public function gg(){

        //公告
        $res = DB::select("select * from gg");
        return view("gg",['res'=>$res]);
    }

    public function article($id){
        session(['article' => $id]);
        //是否登录
        $good = 0;
        $username = session()->get("username");
        if($username){
            $good = DB::select("select * from good where guser = '{$username}' and garticle = $id");
            if($good){
                $good = 1;
            }

            $h = DB::select("select * from history where hname = '$username' and harticle = $id");
            if(!$h){
                DB::table("history")->insert(["hname"=>$username,"harticle"=>$id]);
            }
            
        }
        

        if(!is_numeric($id)){
            echo "<script>location.href='/'</script>";
        }
        //文章内容
        $res = DB::select("select * from article,type where article.type = type.id and article.id=$id");  
        
        $look = $res[0]->look + 1;
        DB::table("article")->where("id",$id)->update(["look"=>$look]);

        $res[0]->time = date("Y-m-d H:i:s",$res[0]->time);
        $review = DB::select("select * from review where cid = $id");
        foreach($review as $k=>$v){
            $user = DB::select("select * from user where id = $v->uid");
            if($user){
                $v->uid = DB::select("select uname from user where id = $v->uid")[0]->uname;
            }else{
                $v->uid = "该用户已注销";
            }
            
        }
        //热门推荐
        $top = DB::select("select * from article order by look DESC limit 4");
        return view('article',['res'=>$res,'review'=>$review,'top'=>$top,'good'=>$good]);
    }

    public function fankui(){
        return view("fankui");
    }

    public function fkdo(){
        // var_dump($_POST);
        $user = session()->get("username");
        $time = time();
        $res = DB::table("fankui")->insert(['user'=>$user,'content'=>$_POST['text'],'time'=>$time]);
        if($res){
            echo "<script>alert('多谢您宝贵的建议,我们会尽快阅读并回复您');location.href='/';</script>";
        }else{
            echo "<script>alert('出现某种错误,请稍后重试');location.href='/';</script>";
        }
        
    }

    public function login(){
        return view('login');
    }
    public function logindo(){
        $rnumber = session('reg_num_check');
        if($rnumber != $_POST['rnumber']){
            echo "验证码错误";
        }else{
            $res = DB::select("select * from user where uname = '{$_POST['user']}'");
            $_POST['pwd'] = md5($_POST['pwd']);
            if($res && $res[0]->password == $_POST['pwd']){    
                if(session('username')){
                    session()->forget('username');
                    session(['username' => $_POST['user']]);
                    return redirect("/");
                }else{
                    session(['username' => $_POST['user']]);
                    return redirect("/");
                }       
            }else{
                echo "用户名或密码错误";
            }
        }
        
        
    }

    public function reg(){
        
        return view('reg');
    }
    public function regdo(){
        $rnumber = session('reg_num_check');
        $pic = "/img/tx.jpg";
        $_POST['pwd'] = md5($_POST['pwd']);
        $res = DB::table("user")->insert(['uname'=>$_POST['user'],'password'=>$_POST['pwd'],'upic'=>$pic]);
        if($rnumber != $_POST['rnumber']){
            echo "验证码错误";
        }else{
            if($res){
                if(session('username')){
                    session()->forget('username');
                }
                session(['username' => $_POST['user']]);
                
            }else{
                echo "注册失败";
            }
        }
        
        
    }

    public function rnumber(){
        return view("rnumber");
    }

    public function yz(){
        return view('yz');
    }

    public function session(){
        if(session('username')){
            echo session()->get('username');
        }else{
            echo "请先登录";
        }
    }

    public function aid(){
        if(session('article')){
            echo session()->get('article');
        }
    }

    public function reviewadd(){
        $time = time();
        $uid = DB::select("select id from user where uname = '{$_POST['uname']}'");
        $uid = $uid[0]->id;
        $cid = $_POST['cid'];
        $rcontent = $_POST['ucontent'];
        $res = DB::table('review')->insert(['uid'=>$uid,'rcontent'=>$rcontent,'cid'=>$cid,'time'=>$time]);
    }
    
    public function good(){

        $user = session()->get("username");
        $article = session()->get("article");
        $res = DB::select("select id from good where guser = '{$user}' and garticle = '{$article}'");
        if($res){
            
            DB::table("good")->where('id',$res[0]->id)->delete();
        }else{
            DB::table("good")->insert(['guser' => "$user",'garticle' => $article]);
        }
    }

    public function uset(){
        if(session('username')){
            session()->forget('username');
        }
        return redirect("/");

    }
}
