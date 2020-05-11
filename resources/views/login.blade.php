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
        #bg{

        background: url('/img/bg.png') no-repeat;
        width: 100%;
        height: 100%;
        background-size: cover;
        position: fixed;
        overflow: hidden;
        z-index: -1;
        }
        #uerror{
            height: 20px;
            line-height: 20px;
            color: red;
        }
        #perror{
            height:20px;
            line-height: 20px;
            color: red;
        }
    </style>
</head>

<body >
<div id="bg"></div>
    <!--Main Navigation-->
    
    <!--Main Navigation-->

    <!--Main layout-->
    
    <main class="pt-5" style="height:100%">
   
        <div class="container" style="height:100%">
        <form method="post" action="/logindo">
                {{ csrf_field() }}
        <div class="modal-dialog" style="margin-top: 10%;">
        <div class="modal-content">
            <div class="modal-header">
 
                <h4 class="modal-title text-center" id="myModalLabel">登录</h4>
            </div>
            <div class="modal-body" id = "model-body">
                <div class="form-group">
 
                    <input type="text" id="user" name="user" class="form-control"placeholder="用户名" autocomplete="off">
                </div>
                <div id="uerror" ></div>
                <div class="form-group">
 
                    <input type="password" id="pwd" name="pwd" class="form-control" placeholder="密码" autocomplete="off">
                </div>
                <div id="perror"></div>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                   <button class="btn btn-primary">登录</button>
                </div>
                <!-- <div class="form-group">
                    <button type="button" class="btn btn-default form-control">注册</button>
                </div> -->
 
            </div>
        </div><!-- /.modal-content -->
    </div>
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
    var i1 = false;
    var i2 = false;
    $("#user").blur(function(){
        var v = $(this).val();
        if(v == ""){
            $("#uerror").html("请填写用户名");
            i1 = false;
        }else{
            $("#uerror").html("");  
            i1 = true;
        }
    })
    $("#pwd").blur(function(){
        var p = $(this).val();
        if(p == ""){
            $("#perror").html("请填写密码");
            i2 = false;
        }else{
            $("#perror").html("");  
            i2 = true;
        }
    })
    $("form").submit(function(){
        $("#user").trigger("blur");
        $("#pwd").trigger("blur");
        if(!i1 || !i2){
            return false;
        }
    })
    
</script>