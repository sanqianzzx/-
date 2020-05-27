<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AdminController extends Controller
{
    //首页

    public function index(){

       
        return view('./admin/index');
    }


    //登录
    public function login(){
        
        return view('./admin/login');
    }
    public function logindo(){
        
        if(session('user')){
            session()->forget('user');
        }

        $res = DB::select("select * from admin where name='{$_POST["user"]}'");
        
        if($res){

            if(!$res[0]->status){
                echo "<script>alert('您已被封禁');location.href='adminlogin';</script>";
                die;
            }
            if($_POST['pwd'] == $res[0]->password){
                session(['user' => $_POST['user']]);
                return redirect("adminindex");
            }else{
                echo "<script>alert('用户名或密码错误');location.href='adminlogin';</script>";
                
            }
        }else{
            echo "<script>alert('用户名或密码错误');location.href='adminlogin';</script>";
            
        }
        
    }


    //类别
    public function typeindex(){
        $res = DB::select("select * from type");
        return view("./admin/type_index",["type" => $res]);
    }

    public function type_stu(){
        if($_POST['class'] == "layui-btn layui-btn-danger"){
            DB::table("type")->where('id',$_POST['id'])->update(['status'=>1]);
        }else{
            DB::table("type")->where('id',$_POST['id'])->update(['status'=>0]);
        }
    }

    public function typeadd(){
        return view('admin/type_add');
    }
    public function typeadddo(){
        // var_dump($_POST);
        $res = DB::table("type")->insert(['tname'=>$_POST['name'],'status'=>$_POST['pid']]);
        if($res){
            echo "<script>alert('添加成功');location.href='admintypeindex';</script>";
        }else{
            echo "<script>alert('由于某种错误,添加失败,请联系程序');location.href='admintypeindex';</script>";
        }
    }

    public function typedel(){
        $res = DB::select("select * from article where type = {$_POST['id']}");
        if(!$res){
            DB::table("type")->where('id',$_POST['id'])->delete();
        }else{
            echo "该类别下有文章不能删除";
        }

        
    }



    //管理员

    public function adminlist(){
        $admin = DB::select("select * from admin");
        return view("admin/adminlist",['admin' => $admin]);
    }
    public function adminadd(){

        return view("admin/adminadd");
    }

    public function adminadddo(){
        
        $res = DB::table('admin')->insert(['name'=>$_POST['name'],'password'=>$_POST['pwd']]);
        if($res){
            echo "<script>alert('添加成功');location.href='adminlist';</script>";
        }else{
            echo "<script>alert('由于某种错误,添加失败,请联系程序');location.href='adminlist';</script>";
        }
    }

    public function adminstu(){
        if($_POST['class'] == "layui-btn layui-btn-danger"){
            DB::table("admin")->where('id',$_POST['id'])->update(['status'=>1]);
        }else{
            DB::table("admin")->where('id',$_POST['id'])->update(['status'=>0]);
        }
        
    }

    public function admindel(){
        DB::table("admin")->where('id',$_POST['id'])->delete();
        
    }

    public function adminupdate($id){
        
        $arr = DB::select("select id,name,password from admin where id = $id");
        session()->flash('id', $arr[0]->id);
        return view("admin/adminupdate",['arr'=>$arr]);
    }

    public function adminupdo(){
        echo session('id');
        // var_dump($_POST);
        $res = DB::table("admin")->where("id",session('id'))->update(['password'=>$_POST['pwd']]);
        if($res){
            echo "<script>alert('修改成功');location.href='adminlist';</script>";
        }else{
            echo "<script>alert('由于某种错误,修改失败,请联系程序');location.href='adminlist';</script>";
        }

    }

    public function adminerror(){
        return view("admin/adminerror");
    }


    //文章
    public function articleindex(){

        $res = DB::select("select article.id,aname,tname,time,look,pic from article,type where article.type = type.id");
        return view("admin/article_index",['res'=>$res]);
    }

    public function articleadd(){

        $res = DB::select("select * from type");
        return view("admin/article_add",['type'=>$res]);
    }

    public function articleadddo(){
        if(isset($_POST['body'])){
            if(!$_POST['title'] || !$_POST['picurl'] || !$_POST['body']){
                echo "<script>alert('添加失败,请重新确认选项,确保所有选项都有内容');location.href='articleadd';</script>";
                return;
            }
        }else{
            echo "<script>alert('添加失败,请重新确认选项,确保所有选项都有内容');location.href='articleadd';</script>";
            return;
        }
        $time = time();
        
        $res = DB::table('article')->insert(['aname'=>$_POST['title'],'type'=>$_POST['type'],'content'=>$_POST['body'],'time'=>$time,'pic'=>$_POST['picurl']]);
        if($res){
            echo "<script>alert('添加成功');location.href='articleindex';</script>";
        }else{
            echo "<script>alert('添加失败');location.href='articleadd';</script>";
        }
    
    }

    public function articledel(){
        
        $pic = DB::select("select pic from article where id = {$_POST['id']}");  
        if(isset($pic)){
            $pic = $pic[0]->pic;
            unlink($pic);
           
        }

        DB::table("article")->where('id',$_POST['id'])->delete();
        
    }

    public function articleupdate($id){
        $arr = DB::select("select * from article where id = $id");
        
        $type = DB::select("select * from type");
        session(['id' => $arr[0]->id]);
        
        return view("admin/articleupdate",['arr'=>$arr,'type'=>$type]);
    }

    public function articleupdo(){
        
        $time = time();
        $id = session('id');
        session()->forget('id');
        if(isset($_POST['body'])){
            
            if(!$_POST['title'] || !$_POST['picurl'] || !$_POST['body']){
               
                echo "<script>alert('修改失败,请重新确认选项,确保所有选项都有内容');location.href='/articleupdate/".$id."';</script>";
            }
        }else{
            
            echo "<script>alert('修改失败,请重新确认选项,确保所有选项都有内容');location.href='/articleupdate/".$id."';</script>";
            
        }
        
        // var_dump($_POST);die;
        $res = DB::table("article")->where("id",$id)->update(['aname'=>$_POST['title'],'type'=>$_POST['type'],'content'=>$_POST['body'],'time'=>$time,'pic'=>$_POST['picurl']]);
        if($res){
            echo "<script>alert('修改成功');location.href='articleindex';</script>";
        }else{
            echo "<script>alert('修改失败,请重新确认选项,确保所有选项都有内容');location.href='/articleupdate/".$id."';</script>";
        }

    }

    public function upload(){
        return view("admin/upload");
    }

    public function userlist(){
        
        $user = DB::select("select * from user");
        return view('admin/userlist',['user'=>$user]);
    }

    public function userfk(){
        $fk = DB::select("select * from fankui");
        return view('admin/fk',['fk'=>$fk]);

    }

    public function fkdetails($id){
        $res = DB::select("select * from fankui where id = $id");
        session()->put('fkid',$id);
        return view("admin/fkdetails",['res'=>$res]);
    }

    public function a_fkdo(){

        $review = $_POST['review'];
        $time = time();
        $id = session()->get('fkid');

        $res = DB::table("fankui")->where('id',$id)->update(['read'=>1,'time'=>$time,'review'=>$review]);
        session()->forget('fkid');
        if($res){
            echo "<script>location.href='userfk';</script>";
        }else{
            echo "<script>location.href='userfk';</script>";
        }
    }

    public function gg_add(){

        return view("admin/gg");
    }

    public function gg_do(){

        $res = DB::table("gg")->where("id",1)->update(["content"=>$_POST['content']]);
        if($res){
            echo "<script>alert('修改成功');location.href='adminindex';</script>"; 
        }else{
            echo "<script>alert('修改失败');location.href='adminindex';</script>"; 
        }

    }

    //清除无用图片
    public function clear(){

        $arr = [];

        function myreaddir($dir) {
            $handle=opendir($dir);
            $i=0;
            while(!!$file = readdir($handle)) {
                if (($file!=".")and($file!="..")) {
                    $list[$i]=$file;
                    $i=$i+1;
                }
            }
            closedir($handle);
            return $list;
        }
        $facearray = myreaddir("./uploads");
        
        $res = DB::select("select pic from article");
        
        foreach($res as $v){
            $arr[] = $v->pic;
        }
        
        for($i = 0;$i < count($arr);$i++){
            $arr[$i] = substr($arr[$i],8);
           
        }
        for($t = 0;$t < count($facearray);$t++){
          
            if(in_array($facearray[$t],$arr) || $facearray[$t] == "ueditor"){
            
            }else{
                unlink("./uploads/".$facearray[$t]);
                
            }
        }
        return redirect("/adminindex");

    }

    //退出登录
    public function out(){
        if(session('user')){
            session()->forget('user');
        }
        return redirect("adminlogin");
    }
}
