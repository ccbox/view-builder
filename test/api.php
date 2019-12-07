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

@$type  = $_GET['type'];
@$page  = $_GET['page'] ?? 1;
@$limit = $_GET['limit'] ?? 10;

$type_arr = [
    'table',
];

$respon = [
    "code" => 0,
    "msg" => "",
    "data" => ""
];

if(in_array($type, $type_arr)){

    $file = './data_'.$type.'.php';

    $data = require_once $file;

    $respon = $data['respon'];

    // 分页处理：
    // $r_a = ($page-1) * $limit;
    $r_b = $page * $limit;
    $r_a = $r_b - $limit;
    $r_b = $respon['count'] < $r_b ? $respon['count'] : $r_b;
    if($respon['count']>$r_a){
        $list = [];
        if($r_b > $r_a){
            for($i = $r_a; $i<$r_b; $i++){
                $list[] = $respon['data'][$i];
            }
        }else{
            $list[] = $respon['data'][$r_a];
        }
        $respon['data'] = $list;
    }

    echo json_encode($respon, JSON_UNESCAPED_UNICODE);

}else{

    $respon['code'] = 404;
    $respon['msg'] = 'Ooops...';
    echo json_encode($respon, JSON_UNESCAPED_UNICODE);

}