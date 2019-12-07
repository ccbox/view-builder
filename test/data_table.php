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

$table = [];

$table['header'] = [
    ['field' => 'id', 'title' => 'ID', 'width' => 80, 'sort' => true, 'fixed' => 'left'], 
    ['field' => 'username', 'title' => '用户名', 'width' => 80], 
    ['field' => 'sex', 'title' => '性别', 'width' => 80, 'sort' => true], 
    ['field' => 'city', 'title' => '城市', 'width' => 80], 
    ['field' => 'sign', 'title' => '签名', 'width' => 177], 
    ['field' => 'experience', 'title' => '积分', 'width' => 80, 'sort' => true], 
    ['field' => 'score', 'title' => '评分', 'width' => 80, 'sort' => true], 
    ['field' => 'classify', 'title' => '职业', 'width' => 80], 
    ['field' => 'wealth', 'title' => '财富', 'width' => 135, 'sort' => true]
];

$table['data'] = [
    ["id" => 10000, "username" => "user-0", "sex" => "女", "city" => "城市-0", "sign" => "签名-0", "experience" => 255, "logins" => 24, "wealth" => 82830700, "classify" => "作家", "score" => 57],
    ["id" => 10001, "username" => "user-1", "sex" => "男", "city" => "城市-1", "sign" => "签名-1", "experience" => 884, "logins" => 58, "wealth" => 64928690, "classify" => "词人", "score" => 27],
    ["id" => 10002, "username" => "user-2", "sex" => "女", "city" => "城市-2", "sign" => "签名-2", "experience" => 650, "logins" => 77, "wealth" => 6298078, "classify" => "酱油", "score" => 31],
    ["id" => 10003, "username" => "user-3", "sex" => "女", "city" => "城市-3", "sign" => "签名-3", "experience" => 362, "logins" => 157, "wealth" => 37117017, "classify" => "诗人", "score" => 68],
    ["id" => 10004, "username" => "user-4", "sex" => "男", "city" => "城市-4", "sign" => "签名-4", "experience" => 807, "logins" => 51, "wealth" => 76263262, "classify" => "作家", "score" => 6],
    ["id" => 10005, "username" => "user-5", "sex" => "女", "city" => "城市-5", "sign" => "签名-5", "experience" => 173, "logins" => 68, "wealth" => 60344147, "classify" => "作家", "score" => 87],
    ["id" => 10006, "username" => "user-6", "sex" => "女", "city" => "城市-6", "sign" => "签名-6", "experience" => 982, "logins" => 37, "wealth" => 57768166, "classify" => "作家", "score" => 34],
    ["id" => 10007, "username" => "user-7", "sex" => "男", "city" => "城市-7", "sign" => "签名-7", "experience" => 727, "logins" => 150, "wealth" => 82030578, "classify" => "作家", "score" => 28],
    ["id" => 10008, "username" => "user-8", "sex" => "男", "city" => "城市-8", "sign" => "签名-8", "experience" => 951, "logins" => 133, "wealth" => 16503371, "classify" => "词人", "score" => 14],
    ["id" => 10009, "username" => "user-9", "sex" => "女", "city" => "城市-9", "sign" => "签名-9", "experience" => 484, "logins" => 25, "wealth" => 86801934, "classify" => "词人", "score" => 75],
    ["id" => 10010, "username" => "user-10", "sex" => "女", "city" => "城市-10", "sign" => "签名-10", "experience" => 1016, "logins" => 182, "wealth" => 71294671, "classify" => "诗人", "score" => 34],
    ["id" => 10011, "username" => "user-11", "sex" => "女", "city" => "城市-11", "sign" => "签名-11", "experience" => 492, "logins" => 107, "wealth" => 8062783, "classify" => "诗人", "score" => 6],
    ["id" => 10012, "username" => "user-12", "sex" => "女", "city" => "城市-12", "sign" => "签名-12", "experience" => 106, "logins" => 176, "wealth" => 42622704, "classify" => "词人", "score" => 54],
    ["id" => 10013, "username" => "user-13", "sex" => "男", "city" => "城市-13", "sign" => "签名-13", "experience" => 1047, "logins" => 94, "wealth" => 59508583, "classify" => "诗人", "score" => 63],
    ["id" => 10014, "username" => "user-14", "sex" => "男", "city" => "城市-14", "sign" => "签名-14", "experience" => 873, "logins" => 116, "wealth" => 72549912, "classify" => "词人", "score" => 8],
    ["id" => 10015, "username" => "user-15", "sex" => "女", "city" => "城市-15", "sign" => "签名-15", "experience" => 1068, "logins" => 27, "wealth" => 52737025, "classify" => "作家", "score" => 28],
    ["id" => 10016, "username" => "user-16", "sex" => "女", "city" => "城市-16", "sign" => "签名-16", "experience" => 862, "logins" => 168, "wealth" => 37069775, "classify" => "酱油", "score" => 86],
    ["id" => 10017, "username" => "user-17", "sex" => "女", "city" => "城市-17", "sign" => "签名-17", "experience" => 1060, "logins" => 187, "wealth" => 66099525, "classify" => "作家", "score" => 69],
    ["id" => 10018, "username" => "user-18", "sex" => "女", "city" => "城市-18", "sign" => "签名-18", "experience" => 866, "logins" => 88, "wealth" => 81722326, "classify" => "词人", "score" => 74],
    ["id" => 10019, "username" => "user-19", "sex" => "女", "city" => "城市-19", "sign" => "签名-19", "experience" => 682, "logins" => 106, "wealth" => 68647362, "classify" => "词人", "score" => 51],
    ["id" => 10020, "username" => "user-20", "sex" => "男", "city" => "城市-20", "sign" => "签名-20", "experience" => 770, "logins" => 24, "wealth" => 92420248, "classify" => "诗人", "score" => 87],
    ["id" => 10021, "username" => "user-21", "sex" => "男", "city" => "城市-21", "sign" => "签名-21", "experience" => 184, "logins" => 131, "wealth" => 71566045, "classify" => "词人", "score" => 99],
    ["id" => 10022, "username" => "user-22", "sex" => "男", "city" => "城市-22", "sign" => "签名-22", "experience" => 739, "logins" => 152, "wealth" => 60907929, "classify" => "作家", "score" => 18],
    ["id" => 10023, "username" => "user-23", "sex" => "女", "city" => "城市-23", "sign" => "签名-23", "experience" => 127, "logins" => 82, "wealth" => 14765943, "classify" => "作家", "score" => 30],
    ["id" => 10024, "username" => "user-24", "sex" => "女", "city" => "城市-24", "sign" => "签名-24", "experience" => 212, "logins" => 133, "wealth" => 59011052, "classify" => "词人", "score" => 76],
    ["id" => 10025, "username" => "user-25", "sex" => "女", "city" => "城市-25", "sign" => "签名-25", "experience" => 938, "logins" => 182, "wealth" => 91183097, "classify" => "作家", "score" => 69],
    ["id" => 10026, "username" => "user-26", "sex" => "男", "city" => "城市-26", "sign" => "签名-26", "experience" => 978, "logins" => 7, "wealth" => 48008413, "classify" => "作家", "score" => 65],
    ["id" => 10027, "username" => "user-27", "sex" => "女", "city" => "城市-27", "sign" => "签名-27", "experience" => 371, "logins" => 44, "wealth" => 64419691, "classify" => "诗人", "score" => 60],
    ["id" => 10028, "username" => "user-28", "sex" => "女", "city" => "城市-28", "sign" => "签名-28", "experience" => 977, "logins" => 21, "wealth" => 75935022, "classify" => "作家", "score" => 37],
    ["id" => 10029, "username" => "user-29", "sex" => "男", "city" => "城市-29", "sign" => "签名-29", "experience" => 647, "logins" => 107, "wealth" => 97450636, "classify" => "酱油", "score" => 27]
];

$table['data2'] = [
        [10000, "user-0", "女", "城市-0", "签名-0", 255, 24, 82830700, "作家", 57],
        [10001, "user-1", "男", "城市-1", "签名-1", 884, 58, 64928690, "词人", 27],
        [10002, "user-2", "女", "城市-2", "签名-2", 650, 77, 6298078, "酱油", 31],
        [10003, "user-3", "女", "城市-3", "签名-3", 362, 157, 37117017, "诗人", 68],
        [10004, "user-4", "男", "城市-4", "签名-4", 807, 51, 76263262, "作家", 6],
        [10005, "user-5", "女", "城市-5", "签名-5", 173, 68, 60344147, "作家", 87],
        [10006, "user-6", "女", "城市-6", "签名-6", 982, 37, 57768166, "作家", 34],
        [10007, "user-7", "男", "城市-7", "签名-7", 727, 150, 82030578, "作家", 28],
        [10008, "user-8", "男", "城市-8", "签名-8", 951, 133, 16503371, "词人", 14],
        [10009, "user-9", "女", "城市-9", "签名-9", 484, 25, 86801934, "词人", 75],
        [10010, "user-10", "女", "城市-10", "签名-10", 1016, 182, 71294671, "诗人", 34],
        [10011, "user-11", "女", "城市-11", "签名-11", 492, 107, 8062783, "诗人", 6],
        [10012, "user-12", "女", "城市-12", "签名-12", 106, 176, 42622704, "词人", 54],
        [10013, "user-13", "男", "城市-13", "签名-13", 1047, 94, 59508583, "诗人", 63],
        [10014, "user-14", "男", "城市-14", "签名-14", 873, 116, 72549912, "词人", 8],
        [10015, "user-15", "女", "城市-15", "签名-15", 1068, 27, 52737025, "作家", 28],
        [10016, "user-16", "女", "城市-16", "签名-16", 862, 168, 37069775, "酱油", 86],
        [10017, "user-17", "女", "城市-17", "签名-17", 1060, 187, 66099525, "作家", 69],
        [10018, "user-18", "女", "城市-18", "签名-18", 866, 88, 81722326, "词人", 74],
        [10019, "user-19", "女", "城市-19", "签名-19", 682, 106, 68647362, "词人", 51],
        [10020, "user-20", "男", "城市-20", "签名-20", 770, 24, 92420248, "诗人", 87],
        [10021, "user-21", "男", "城市-21", "签名-21", 184, 131, 71566045, "词人", 99],
        [10022, "user-22", "男", "城市-22", "签名-22", 739, 152, 60907929, "作家", 18],
        [10023, "user-23", "女", "城市-23", "签名-23", 127, 82, 14765943, "作家", 30],
        [10024, "user-24", "女", "城市-24", "签名-24", 212, 133, 59011052, "词人", 76],
        [10025, "user-25", "女", "城市-25", "签名-25", 938, 182, 91183097, "作家", 69],
        [10026, "user-26", "男", "城市-26", "签名-26", 978, 7, 48008413, "作家", 65],
        [10027, "user-27", "女", "城市-27", "签名-27", 371, 44, 64419691, "诗人", 60],
        [10028, "user-28", "女", "城市-28", "签名-28", 977, 21, 75935022, "作家", 37],
        [10029, "user-29", "男", "城市-29", "签名-29", 647, 107, 97450636, "酱油", 27]
];

$table['respon'] = [
    "code" => 0,
    "msg" => "",
    "count" => count($table['data']),
    "data" => $table['data']
];

return $table;
