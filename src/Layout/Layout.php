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


namespace Ccbox\ViewBuilder\Layout;

use Ccbox\ViewBuilder\Contract\ViewInterface;
use Ccbox\ViewBuilder\Traits\Render;

class Layout implements ViewInterface
{
    protected $title = ' ';
    protected $description = ' ';

    protected $html = '';
    protected $rows = [];

    use Render;
    protected $template = 'layout.layout';

    public function title($title)
    {
        $this->title = $title;
        return $this;
    }

    public function description($description = '')
    {
        $this->description = $description;
        return $this;
    }

    public function body($content)
    {
        $this->html = $content;
        return $this;
    }

    public function view($template = null)
    {
        if (!$template) {
            $template = $this->template;
        }

        $this->renderData = [
            'title' => $this->title,
            'description' => $this->description,
            'html' => $this->html,
        ];
        return $this->render($template);
    }
}
