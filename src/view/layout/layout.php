<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <!-- <link rel="stylesheet" type="text/css" href="http://www.layuicdn.com/layui-v2.5.5/css/layui.css" /> -->
    <?php echo $data['depends']['css']; ?>
    <!-- <script src="http://www.layuicdn.com/layui-v2.5.5/layui.js"></script> -->
    <?php echo $data['depends']['js']; ?>
</head>

<body>

    <fieldset class="layui-elem-field layui-field-title">
        <legend><?php echo $data['title']; ?></legend>
        <div class="layui-field-box">
            <?php echo $data['description']; ?>
        </div>
    </fieldset>

    <?= $data['html'] ?>
</body>

</html>