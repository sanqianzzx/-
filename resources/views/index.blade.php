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

                    <!-- Right -->
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

    <!--Main layout-->
    <main class="mt-5 pt-5">
    
        <div class="container" >

            <!--Section: Jumbotron-->
            <section class="card blue-gradient wow fadeIn" id="intro">

                <!-- Content -->
                <div class="card-body text-white text-center py-5 px-5 my-5">

                    <h1 class="mb-4">
                        <strong>欢迎来到 时迁</strong>
                    </h1>
                    <p>
                        <strong>但愿日子清静抬头遇见的满是柔情</strong>
                    </p>
                    <!-- <p class="mb-4">
                        <strong>我会在这里发布一些有趣的文章</strong>
                    </p> -->
                    

                </div>
                <!-- Content -->
            </section>
            <!--Section: Jumbotron-->
            <div style="overflow:hidden">
                <select class="form-control" id="type">
                    <option class="t" value="0"> 全部 </option>
                @foreach($type as $k=>$v)
                    @if($newtype == $v->id)
                    <option class="t" value=" {{ $v->id }} " selected>{{ $v->tname }}</option>
                    @else
                    <option class="t" value=" {{ $v->id }} " >{{ $v->tname }}</option>
                    @endif
                @endforeach
                </select>

                
            </div>

            <!--Section: Cards-->
            <section class="pt-5">
                
                <!-- Heading & Description -->
                
                <!-- Heading & Description -->

            @foreach($text as $ii)    
                <!--Grid row-->
                <div class="row wow fadeIn">

                    <!--Grid column-->
                    <div class="col-lg-5 col-xl-4 mb-4">
                        <!--Featured image-->
                        <div class="view overlay rounded z-depth-1">
                            <img src="/{{ $ii->pic }}" width="350px" height="183px">
                            <a href="/article/{{ $ii->id }}" >
                                <div class="mask rgba-white-slight"></div>
                            </a>
                        </div>
                    </div>
                    <!--Grid column-->

                    <!--Grid column-->

                
                    <div class="col-lg-7 col-xl-7 ml-xl-4 mb-4">
                        <h3 class="mb-3 font-weight-bold dark-grey-text">
                            <strong> {{ $ii->aname }} </strong>
                        </h3>
                        <p class="type">{{ $ii->type }}</p>
                        <p class="grey-text"> {{ $ii->content }} </p>
                        <a href="/article/{{ $ii->id }}" class="btn btn-primary btn-md" >查看详情
                            <i class="fas fa-play ml-2"></i>
                        </a>
                        
                    </div>
                    <!--Grid column-->
                
                </div>
                <!--Grid row-->

                <hr class="mb-5">
            @endforeach

                

                

            </section>
            <!--Section: Cards-->

        </div>
    </main>
    <!--Main layout-->

    <!--Footer-->
    <footer class="page-footer text-center font-small mdb-color darken-2 mt-4 wow fadeIn">

        <!--Call to action-->
        
        <!--/.Call to action-->

        <!--Copyright-->
        <div class="footer-copyright py-3">
            © 2020 sq.com 
        </div>
        <!--/.Copyright-->

    </footer>
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
    $("#type").change(function(){
        // alert($(this).val());
        var id = $(this).val(); 

        location.href = "/?id="+id+"";
    })


    
</script>