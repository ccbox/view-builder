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

trait Depends
{
    protected static $dependJs = [];
    protected static $dependCss = [];

    public function dependInit($config = null)
    {
        if(isset($config['js'])){
            $this->setDepend('js',is_array($config['js']) ? $config['js'] : [$config['js']]);
        }
        if(isset($config['css'])){
            $this->setDepend('css', is_array($config['css']) ? $config['css'] : [$config['css']]);
        }
    }

    public function setDepend(string $type, array $data)
    {
        if($type=='js'){
            self::$dependJs = $data;
        }
        if($type=='css'){
            self::$dependCss = $data;
        }
    }

    public function js($type='arr')
    {
        $res = self::$dependJs;
        return $type=='arr' ? $res : implode('',$res);
    }

    public function css($type='arr')
    {
        $res = self::$dependCss;
        return $type=='arr' ? $res : implode('',$res);
    }
}
