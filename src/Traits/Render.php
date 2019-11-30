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

trait Render
{
    // php trait 变量类型为数组时 不能被父类子类同时use

    protected $renderingCallbacks = [];

    protected $renderData = [];

    // 模板：从view目录开始，结尾不用带文件后缀
    protected $renderView;

    public function rendering(callable $callback)
    {
        $this->renderingCallbacks[] = $callback;
        return $this;
    }

    protected function callRenderingCallback()
    {
        foreach ($this->renderingCallbacks as $callback) {
            call_user_func($callback, $this);
        }
    }

    public function render($template = null)
    {
        $this->callRenderingCallback();

        if (!$template) {
            $template = $this->renderView;
        }
        $template = str_replace(['.'], DIRECTORY_SEPARATOR, $template) . '.php';

        if (!file_exists($template)) {
            $temp = [];
            $temp[] = dirname(__FILE__);
            $temp[] = '..';
            $temp[] = 'view';
            $temp[] = $template;
            $template = implode(DIRECTORY_SEPARATOR, $temp);
        }

        if (!file_exists($template)) {
            exit('Template missing.');
        }

        ob_start();
        $data = empty($this->renderData) ? $this : $this->renderData;
        require $template;
        $html = ob_get_clean();
        return $html;
    }
}
