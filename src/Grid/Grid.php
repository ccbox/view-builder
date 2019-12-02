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

class Grid implements ViewInterface
{
    use CallAttr;
    
    protected $_model;
    protected $attributes;
    
    protected $data;
    protected $cols = [];
    protected $rows = [];

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

    public function row()
    { }

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

    public function view($template = null)
    {
        if (!$template) {
            $template = $this->template;
        }
        // $this->renderData = $this;
        return $this->render($template);
    }
}
