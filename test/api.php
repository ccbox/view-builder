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

@$type  = $_GET['type'];
@$page  = $_GET['page'] ?? 1;
@$limit = $_GET['limit'] ?? 10;

$type_arr = [
    'table',
];

if(in_array($type, $type_arr)){

    $file = './data_'.$type.'.php';

    $data = require_once $file;

    $respon = $data['respon'];

    // 分页处理：不写分页处理了

    echo json_encode($respon, JSON_UNESCAPED_UNICODE);

}else{

    echo 'Ooops...';

}