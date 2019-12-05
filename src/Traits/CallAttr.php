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

namespace Ccbox\ViewBuilder\Traits;

trait CallAttr
{
    public function __call($method,$params)
    {
        if(in_array($method, $this->attributes)){
            $data = isset($params[0]) ? $params[0] : $params ;
            return $this->confAttribute($method, $data);
        }
        // throw new Exception("The method cannot be found", 1);
    }
}
