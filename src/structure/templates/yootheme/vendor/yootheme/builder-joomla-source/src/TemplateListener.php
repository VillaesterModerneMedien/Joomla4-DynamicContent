<?php

namespace YOOtheme\Builder\Joomla\Source;

use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri;
use YOOtheme\Builder;
use YOOtheme\Builder\Templates\TemplateHelper;
use YOOtheme\Config;
use YOOtheme\Event;

class TemplateListener
{
    public static function loadTemplate(TemplateHelper $helper, Builder $builder, Config $config, $event)
    {
        list($view, $tpl) = $event->getArguments();

        $template = Event::emit('builder.template', $view, $tpl);

        if (empty($template['type'])) {
            return;
        }

        if ($config('app.isCustomizer')) {
            $config->set('customizer.view', $template['type']);
        }

        if ($config('app.isBuilder')) {
            return;
        }

        if ($matched = $helper->match($template)) {

            $template += $matched + ['layout' => [], 'params' => []];

            // set template identifier
            if ($config('app.isCustomizer')) {
                $config->set('customizer.template', $template['id']);
            }

            // get template from request?
            if ($templ = $config('req.customizer.template') and $templ['id'] == $template['id']) {
                $template['layout'] = $templ['layout'];
            }

            // get output from builder
            $output = $builder->render(json_encode($template['layout']), $template['params'] + [
                'prefix' => "template-{$template['id']}",
            ]);

            // append frontend edit button?
            if ($output && isset($template['editUrl']) && !$config('app.isCustomizer')) {
                $output .= "<a style=\"position: fixed!important\" class=\"uk-position-medium uk-position-bottom-right uk-button uk-button-primary\" href=\"{$template['editUrl']}\">" . Text::_('JACTION_EDIT') . '</a>';
            }

            if ($output) {
                $view->set('_output', $output);
                $config->set('app.isBuilder', true);
            }
        }
    }

    public static function matchTemplate(Config $config, $view, $tpl)
    {
        $layout = $view->getLayout();
        $context = $view->get('context');

        if ($tpl) {
            return;
        }

        if ($context === 'com_content.article' && $layout === 'default') {

            $item = $view->get('item');

            return [
                'type' => $context,
                'query' => ['catid' => $item->catid, 'tag' => array_column($item->tags->itemTags, 'id')],
                'params' => ['item' => $item],
                'editUrl' => $item->params->get('access-edit') ? Route::_(\ContentHelperRoute::getFormRoute($item->id) . '&return=' . base64_encode(Uri::getInstance())) : null,
            ];
        }

        if ($context === 'com_content.category' && $layout === 'blog') {

            $category = $view->get('category');
            $pagination = $view->get('pagination');

            return [
                'type' => $context,
                'query' => [
                    'catid' => $category->id,
                    'tag' => array_column($category->tags->itemTags, 'id'),
                    'pages' => $pagination->pagesCurrent === 1 ? 'first' : 'except_first',
                ],
                'params' => ['category' => $category, 'items' => array_merge($view->get('lead_items'), $view->get('intro_items')), 'pagination' => $pagination],
            ];
        }

        if ($context === 'com_content.featured') {

            $pagination = $view->get('pagination');

            return [
                'type' => $context,
                'query' => ['pages' => $pagination->pagesCurrent === 1 ? 'first' : 'except_first'],
                'params' => ['items' => $view->get('items'), 'pagination' => $pagination],
            ];
        }
    }
}
