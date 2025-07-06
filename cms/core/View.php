<?php
namespace Core;

class View
{
    public static function render($view, $data = [])
    {
        extract($data);
        $viewPath = __DIR__ . '/../templates/' . $view . '.php';
        include __DIR__ . '/../templates/base.php';
    }
}