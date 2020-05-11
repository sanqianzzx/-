
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>类别管理</title>
    <link rel="stylesheet" href="./static/common/layui/css/layui.css">
    <link rel="stylesheet" href="./static/admin/css/style.css">
    <script src="./static/common/jquery-3.3.1.min.js"></script>
    <script src="./static/common/layui/layui.js"></script>
    <script src="./static/common/vue.min.js"></script>
    <script>
        $(document).on('click', 'button', function() {
            
            if($(this).attr("class") == "layui-btn layui-btn-danger"){
                
                $.post('/admintype_stu',{'_token':'{{csrf_token()}}','class':$(this).attr("class"),'id':$(this).attr('id')},function(data){    
                })
                    $(this).removeClass();
                    $(this).addClass("layui-btn")
                    $(this).text('显示');
            }else{
                $.post('/admintype_stu',{'_token':'{{csrf_token()}}','class':$(this).attr("class"),'id':$(this).attr('id')},function(data){   
                })
                    $(this).removeClass();
                    $(this).addClass("layui-btn layui-btn-danger")
                    $(this).text('隐藏'); 
                
            }
        });
        $(document).on('click', '.typedel', function() {
            // alert($(this).attr('did'));
            $.ajaxSettings.async = false;
            $.post('/admintypedel',{'_token':'{{csrf_token()}}','id':$(this).attr('did')},function(data){
                if(data != "该类别下有文章不能删除"){
                    $(this).parent().parent().remove();
                }else{
                    alert(data);
                }
            })
            
            $.ajaxSettings.async = true;
        })

    </script>
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

    <div class="main">
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
            <a href="/admintypeadd" class="layui-btn"><i class="layui-icon">&#xe654;</i>添加类别</a>
            <table class="layui-table layui-form">
                <colgroup>
                    <col width="80">
                    <col width="80">
                    <col width="150">
                    <col width="80">
                    <col width="80">
                    <col width="80">
                    <col>
                    <col width="150">
                </colgroup>
                <thead>
                <tr>
                    <th>ID</th>
                    
                    <th>名称</th>
                    
                    <th>显示</th>

                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                
            @foreach($type as $k=>$v)    
                <tr class="id9">
                    <td>{{ $v->id }}</td>
                    
                    <td>{{ $v->tname }}</td>
                @if($v->status)    
                    <td><button type="button" class="layui-btn" id="{{ $v->id }}">显示</button></td>
                @else
                    <td><button type="button" class="layui-btn layui-btn-danger" id="{{ $v->id }}">隐藏</button></td>
                @endif
                    <td><a class="typedel" did="{{ $v->id }}" href="">删除</a></td>
                </tr>
            @endforeach    
                </tbody>
            </table>
        </div>
    </div>
</div>



<script src="./static/admin/js/config.js"></script>
<script src="./static/admin/js/script.js"></script>
</body>
</html>

