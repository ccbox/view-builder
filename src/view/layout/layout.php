<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="http://www.layuicdn.com/layui-v2.5.5/css/layui.css" />
</head>

<body>
    <script src="http://www.layuicdn.com/layui-v2.5.5/layui.js"></script>

    <fieldset class="layui-elem-field layui-field-title">
        <legend><?= $data['title'] ?></legend>
        <div class="layui-field-box">
            <?= $data['description'] ?>
        </div>
    </fieldset>

    <?= $data['html'] ?>
</body>

</html>