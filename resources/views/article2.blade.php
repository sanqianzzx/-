<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>时迁</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="/css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="/css/style.min.css" rel="stylesheet">
    <style>
        #app{
            margin-top: 50px;
            position: relative;
            

        }
        #content{
            box-shadow: 1px 1px 5px #888888;
            width: 73%;
            float: left;
            min-height: 690px;
            z-index: 1;
            background: white;
        }
        .other{
            /* box-shadow: 1px 1px 5px #888888; */
            width: 25%;
            margin-left: 2%;
            float: left;
            margin-top: 40px;
            /* background: white; */
        }
        .review{
            box-shadow: 1px 1px 5px #888888;
            width: 73%;
            float: left; 
            margin-top: 50px;
            text-overflow: ellipsis;
            background: white;
        }
        .pic{
            width: 10%;
            height: 90px;
            float: left;
            line-height: 120px;
            margin-left: 1%;
            
        }
        .b_review1{
            min-height: 120px;
            width: 100%;
            text-overflow: ellipsis;
            word-break: break-all;
            background: white;
            overflow: hidden;
            position: relative;
        }
        .review-uname{
            margin-left: 10px;
            font-size: 20px;
            
        }
        .content1{
            margin-left: 5px;
        }


        .img-responsive{
            max-width: 100px;
        }
        #aname{
            text-align: center;
        }
        #scontent>*{
            text-overflow: ellipsis;
            overflow: hidden;
        }
        #time{
            width: 100%;
            text-align: center;
            /* margin:0 auto; */
        }
        #bg{

            background: url('/img/bg.png') no-repeat;
            width: 100%;
            height: 100%;
            background-size: cover;
            position: fixed;
            overflow: hidden;
            z-index: -1;
        }
        .oli{
            width: 100%;
            height: 70px;
        }
        .opic{
            width: 30%;
            height: 100%;
            float: left;
        }
        .oname{
            width:69%;
            float:left;
            height:100%;
            line-height:70px;
            text-overflow: ellipsis;
            overflow: hidden;
            text-align: center;
        }
        .center-block {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
        #text{
            
            width: 100%;
            height: 100px;
        }
        #editor{
            margin-top: 80px;
            width: 73%;
            height: 200px;

        }
        .time{
            position: absolute;
            right: 10px;
            bottom: 0;
        }
        #top{
            box-shadow: 1px 1px 5px #888888;
            width: 73%;
            background: white;
            margin-top: 20px;
            overflow: hidden;
        }
        .top1{
            width: 24%;
            margin-left: 1%;
            margin-top: 1%;
            float: left;
        }
        .toptu{
            width: 180px;
            height: 100px;
        }
        .topname{
            width: 100%;
            text-overflow: ellipsis;
            word-break: break-all;
        }
        
        
    </style>   
</head>
<body >
    
<header>
<div id="bg"></div>
        <!-- Navbar -->
        <nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar" style="position: relative">
            <div class="container">

                <!-- Brand -->
                <a class="navbar-brand waves-effect" href="/" >
                    <strong class="blue-text">时迁</strong>
                </a>

                <!-- Collapse -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Links -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <!-- Left -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item ">
                            <a class="nav-link waves-effect" href="/">主页
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link waves-effect" href="/gg" >关于 时迁</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link waves-effect" href="/fankui" >联系博主</a>
                        </li>
                        
                    </ul>

                    @if(!session()->has('username'))
                    <ul class="navbar-nav nav-flex-icons">
                        
                        <li class="nav-item">
                            <a class="nav-link waves-effect" href="/login">登录</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link waves-effect" href="/reg">注册</a>
                        </li>
                    </ul>
                    @else
                    <ul class="navbar-nav nav-flex-icons">
                        <li class="nav-item">
                        <a class="nav-link waves-effect" href="#" >{{ session()->get('username') }}</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link waves-effect" href="/uset" >登出</a>
                        </li>
                    </ul>
                    @endif

                </div>

            </div>
        </nav>
        <!-- Navbar -->

    </header>
    <!--Main Navigation-->

    

    <div class="center-block container" id="app" >
        <div style="width:73%"><img style="width:100%; max-height:250px; margin-bottom:30px;" src="/{{ $res[0]->pic }}"></div>
        <div id="content" > 
            <small id="type" class="text-muted">{{ $res[0]->tname }}</small>
            <h1 id="aname" class="text-primary">{{ $res[0]->aname }}</h1>
            <div id="time"><small class="text-muted" >{{ $res[0]->time }}</small></div>
            
            <div id="scontent">{!! $res[0]->content !!}</div>
        </div>
        <div class="other">
            <h4 style=margin-left:30px>相关推荐</h4>
            <ul >
            @foreach($other as $k=>$v)
                <li>
                    <hr>
                    <div >
                        
                        <div ><a href="/article/{{ $v->id }}">{{ $v->aname }}</a></div>
                    </div>
                    
                </li>
            @endforeach 
            </ul>

        </div>

        <div class="other">
        <h4 style=margin-left:30px>最新发布</h4>
            <ul >
            @foreach($other2 as $k=>$v)
                <li>
                    <hr>
                    <div >
                        
                        <div ><a href="/article/{{ $v->id }}">{{ $v->aname }}</a></div>
                    </div>
                    
                </li>
            @endforeach 
            </ul>
        </div>


        <!-- <div class="review">
            <div class="pic">
                <img src="/img/pic/3.jpg" style="width:100%;height:100%" class="img-thumbnail">
            </div>
            <div style="float:left;width:90%;text-overflow:ellipsis;word-wrap:break-word">
                <div class="review-uname1">用户名:</div>
                <div class="review-content1">dsaaaaaaaadsaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaasdaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</div>
                
                <hr>
                <div class="pic">
                    <img src="/img/pic/3.jpg" style="width:100%;height:100%" class="img-thumbnail">
                </div>
                <div class="review-uname2">如果有回复:</div>
                <div class="review-content2">dsaaaaaaaadsaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaasdaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</div>
                <hr>
                <div class="pic">
                    <img src="/img/pic/3.jpg" style="width:100%;height:100%" class="img-thumbnail">
                </div>
                <div class="review-uname2">如果hai有回复:</div>
                <div class="review-content2">dsaaaaaaaadsaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaasdaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</div>
            </div>    
        </div> -->
        <div style="clear: both"></div>

        <div id="top">
            <div ><h3>热门推荐:</h3></div>
            @foreach($top as $k=>$v)
            <div class="top1">
                <div style="width: 95%"><a href="/article/{{ $v->id }}"><img src="/{{ $v->pic }}" class="toptu"></a></div>
                <div class="topname" style="text-align:center"><a href="/article/{{ $v->id }}">{{ $v->aname }}</a></div>
            </div>
            @endforeach
            

        </div>

        <div id="editor">
            <textarea id="text" placeholder="写点什么...."></textarea>
            <div class="text-danger"></div>
            <button class="btn btn-info" id="pl">提交</button>
        </div>
        <div class="review">
            @foreach($review as $k=>$v)
            <div class="review1">
                <div class="b_review1">
                    <div class="pic"><img src="/img/tx.jpg" style="width:100%; max-height:250px;"></div>
                    <div style="float: left;width:89%;overflow:hidden;">
                        <div class="review-uname text-primary">{{ $v->uid }}:</div>
                        <div class="content1">{{ $v->rcontent }}</div>
                        
                    </div>
                    <div class="time"><small>{{ date("Y-m-d H:i:s",$v->time) }}</small></div>
                </div>
                <hr>
                <!-- <div class="b_review2">
                    <div class="review2">
                        <div class="pic"></div>
                        <div class="content2"></div>
                    </div>
                    <div class="review2">
                        <div class="pic"></div>
                        <div class="content2"></div>
                    </div>

                </div> -->    
            </div>
            @endforeach

        </div>


    </div>

    <div style="clear: both"></div>
    <footer class="page-footer text-center font-small mdb-color darken-2 mt-4 wow fadeIn ">

        <!--Call to action-->
        
        <!--/.Call to action-->

        <!--Copyright-->
        <div class="footer-copyright py-3 ">
            © 2020 sq.com 
        </div>
        <!--/.Copyright-->

    </footer>
    <!--/.Footer-->
    <script type="text/javascript" src="/js/jquery-3.4.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="/js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="/js/mdb.min.js"></script>
    <!-- Initializations -->
    <script type="text/javascript">
        // Animations initialization
        new WOW().init();
    </script>
</body>
</html>
<script>
    
    var c;
    var a;
    var b;
    var flag1 = false;
    var flag2 = false;
    $.ajaxSettings.async = false;
    $.post("/session",{'_token':'{{csrf_token()}}'},function(data){
        a = data;
    })
    $.post("/aid",{'_token':'{{csrf_token()}}'},function(data){
        c = data;
    })
    $.ajaxSettings.async = true;

    $("#text").focus(function(){
        if(a == "请先登录"){
            $(".text-danger").html('请先登录');
            flag1 = false;
        }else{
            flag1 = true;
        }  
    })
    $("#text").blur(function(){
        if($(this).val() == ""){
            $(this).attr("placeholder","请至少说点什么吧");
            b = "";
            flag2 = false;
        }else{
            b = $(this).val();
            flag2 = true;
        }
    })
    $("#pl").click(function(){

        $("#text").trigger("focus");
        $("#text").trigger("blur");
        
        if(!flag1 || !flag2){
            
            return false;
        }else{
            //判断是否在前面加0
            function getNow(s) {
            return s < 10 ? '0' + s: s;
            }

            var myDate = new Date();             

            var year=myDate.getFullYear();        //获取当前年
            var month=myDate.getMonth()+1;   //获取当前月
            var date=myDate.getDate();            //获取当前日


            var h=myDate.getHours();              //获取当前小时数(0-23)
            var m=myDate.getMinutes();          //获取当前分钟数(0-59)
            var s=myDate.getSeconds();
            var now=year+'-'+getNow(month)+"-"+getNow(date)+" "+getNow(h)+':'+getNow(m)+":"+getNow(s);
            
            $.post("/reviewadd",{'_token':'{{csrf_token()}}','uname':a,'ucontent':b,'cid':c},function(data){
               
            })

            $(".review").append(`
            
            <div class="review1">
                <div class="b_review1">
                    <div class="pic"><img src="/img/tx.jpg" style="width:100%; max-height:250px;"></div>
                    <div style="float: left;width:89%;overflow:hidden;">
                        <div class="review-uname text-primary">`+a+`:</div>
                        <div class="content1">`+b+`</div>
                    </div>
                    <div class="time"><small>`+now+`</small></div>
                </div>
                <hr>  
            </div>

   
            `)
            $("#text").val('');
        }
        
    })
    
</script>