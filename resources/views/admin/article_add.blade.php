
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>添加文章</title>
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


            <!-- 配置文件 -->
            <script type="text/javascript" src="./static/common/ueditor/ueditor.config.js"></script>
            <!-- 编辑器源码文件 -->
            <script type="text/javascript" src="./static/common/ueditor/ueditor.all.js"></script>


            <fieldset class="layui-elem-field layui-field-title">
                <legend>添加文章</legend>
            </fieldset>


            <form class="layui-form " action="/articleadddo" method="post">

                {{ csrf_field() }}
                <div class="layui-form-item">
                    <label class="layui-form-label"></label>
                    <div class="layui-input-block">
                        <img class="pic_url" src="./static/common/image/pic.png" height="200px" id="purl"/>
                    </div>
                </div>


                <div class="layui-form-item">
                    <label class="layui-form-label">封面</label>
                    <div class="layui-input-inline">
                        <input type="text" name="pic" id="pic_url" placeholder="不要碰我!!!" autocomplete="off" class="layui-input" disabled>
                    </div>
                    <div class="layui-word-aux">
                        <button type="button" class="layui-btn" id="pic">
                            <i class="layui-icon">&#xe67c;</i>上传图片
                        </button>
                    </div>

                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">标题</label>
                    <div class="layui-input-inline">
                        <input type="text" name="title" placeholder="" autocomplete="off" class="layui-input">
                    </div>
                </div>
                
                <div class="layui-form-item">
                    <label class="layui-form-label">分类</label>
                    <div class="layui-input-inline" style="width: 200px">
                        <select name="type">

                        @foreach($type as $k=>$v)
                            <option value="{{ $v->id }}">{{ $v->tname }}</option>
                        @endforeach    
                        </select>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">内容</label>
                    <div class="layui-input-block" style="width:810px;">
                        <script id="container" name="body" style="height: 500px" type="text/plain"></script>
                        </div>
                        </div>

                        
                        
                            
                            <div class="layui-form-item">
                            <div class="layui-input-block">
                            <button class="layui-btn" lay-submit lay-filter="submit">立即提交</button>

                            </div>
                            </div>
                        <input type="hidden" value="" id="picurl" name="picurl">
                            </form>


        </div>
    </div>
</div>

                    <script>
                        var ue = UE.getEditor('container');
                        setTimeout(function () {
                            ue.setHeight(500)
                        },500)
                        layui.use(['form', 'upload'], function () {
                            var form = layui.form,
                                layer = layui.layer,
                                upload = layui.upload;


                            upload.render({
                                elem: '#file' //绑定元素
                                , url: "./upload" //上传接口
                                , done: function (res) {
                                    //上传完毕回调
                                    if (res.code == 1) {
                                        $("#file_url").val(res.url);
                                    } else {
                                        layer.msg(res.info, function () { })
                                    }
                                }, error: function () {
                                    layer.msg("上传异常");
                                }
                            });

                            upload.render({
                                elem: '#pic' //绑定元素
                                , url: "/upload" //上传接口
                                ,data: {'_token':'{{csrf_token()}}'} //可选项。额外的参数，如：{id: 123, abc: 'xxx'}
                                , done: function (res) {
                                    //上传完毕回调
                                    if (res.code == 1) {
                                        $("#pic_url").val(res.url);
                                        $(".pic_url").attr("src", res.url);
                                    } else {
                                        // layer.msg(res.info, function () { })
                                        layer.msg("上传成功");
                                        // console.log(res.name);
                                        $("#purl").attr("src",res.name);
                                        $("#pic_url").val(res.name);
                                        $("#pic_url").attr('placeholder',res.name);
                                        $("#picurl").val(res.name);
                                    }
                                }, error: function () {
                                    layer.msg("上传异常");
                                }
                            });

                            // form.on('submit(submit)', function (data) {
                            //     layer.load({ time: 0 });
                            //     $.post(data.form.action, data.field, function (e) {
                            //         layer.closeAll('loading');
                            //         if (e.code == 1) {
                            //             layer.msg(e.msg, { icon: 1, shade: 0.5, });
                            //             setTimeout(function () { window.location.href = e.url; }, 1000);
                            //         } else {
                            //             layer.msg(e.msg, { icon: 2, shade: 0.5, time: 2000, shadeClose: true });
                            //         }
                            //     })
                            //     return false;
                            // });
                        });
                        </script>
                        <script src="./static/admin/js/config.js"></script>
                        <script src="./static/admin/js/script.js"></script>
</body>
</html>
