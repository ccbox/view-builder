<h3><?= $data->title ?></h3>

<table id="<?= $data->elem() ?>" lay-filter="test"></table>

<script type="text/javascript">
    layui.use(['table'], function() {
        var table = layui.table;
        table.render(<?= $data->opTableRender() ?>);
    });
</script>