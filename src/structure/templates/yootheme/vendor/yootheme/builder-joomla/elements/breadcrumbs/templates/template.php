<?php

namespace YOOtheme;

use Joomla\CMS\Language\Text;
use Joomla\Registry\Registry;

$rand = rand();
$marker = "<!-- breadcrumbs_{$rand} -->";

$render = function () use ($__dir, $attrs, $props) {

    jimport('modules.mod_breadcrumbs.helper', JPATH_ROOT);

    // Get the breadcrumbs
    $params = new Registry([
        'showHome' => $props['show_home'],
        'homeText' => Text::_($props['home_text'] ?: 'Home', 'yootheme'),
    ]);

    $items = \ModBreadCrumbsHelper::getList($params);

    if (!$props['show_current']) {
        array_pop($items);
    } elseif ($items) {
        $items[count($items) - 1]->link = '';
    }

    $props['items'] = $items;

    return $this->render("{$__dir}/template-breadcrumbs", compact('attrs', 'props'));
};

if ($prefix === 'page') {

    echo $marker;
    $view->addLoader(function($name, $parameters, callable $next)  use ($render, $marker) {
        return str_replace($marker, $render(), $next($name, $parameters));
    }, '~theme/templates/article*'); // Filter has to be the same as the one ViewLoader is registered on

} else {

    echo $render();

}
