
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>用户反馈</title>
    <link rel="stylesheet" href="./static/common/layui/css/layui.css">
    <link rel="stylesheet" href="./static/admin/css/style.css">
    <script src="./static/common/jquery-3.3.1.min.js"></script>
    <script src="./static/common/layui/layui.js"></script>
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
                    
                    <th>发送者</th>
                    
                    <th>时间</th>

                    <th>是否回复</th>

                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                
            @foreach($fk as $k=>$v)  
                @if(!$v->read)  
                <tr class="id9" style="background-color:#FFB800">
                    <td>{{ $v->id }}</td>
                    
                    <td>{{ $v->user }}</td>

                    <td>{{ date("Y-m-d H:i:s",$v->time) }}</td>
                    <td >未回复</td>
                    <td><a href="/fkdetails/{{ $v->id }}">查看</a></td>
                </tr>
                @else
                <tr class="id9" style="background-color:#5FB878">
                    <td>{{ $v->id }}</td>
                    
                    <td>{{ $v->user }}</td>

                    <td>{{ date("Y-m-d H:i:s",$v->time) }}</td>
                    <td>已回复</td>
                    <td><a href="/fkdetails/{{ $v->id }}">查看</a></td>
                </tr>
                @endif
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

