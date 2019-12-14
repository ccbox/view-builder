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

require_once './_test_base.php';

require_once '../vendor/autoload.php';

// use Ccbox\ViewBuilder\Grid\Grid;
use Ccbox\ViewBuilder\UiLibs\Layui\Grid;
use Ccbox\ViewBuilder\Layout\Layout;

$table = require_once './data_table.php';

$grid = new Grid();

$grid->title('表格头');

$grid->page(true);

// $api_url = str_replace('index.php', '',$_SERVER['REQUEST_URI']) . 'api.php';
$api_url = str_replace('index.php', '',$_SERVER['PHP_SELF']) . 'api.php';
$api = $api_url . '?type=table';
$grid->url($api);

$grid->filter(['text'=>'关键词', 'type'=>'text', 'name'=>'keyword', 'style'=>'width:200px', 'placeholder'=>'请输入关键词']);
$grid->filter(['text'=>'类型', 'type'=>'select', 'name'=>'ftype', 'option'=>['normal'=>'正常', 'hot'=>'热门']]);
$grid->filter(['text'=>'状态', 'type'=>'select', 'name'=>'status', 'option'=>['normal'=>'激活的', 'hot'=>'热门'], 'value'=>'hot']);

$grid->toolbar('#'.$grid->elem().'-toolbar');

$grid->col()->type('checkbox')->fixed('left');
$grid->col('id', 'ID')->width(80)->sort()->fixed('left');
$grid->col('username', '用户名');
$grid->col('sex', '性别');
$grid->col('city', '城市');
$grid->col('sign', '签名');
$grid->col('experience', '积分');
$grid->col('score', '评分');
$grid->col('classify', '职业');
$grid->col('wealth', '财富');

$url_edit = $api_url . '?act=edit&id=###';

$grid->rowAction(['text'=>'跳转', 'url'=>$url_edit, 'type'=>'jump']);
$grid->rowAction(['text'=>'新开', 'url'=>$url_edit, 'type'=>'blank']);
$grid->rowAction(['text'=>'AJAX无提示', 'url'=>$url_edit, 'type'=>'get']);
$grid->rowAction(['text'=>'AJAX带提示', 'url'=>$url_edit, 'type'=>'get', 'msg'=>'直接请求']);
$grid->rowAction(['text'=>'删除', 'url'=>$url_edit, 'type'=>'get', 'event'=>'delete', 'msg'=>'确定删除此信息？', 'class'=>'layui-btn-danger']);
$grid->rowAction(['text'=>'确认框', 'url'=>$url_edit, 'type'=>'get', 'event'=>'confirm', 'icon'=>'home', 'msg'=>'带有取消按钮的弹窗（无del操作）']);
$grid->rowAction(['text'=>'消息弹窗', 'url'=>$url_edit, 'event'=>'msg', 'msg'=>'只有一个确认按钮的弹窗']);
$grid->rowAction(['text'=>'提示', 'event'=>'tips', 'msg'=>'按钮都没有的提示']);

// $grid->data($table['data']);

$grid_html = $grid->view();

$content = new Layout();

$html = $content
        ->title('页面标题')
        ->description('页面介绍文字内容')
        ->body($grid_html)
        ->view();

echo $html;