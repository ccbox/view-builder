<h3><?= $data->title ?></h3>

<table id="<?= $data->elem() ?>" lay-filter="<?= $data->elem() ?>-filter"></table>

<script type="text/html" id="<?= $data->elem() ?>-toolbar">
    <div class="layui-btn-container">
        <button class="layui-btn layui-btn-sm" lay-event="getCheckData">获取选中行数据</button>
        <button class="layui-btn layui-btn-sm" lay-event="getCheckLength">获取选中数目</button>
        <button class="layui-btn layui-btn-sm" lay-event="isAll">验证是否全选</button>
    </div>
</script>

<script type="text/html" id="<?= $data->elem() ?>-row-actions">
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
    layui.use(["table"], function() {
        var $ = layui.$;
        var table = layui.table;
        table.render(<?= $data->opTableRender() ?>);

        //头工具栏事件
        table.on('toolbar(<?= $data->elem() ?>-filter)', function(obj) {
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

        //监听行工具事件
        table.on('tool(<?= $data->elem() ?>-filter)', function(obj) {
            var data = obj.data;
            var pkey = "<?= $data->pkey ?>";
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
                                console.log(data);
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
    });
</script>