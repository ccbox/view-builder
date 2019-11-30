<table id="<?= $data->getElem() ?>" lay-filter="test"></table>

<script type="text/javascript">
    layui.use(['table'], function() {
        var table = layui.table;
        table.render({
            elem: '#<?= $data->getElem() ?>'
            <?= $data->height ? ',height:' . $data->height : '' ?>,
            cols: [<?= $data->opCols() ?>],
            data: <?= $data->opData() ?>
        });
    });
</script>