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
        #Dtype{
            
            margin-top: 20px;
            height: 30px;
            line-height: 30px; 
            position: relative;
            
        }
        
        #type{
            margin-top: 20px;
            width: 100px;
            float: left;
        }
        #list{
            float: right;
            margin-right: 0px;
            line-height: 38px;
        }
        #bg{

            background: url('/img/bg.png') no-repeat;
            width: 100%;
            height: 100%;
            background-size: cover;
            position: absolute;
            overflow: hidden;
            z-index: -1;
        }

    </style>
</head>

<body>

    <!--Main Navigation-->
    <header>

        <!-- Navbar -->
        <nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
            <div class="container">

                <!-- Brand -->
                <a class="navbar-brand waves-effect" href="/">
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
                            <a class="nav-link waves-effect" href="/gg">关于 时迁</a>
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
    <div id="bg"></div>
    <!--Main layout-->
    <main class="mt-5 pt-5" style="min-height:100%">
        
        <div class="container" >

            <!--Section: Jumbotron-->
            
            <!--Section: Jumbotron-->
            
            <!--Section: Cards-->
            <div><h1 style="color:#2196f3">反馈:</h1></div>
            <form action="/fkdo" method="post" >
            {{ csrf_field() }}
            <input name="email" id="email" placeholder="请留下您的联系方式,如邮箱" style="width:100%;">
            <div style="width:100%;height:400px;margin-top:20px">
                
                <textarea id="text" style="width:100%;height:300px" name="text" placeholder="请给我们留下您宝贵的意见吧..."></textarea>
            
            </div>
            <button  class="btn btn-primary">提交</button>
            </form>
        </div>
    </main>
    <!--Main layout-->

    <!--Footer-->
    
    <!--/.Footer-->

    <!-- SCRIPTS -->
    <!-- JQuery -->
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
    var a;
    var flag = false;
    var flag2 = false;
    $.ajaxSettings.async = false;
    $.post("/session",{'_token':'{{csrf_token()}}'},function(data){
        a = data;
    })
    $.ajaxSettings.async = true;

    $("#text").focus(function(){
        if(a == "请先登录"){
            $(this).blur();
            alert(a);
            location.href = '/login';
        }  
    })
    $("#text").blur(function(){
        if($(this).val() == ""){
            $(this).attr("placeholder","请至少说点什么吧");
            flag = false;
        }else{
            flag = true;
        }
    })
    $("#email").blur(function(){
        if($(this).val() == ""){
            $(this).attr("placeholder","请留下您的联系方式");
            flag2 = false;
        }else{
            flag2 = true;
        }
    })
    $("form").submit(function(){
        $("#text").trigger("focus");
        $("#text").trigger("blur");
        if(!flag || !flag2){
            return false;
        }
        
    })
    
</script>