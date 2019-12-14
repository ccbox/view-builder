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
use Ccbox\ViewBuilder\Traits\CallAttr;
use Ccbox\ViewBuilder\Traits\Render;

// 后期可以将父类改为工厂类更方便
class Grid implements ViewInterface
{
    use CallAttr;
    
    protected $_model;
    protected $attributes;
    
    protected $data;
    protected $pkey = 'id';
    protected $filterFields = [];
    protected $cols = [];
    protected $rows = [];
    protected $rowActions = [];

    use Render;
    // php trait 变量类型为数组时 不能被父类子类同时use
    // 模板：从view目录开始，结尾不用带文件后缀
    protected $template = 'grid.grid';

    public function __construct($data = null)
    {
        $this->data($data);
    }

    protected function confAttribute($name = null, $value = null)
    {
        $name_arr = $this->attributes;
        if (in_array($name, $name_arr)) {
            if ($value !== null) {
                $this->$name = $value;
            }
            return $this->$name;
        }
        return null;
    }

    public function getAttr($name)
    {
        if (in_array($name, $this->attributes)) {
            return $this->$name; 
        }
    }

    public function data($data = null)
    {
        if ($data !== null) {
            $this->data = $data;
        }
        return $this->data;
    }

    // 表单控件的简单实现
    public function filter(array $conf)
    {
        $this->filterFields[$conf['name']] = [
            'text'          => $conf['text'],
            'text_style'    => $conf['text_style'] ?? 'width:auto',
            'type'          => $conf['type'] ?? 'text',
            'name'          => $conf['name'],
            'verify'        => $conf['verify'] ?? null,
            'placeholder'   => $conf['placeholder'] ?? null,
            'value'         => $conf['value'] ?? null,
            'autocomplete'  => $conf['autocomplete'] ?? 'off',
            'option'        => $conf['option'] ?? null,
            'class'         => $conf['class'] ?? null,
            'style'         => $conf['style'] ?? null,
        ];
        return $this;
    }
    
    public function hasFilter()
    {
        return !empty($this->filterFields);
    }

    public function row()
    { }

    /**
     * 添加每行的操作（操作列）
     *
     * @param array $conf
     *      @param string $text      文字
     *      @param string $url       链接
     *      @param string $type      链接类型： jump 直接跳转, blank 新窗口跳转, post/get Ajax请求
     *      @param string $event     前置事件： msg 弹出消息, confirm 需要确认, tips 提示, delete 删除(会弹出确认窗口)
     *      @param string $icon
     *      @param string $msg
     *      @param string $class
     *      @param string $style
     * @param array $more
     * @return void
     */
    public function rowAction(array $conf, array $more = null)
    {
        $this->rowActions[] = [
            'text'  => $conf['text']    ?? null,
            'url'   => $conf['url']     ?? null,
            'type'  => $conf['type']    ?? 'get',
            'event' => $conf['event']   ?? null,
            'icon'  => $conf['icon']    ?? null,
            'msg'   => $conf['msg']     ?? null,
            'class' => $conf['class']   ?? null,
            'style' => $conf['style']   ?? null,
            'more'  => $more,
        ];
        return $this;
    }

    public function hasRowAction()
    {
        return !empty($this->rowActions);
    }

    public function col($field = '', $label = '')
    {
        $title = array_filter([$label]);
        $column = $this->addCol($field, $title[0] ?? null);
        $this->cols[] = $column;
        return $column;
    }

    // 抽象方法：业务层实现
    public function addCol($field = '', $label = '')
    {
        $column = new Col($field, $label);
        // $column->setGrid($this);
        return $column;
    }

    // 抽象方法：业务层实现
    public function addColOfAction($label = '操作')
    {
        if($this->hasRowAction()){
            
        }
    }

    public function getCols()
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
        return json_encode($this->getCols(), JSON_UNESCAPED_UNICODE);
    }

    public function opData()
    {
        return json_encode($this->data, JSON_UNESCAPED_UNICODE);
    }

    public function view($template = null)
    {
        if (!$template) {
            $template = $this->template;
        }
        // $this->renderData = $this;
        return $this->render($template);
    }
    
    public function js($type='arr')
    {}

    public function css($type='arr')
    {}
}
