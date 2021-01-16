<?php

namespace YOOtheme\Joomla;

use Joomla\CMS\Router\Route;
use YOOtheme\Url;

class Router
{
    public static function generate($pattern = '', array $parameters = [], $secure = null)
    {
        return Url::to(Route::_('index.php', false), ['p' => $pattern] + $parameters, $secure);
    }
}
