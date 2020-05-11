<?php

$pdo = new PDO("mysql:host=localhost;dbname=sq-blog;charset=utf8","root","");
$sql = "select * from user where uname = '{$_POST["name"]}' ";
$s = $pdo->query($sql);
$res = $s->fetchAll(2);
//var_dump($res);
if($res){
    //查到了  不能注册
    echo "查到了";
}else{
    echo "可以注册";
}
