
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>文章管理</title>
    <link rel="stylesheet" href="./static/common/layui/css/layui.css">
    <link rel="stylesheet" href="./static/admin/css/style.css">
    <script src="./static/common/layui/layui.js"></script>
    <script src="./static/common/jquery-3.3.1.min.js"></script>
    <script src="./static/common/vue.min.js"></script>
</head>
<body>
<div id="app">
    <!--顶栏-->
    <header>
        <h1 v-text="webname"></h1>
        <div class="breadcrumb">
            <i class="layui-icon">&#xe715;</i>
            <ul>
                <li v-for="vo in address">
                    <a  v-text="vo.name" :href="vo.url" ></a> <span>/</span>
                </li>
            </ul>
        </div>
    </header>

    <div class="main" id="app">
        <!--左栏-->
        <div class="left">
            <ul class="cl" >
                <!--顶级分类-->
                <li v-for="vo,index in menu" :class="{hidden:vo.hidden}">
                    <a href="javascript:;"  :class="{active:vo.active}"  @click="onActive(index)">
                        <i class="layui-icon" v-html="vo.icon"></i>
                        <span v-text="vo.name"></span>
                        <i class="layui-icon arrow" v-show="vo.url.length==0">&#xe61a;</i> <i v-show="vo.active" class="layui-icon active">&#xe623;</i>
                    </a>
                    <!--子级分类-->
                    <div v-for="vo2,index2 in vo.list">
                        <a href="javascript:;" :class="{active:vo2.active}" @click="onActive(index,index2)" v-text="vo2.name"></a>
                        <i v-show="vo2.active" class="layui-icon active">&#xe623;</i>
                    </div>
                </li>
            </ul>
        </div>
        <!--右侧-->
        <div class="right">



            <a href="articleadd" class="layui-btn"><i class="layui-icon">&#xe654;</i>添加文章</a>

            <table class="layui-table layui-form">
                <colgroup>
                    <col width="80">
                    <col width="100">
                    <col width="100">
                    <col>
                    <col width="90">
                    
                    <col width="200">
                    <col width="150">
                </colgroup>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>缩略图</th>
                    <th>分类</th>
                    <th>标题</th>
                    <th>浏览</th>
                    
                    <th>时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
            
            @foreach($res as $k=>$v)
                <tr class="id84">
                    <td>{{ $v->id }}</td>
                    <td><img src="{{ $v->pic }}" height="50px"/></td>
                    <td>{{ $v->tname }}</td>
                    <td>{{ $v->aname }}</td>
                    <td>{{ $v->look }}</td>
                    

                    <td>{{ date("Y-m-d H:i:s",$v->time) }}</td>
                    <td><a href="{{ url('./articleupdate', ['id' => $v->id ]) }}">修改</a> | <a class="articledel" data-id=".id84" aid="{{ $v->id }}">删除</a></td>
                </tr>
            @endforeach    
                </tbody>
            </table>


            <!-- <div class="page"><ul class="pagination"><li class="disabled"><span>&laquo;</span></li> <li class="active"><span>1</span></li><li><a href="/admin/user/index.html?page=2">2</a></li><li><a href="/admin/user/index.html?page=3">3</a></li><li><a href="/admin/user/index.html?page=4">4</a></li><li><a href="/admin/user/index.html?page=5">5</a></li><li><a href="/admin/user/index.html?page=6">6</a></li><li><a href="/admin/user/index.html?page=7">7</a></li><li><a href="/admin/user/index.html?page=8">8</a></li><li class="disabled"><span>...</span></li><li><a href="/admin/user/index.html?page=109">109</a></li><li><a href="/admin/user/index.html?page=110">110</a></li> <li><a href="/admin/user/index.html?page=2">&raquo;</a></li></ul></div> -->

            
        </div>
    </div>
</div>
<script>
    

    $(document).on('click', '.articledel', function() {
        $.ajaxSettings.async = false;
        $.post('/articledel',{'_token':'{{csrf_token()}}','id':$(this).attr('aid')},function(data){
            console.log(data);    
        })
        $.ajaxSettings.async = true;
        $(this).parent().parent().remove();
    })
    

    // layui.use('form', function () {
    //     var form = layui.form, layer = layui.layer, $ = layui.jquery;

    //     form.on('switch(state)', function(data) {
    //         var id = $(data.elem).attr("data-id");
    //         $.ajax({
    //             url: "/admin/article/state.html",
    //             data: {
    //                 id: id,
    //             },
    //             type: "get",
    //             dataType: "json",
    //             success: function(e) {
    //                 if (e.code== 1) {
    //                     layer.msg(e.msg, {
    //                         icon: 1
    //                     });
    //                 } else {
    //                     layer.msg(e.msg, {
    //                         icon: 2,
    //                         shade: 0.5,
    //                         time: 2000,
    //                         shadeClose: true
    //                     });
    //                 }
    //             }
    //         });
    //     });

    //     form.on('switch(top)', function(data) {
    //         var id = $(data.elem).attr("data-id");
    //         $.ajax({
    //             url: "/admin/article/top.html",
    //             data: {
    //                 id: id,
    //             },
    //             type: "get",
    //             dataType: "json",
    //             success: function(e) {
    //                 if (e.code== 1) {
    //                     layer.msg(e.msg, {
    //                         icon: 1
    //                     });
    //                 } else {
    //                     layer.msg(e.msg, {
    //                         icon: 2,
    //                         shade: 0.5,
    //                         time: 2000,
    //                         shadeClose: true
    //                     });
    //                 }
    //             }
    //         });
    //     });

    //     form.on('switch(experiment)', function(data) {
    //         var id = $(data.elem).attr("data-id");
    //         $.ajax({
    //             url: "/admin/article/experiment.html",
    //             data: {
    //                 id: id,
    //             },
    //             type: "get",
    //             dataType: "json",
    //             success: function(e) {
    //                 if (e.code== 1) {
    //                     layer.msg(e.msg, {
    //                         icon: 1
    //                     });
    //                 } else {
    //                     layer.msg(e.msg, {
    //                         icon: 2,
    //                         shade: 0.5,
    //                         time: 2000,
    //                         shadeClose: true
    //                     });
    //                 }
    //             }
    //         });
    //     });

    //     form.on('switch(works)', function(data) {
    //         var id = $(data.elem).attr("data-id");
    //         $.ajax({
    //             url: "/admin/article/works.html",
    //             data: {
    //                 id: id,
    //             },
    //             type: "get",
    //             dataType: "json",
    //             success: function(e) {
    //                 if (e.code== 1) {
    //                     layer.msg(e.msg, {
    //                         icon: 1
    //                     });
    //                 } else {
    //                     layer.msg(e.msg, {
    //                         icon: 2,
    //                         shade: 0.5,
    //                         time: 2000,
    //                         shadeClose: true
    //                     });
    //                 }
    //             }
    //         });
    //     });
    // });
</script>
<script src="./static/admin/js/config.js"></script>
<script src="./static/admin/js/script.js"></script>
</body>
</html>
