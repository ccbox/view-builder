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

namespace Ccbox\ViewBuilder\UiLibs\Layui;

use Ccbox\ViewBuilder\Grid\Col as ColBase;
use Ccbox\ViewBuilder\UiLibs\Layui\Grid;
use Closure;
/*

cols - 表头参数一览表
相信我，在你还尚无法驾驭 layui table 的时候，你的所有焦点都应放在这里，它带引领你完成许多可见和不可见甚至你无法想象的工作。
如果你采用的是方法渲染，cols 是一个二维数组，表头参数设定在数组内；如果你采用的自动渲染，表头参数的设定应放在 <th> 标签上

参数                 类型                 说明            示例值
field               String              设定字段名。字段名的设定非常重要，且是表格数据列的唯一标识            username
title               String              设定标题名称            用户名
width               Number/String       设定列宽，若不填写，则自动分配；若填写，则支持值为：数字、百分比，请结合实际情况，对不同列做不同设定。            200/30%
minWidth            Number              局部定义当前常规单元格的最小宽度（默认：60），一般用于列宽自动分配的情况。其优先级高于基础参数中的 cellMinWidth            100
type                String              设定列类型。可选值有：
                                            normal（常规列，无需设定）
                                            checkbox（复选框列）
                                            radio（单选框列，layui 2.4.0 新增）
                                            numbers（序号列）
                                            space（空列）
                                            任意一个可选值
LAY_CHECKED         Boolean             是否全选状态（默认：false）。必须复选框列开启后才有效，如果设置 true，则表示复选框默认全部选中。            true
fixed               String              固定列。可选值有：left（固定在左）、right（固定在右）。一旦设定，对应的列将会被固定在左或右，不随滚动条而滚动。
                                            注意：如果是固定在左，该列必须放在表头最前面；如果是固定在右，该列必须放在表头最后面。            left（同 true）/right
hide                Boolean             是否初始隐藏列，默认：false。layui 2.4.0 新增            true
totalRow            Boolean             是否开启该列的自动合计功能，默认：false。layui 2.4.0 新增            true
totalRowText        String              用于显示自定义的合计文本。layui 2.4.0 新增            "合计："
sort                Boolean             是否允许排序（默认：false）。如果设置 true，则在对应的表头显示排序icon，从而对列开启排序功能。
                                            注意：不推荐对值同时存在“数字和普通字符”的列开启排序，因为会进入字典序比对。比如：'贤心' > '2' > '100'，这可能并不是你想要的结果，但字典序排列算法（ASCII码比对）就是如此。     true
unresize            Boolean             是否禁用拖拽列宽（默认：false）。默认情况下会根据列类型（type）来决定是否禁用，如复选框列，会自动禁用。而其它普通列，默认允许拖拽列宽，当然你也可以设置 true 来禁用该功能。            false
edit                String              单元格编辑类型（默认不开启）目前只支持：text（输入框）            text
event               String              自定义单元格点击事件名，以便在 tool 事件中完成对该单元格的业务处理            任意字符
style               String              自定义单元格样式。即传入 CSS 样式            background-color: #5FB878; color: #fff;
align               String              单元格排列方式。可选值有：left（默认）、center（居中）、right（居右）            center
colspan             Number              单元格所占列数（默认：1）。一般用于多级表头            3
rowspan             Number              单元格所占行数（默认：1）。一般用于多级表头            2
templet             String              自定义列模板，模板遵循 laytpl 语法。这是一个非常实用的功能，你可借助它实现逻辑处理，以及将原始数据转化成其它格式，如时间戳转化为日期字符等            详见自定义模板
toolbar             String              绑定工具条模板。可在每行对应的列中出现一些自定义的操作性按钮            详见行工具事件

*/

class Col extends ColBase
{
    
    protected $field;
    protected $title;
    protected $width;
    protected $minWidth;

    protected $type;
    protected $LAY_CHECKED;
    protected $fixed;
    protected $hide;

    protected $totalRow;
    protected $totalRowText;
    protected $sort;

    protected $unresize;
    protected $edit;
    protected $event;
    protected $style;
    protected $align;
    protected $colspan;
    protected $rowspan;
    protected $templet;
    protected $toolbar;

    protected $attributes = [
        'field',
        'title',
        'width',
        'minWidth',

        'type',
        'LAY_CHECKED',
        'fixed',
        'hide',

        'totalRow',
        'totalRowText',
        'sort',

        'unresize',
        'edit',
        'event',
        'style',
        'align',
        'colspan',
        'rowspan',
        'templet',
        'toolbar',
    ];


    public function __construct($field = '', $title = '')
    {
        $this->field = $field;
        $this->title = $this->formatTitle($title);
    }

    protected function formatTitle($title)
    {
        return $title;
    }

    public function toolbar(Closure $callback)
    {
    //     if($data != 'normal'){
    //         $this->field = null;
    //         $this->title = null;
    //     }
    //     $this->type = $data;

    //     return $this;
    }

    public function getColConfig()
    {
        $fieldConfig = [
            'field'         => $this->field,
            'title'         => $this->title,
            'width'         => $this->width,
            'minWidth'      => $this->minWidth,

            'type'          => $this->type,
            'LAY_CHECKED'   => $this->LAY_CHECKED,
            'fixed'         => $this->fixed,
            'hide'          => $this->hide,

            'totalRow'      => $this->totalRow,
            'totalRowText'  => $this->totalRowText,
            'sort'          => $this->sort,

            'unresize'      => $this->unresize,
            'edit'          => $this->edit,
            'event'         => $this->event,
            'style'         => $this->style,
            'align'         => $this->align,
            'colspan'       => $this->colspan,
            'rowspan'       => $this->rowspan,
            'templet'       => $this->templet,
            'toolbar'       => $this->toolbar,
        ];
        return array_filter($fieldConfig);
    }

}
