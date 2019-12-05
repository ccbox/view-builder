<?php
/**
 * PHP后台常用视图生成器view-builder
 *
 * @package  Ccbox\ViewBuilder
 * @author   ccbox <ccbox.net@163.com>
 * @version  0.1
 * @license  MIT
 * @link     https://github.com/ccbox/view-builder
 */

require_once '../vendor/autoload.php';

// use Ccbox\ViewBuilder\Grid\Grid;
use Ccbox\ViewBuilder\UiLibs\Layui\Grid;
use Ccbox\ViewBuilder\Layout\Layout;

$table = require_once './data_table.php';

$grid = new Grid();

$grid->page(2);

$grid->title('表格头');

$grid->toolbar('default');

$api = str_replace('index.php', '',$_SERVER['REQUEST_URI']) . 'api.php?type=table';
$grid->url($api);

$grid->col()->type('checkbox');
// $grid->col('id', 'ID')->width(80)->sort()->fixed('left');
$grid->col('username', '用户名');
$grid->col('sex', '性别');
$grid->col('city', '城市');
$grid->col('sign', '签名');
$grid->col('experience', '积分');
$grid->col('score', '评分');
$grid->col('classify', '职业');
$grid->col('wealth', '财富');
$grid->col()->toolbar(function(){
    return 'toolbar';
});

$grid->data($table['data']);

$grid_html = $grid->view();

$content = new Layout();

$html = $content
        ->title('页面标题')
        ->description('页面介绍文字内容')
        ->body($grid_html)
        ->view();

echo $html;