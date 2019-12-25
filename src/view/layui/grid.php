<?php if ($data->title) {
    echo '<h3>';
    echo $data->title;
    echo '</h3>';
} ?>

<?php
    if ($data->hasFilter()) {
?>
    <div class="searchbar" id="<?php echo $data->elem(); ?>-searchbar">
        <form class="layui-form" action="" lay-filter="<?php echo $data->elem(); ?>-searchbar-form">
            <?php foreach ($data->filterFields as $filter) { ?>
                <div class="layui-inline">
                    <label class="layui-form-label" style="<?php echo $filter['text_style']; ?>"><?php echo $filter['text']; ?></label>
                    <div class="layui-input-inline" style="<?php echo $filter['style']; ?>">
                            <?php if($filter['type']=='text'){ ?>
                                <input class="layui-input" 
                                    name="<?php echo $filter['name']; ?>" 
                                    placeholder="<?php echo $filter['placeholder']; ?>" 
                                    value="<?php echo $filter['value']; ?>" 
                                    autocomplete="<?php echo $filter['autocomplete']; ?>" 
                                />
                            <?php } ?>
                            <?php if($filter['type']=='select'){ ?>
                                <select name="<?php echo $filter['name']; ?>">
                                    <option value=""></option>
                                    <?php foreach ($filter['option'] as $key=>$val) { ?>
                                        <option value="<?php echo $key; ?>" <?php if($filter['value']==$key){echo 'selected'; }?>><?php echo $val; ?></option>
                                    <?php } ?>
                                </select>
                            <?php } ?>
                        </div>
                    </div>
            <?php } ?>
            
            <button class="layui-btn" lay-submit lay-filter="<?php echo $data->elem(); ?>-searchbar">搜索</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </form>
    </div>
<?php } ?>

<table id="<?php echo $data->elem(); ?>" lay-filter="<?php echo $data->elem(); ?>-filter"></table>

<script type="text/html" id="<?php echo $data->elem(); ?>-toolbar">
    <div class="layui-btn-container">
        <button class="layui-btn layui-btn-sm" lay-event="getCheckData">获取选中行数据</button>
        <button class="layui-btn layui-btn-sm" lay-event="getCheckLength">获取选中数目</button>
        <button class="layui-btn layui-btn-sm" lay-event="isAll">验证是否全选</button>
    </div>
</script>

<script type="text/html" id="<?php echo $data->elem(); ?>-row-actions">
    <?php foreach ($data->rowActions as $action) {
        $echo = '    ';
        $echo .= '<a class="layui-btn layui-btn-xs ' . $action['class'] . '" ';
        $echo .= 'url="' . $action['url'] . '" ';
        $echo .= 'type="' . $action['type'] . '" ';
        $echo .= 'event="' . $action['event'] . '" ';
        $echo .= 'msg="' . $action['msg'] . '" ';
        $echo .= $action['style'] ? 'style="' . $action['style'] . '" ' : '';
        $echo .= 'lay-event="' . $action['event'] . '">';
        $echo .= $action['icon'] ? '<i class="layui-icon layui-icon-' . $action['icon'] . '"></i>' : '';
        $echo .= $action['text'];
        $echo .= '</a>';
        echo $echo . "\r\n";
    } ?>
</script>

<script type="text/javascript">
    // console.log(layui);
    if(typeof layui == "undefined"){
        alert("UI组件读取失败，请刷新页面");
    }
    layui.use(["table", "form"], function() {
        var $ = layui.$;
        var table = layui.table;
        var form = layui.form;
        table.render(<?php echo $data->opTableRender(); ?>);

        //头工具栏事件
        table.on('toolbar(<?php echo $data->elem(); ?>-filter)', function(obj) {
            var checkStatus = table.checkStatus(obj.config.id);
            switch (obj.event) {
                case 'getCheckData':
                    var data = checkStatus.data;
                    layer.alert(JSON.stringify(data));
                    break;
                case 'getCheckLength':
                    var data = checkStatus.data;
                    layer.msg('选中了：' + data.length + ' 个');
                    break;
                case 'isAll':
                    layer.msg(checkStatus.isAll ? '全选' : '未全选');
                    break;

                    //自定义头工具栏右侧图标 - 提示
                case 'LAYTABLE_TIPS':
                    layer.alert('这是工具栏右侧自定义的一个图标按钮');
                    break;
            };
        });
        
        //监听排序事件
        table.on('sort(<?php echo $data->elem(); ?>-filter)', function(obj) {
            // console.log(obj.field); //当前排序的字段名
            // console.log(obj.type); //当前排序类型：desc（降序）、asc（升序）、null（空对象，默认排序）
            table.reload('<?php echo $data->elem(); ?>', {
                initSort: obj //记录初始排序，如果不设的话，将无法标记表头的排序状态。
                ,where: { //请求参数（注意：这里面的参数可任意定义，并非下面固定的格式）
                    orderby: obj.field +" "+ obj.type //排序方式
                }
            });
            return false;
        });

        //监听行工具事件
        table.on('tool(<?php echo $data->elem(); ?>-filter)', function(obj) {
            var data = obj.data;
            var pkey = "<?php echo $data->pkey; ?>";
            // var url = this.attributes['url'].value.replace("##"+pkey+"##", data[pkey]);
            var url = this.attributes['url'].value.replace("###", data[pkey]);
            var msg = this.attributes['msg'].value;
            var type = this.attributes['type'].value;
            var event = this.attributes['event'].value;
            // console.log(obj);

            var handleRequest = function() {
                if (url) {
                    if (type == "post" || type == "get") {
                        $.ajax({
                            url,
                            data: {},
                            type,
                            dataType: "json",
                            success: function(data) {
                                // console.log(data);
                                layer.msg("请求成功：" + data.code + " - " + data.msg);
                                if (event == "delete") {
                                    obj.del();
                                }
                            },
                            error: function(data) {
                                layer.msg(data.msg);
                            }
                        });
                    } else if (type == "jump") {
                        window.location.href = url;
                    } else {
                        window.open(url);
                    }
                }
            }

            if (msg) {
                layer.msg(msg);
            }

            switch (obj.event) {
                case 'confirm':
                case 'delete':
                    layer.confirm(msg, function(index) {
                        handleRequest();
                        layer.close(index);
                    });
                    break;
                case 'tips':
                    layer.tips(msg, this, {
                        tips: [1, '#FF5722']
                    });
                    handleRequest();
                    break;
                case 'msg':
                default:
                    handleRequest();
            };

        });
        
        //监听提交
        form.on('submit(<?php echo $data->elem(); ?>-searchbar)', function(data){
            var formdata = data.field;
            //执行重载
            table.reload('<?php echo $data->elem(); ?>', {
                page: {
                    curr: 1 //重新从第 1 页开始
                }
                ,where: formdata
            });
            return false;
        });
    });
</script>