<?php

namespace app\services;

class RenderServices implements RenderI
{
    public function render($template, $params = [])
    {
        $content = $this->renderTmpl($template, $params);

        $title = 'Мой магазин';
        if (!empty($params['title'])) {
            $title = $params['title'];
        }

        return $this->renderTmpl(
            'layouts/main',
            [
                'content' => $content,
                'title' => $title,
            ]
        );
    }

    public function renderTmpl($template, $params = [])
    {
        extract($params);
        ob_start();
        include dirname(__DIR__) . '/views/' . $template . '.php';
        return ob_get_clean();
    }
}