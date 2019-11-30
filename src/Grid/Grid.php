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

namespace Ccbox\ViewBuilder\Grid;

use Ccbox\ViewBuilder\Contract\ViewInterface;
use Ccbox\ViewBuilder\Grid\Col;
use Ccbox\ViewBuilder\Traits\Render;

/*
https://www.layui.com/doc/modules/table.html
下面是目前 table 模块所支持的全部参数一览表，我们对重点参数进行了的详细说明，你可以点击下述表格最右侧的“示例”去查看

参数                类型                 说明                                                          示例值
elem                String/DOM          指定原始 table 容器的选择器或 DOM，方法渲染方式必填                 "#demo"
cols                Array               设置表头。值是一个二维数组。方法渲染方式必填                         详见表头参数
url                 -                   异步数据接口相关参数。其中 url 参数为必填项                         详见异步接口
toolbar             String/DOM/Boolean  开启表格头部工具栏区域，该参数支持四种类型值：                       false
                                            toolbar: '#toolbarDemo' //指向自定义工具栏模板选择器
                                            toolbar: '<div>xxx</div>' //直接传入工具栏模板字符
                                            toolbar: true //仅开启工具栏，不显示左侧模板
                                            toolbar: 'default' //让工具栏左侧显示默认的内置模板
                                            注意：
                                            1. 该参数为 layui 2.4.0 开始新增。
                                            2. 若需要“列显示隐藏”、“导出”、“打印”等功能，则必须开启该参数
defaultToolbar      Array               该参数可自由配置头部工具栏右侧的图标按钮            详见头工具栏图标
width               Number              设定容器宽度。table容器的默认宽度是跟随它的父元素铺满，你也可以设定一个固定值，当容器中的内容超出了该宽度时，会自动出现横向滚动条。            1000
height              Number/String       设定容器高度            详见height
cellMinWidth        Number              （layui 2.2.1 新增）全局定义所有常规单元格的最小宽度（默认：60），一般用于列宽自动分配的情况。其优先级低于表头参数中的 minWidth            100
done                Function            数据渲染完的回调。你可以借此做一些其它的操作                                        详见done回调
data                Array               直接赋值数据。既适用于只展示一页数据，也非常适用于对一段已知数据进行多页展示。            [{}, {}, {}, {}, …]
totalRow            Boolean             是否开启合计行区域。layui 2.4.0 新增            false
page                Boolean/Object      开启分页（默认：false） 注：从 layui 2.2.0 开始，支持传入一个对象，里面可包含 laypage 组件所有支持的参数（jump、elem除外）            {theme: '#c00'}
limit               Number              每页显示的条数（默认：10）。值务必对应 limits 参数的选项。
                                            注意：优先级低于 page 参数中的 limit 参数            30
limits              Array               每页条数的选择项，默认：[10,20,30,40,50,60,70,80,90]。
                                            注意：优先级低于 page 参数中的 limits 参数            [30,60,90]
loading             Boolean             是否显示加载条（默认：true）。如果设置 false，则在切换分页时，不会出现加载条。该参数只适用于 url 参数开启的方式            false
title               String              定义 table 的大标题（在文件导出等地方会用到）layui 2.4.0 新增            "用户表"
text                Object              自定义文本，如空数据时的异常提示等。注：layui 2.2.5 开始新增。            详见自定义文本
autoSort            Boolean             默认 true，即直接由 table 组件在前端自动处理排序。若为 false，则需自主排序，通常由服务端直接返回排序好的数据。
                                            注意：该参数为 layui 2.4.4 新增            详见监听排序
initSort            Object              初始排序状态。用于在数据表格渲染完毕时，默认按某个字段排序。            详见初始排序
id                  String              设定容器唯一 id。id 是对表格的数据操作方法上是必要的传递条件，它是表格容器的索引，你在下文诸多地方都将会见识它的存在。
                                            值得注意的是：从 layui 2.2.0 开始，该参数也可以自动从 <table id="test"></table> 中的 id 参数中获取。            test
skin（等）           -                  设定表格各种外观、尺寸等            详见表格风格

*/

class Grid implements ViewInterface
{

    public $title;
    public $text;

    protected $model;
    protected $data;

    protected $elem;
    protected $cols = [];
    protected $rows = [];


    protected $toolbar;

    protected $url;
    protected $width;
    protected $height;
    protected $cellMinWidth;

    use Render;
    // php trait 变量类型为数组时 不能被父类子类同时use
    // 模板：从view目录开始，结尾不用带文件后缀
    protected $template = 'grid.grid';

    public function __construct($data = null, $elem = null, $title = null)
    {
        $this->setSomeThing('data', $data);
        $this->setSomeThing('title', $title);
        $this->setElem($elem);
    }

    public function setElem($elem = null)
    {
        if (!empty(trim($elem)) && is_string(trim($elem))) {
            $this->elem = $elem;
        } else {
            $this->elem = 'grid' . time();
        }
    }

    public function getElem()
    {
        return $this->elem;
    }

    protected function setSomeThing($name = null, $value = null)
    {
        $name_arr = ['data', 'title', 'text'];
        if (in_array($name, $name_arr)) {
            if ($value !== null) {
                $this->$name = $value;
            }
            return $this->$name;
        }
        return null;
    }

    public function data($data = null)
    {
        return $this->setSomeThing('data', $data);
    }

    public function title($data = null)
    {
        return $this->setSomeThing('title', $data);
    }

    public function text($data = null)
    {
        return $this->setSomeThing('text', $data);
    }

    public function col($name, $label)
    {
        $title = array_filter([$label]);
        return $this->addCol($name, $title[0] ?? null);
    }

    public function addCol($name = '', $label = '')
    {
        $column = new Col($name, $label);
        // $column->setGrid($this);

        $this->cols[] = $column;
        return $column;
    }

    public function cols()
    {
        if ($this->cols) {
            $cols = array_map(function ($col) {
                return $col->getColConfig();
            }, $this->cols);
            return $cols;
        }
    }

    public function opCols()
    {
        return json_encode($this->cols(), JSON_UNESCAPED_UNICODE);
    }

    public function opData()
    {
        return json_encode($this->data, JSON_UNESCAPED_UNICODE);
    }

    public function row()
    { }


    public function view($template = null)
    {
        if (!$template) {
            $template = $this->template;
        }
        // $this->renderData = $this;
        return $this->render($template);
    }
}
