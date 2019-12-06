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

use Ccbox\ViewBuilder\Grid\Grid;
use Ccbox\ViewBuilder\Traits\CallAttr;

class Col
{
    use CallAttr;

    protected $attributes = [];

    protected $field;
    protected $title;

    protected $grid;

    public function __construct($field = '', $title = '')
    {
        $this->field = $field;
        $this->title = $this->formatTitle($title);
    }
    
    // 与grid不同的是，这里的函数返回的是可供链式操作的对象
    protected function confAttribute($name = null, $value = null)
    {
        $name_arr = $this->attributes;
        if (in_array($name, $name_arr)) {
            if ($value !== null) {
                $this->$name = $value;
            }
            return $this;
        }
        return null;
    }

    public function getAttr($name)
    {
        if (in_array($name, $this->attributes)) {
            return $this->$name; 
        }
    }

    protected function formatTitle($title)
    {
        if ($title) {
            return $title;
        }

        if($this->field){
            $title = ucfirst($this->field);
            return __(str_replace(['.', '_'], ' ', $title));
        }
    }

    // public function setGrid(Grid $grid)
    // {
    //     $this->grid = $grid;
    // }

    
    public function getColConfig()
    {  }

}
