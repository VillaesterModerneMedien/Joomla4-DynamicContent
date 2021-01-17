<?php

class TemplateListener
{
    public static function matchTemplate($view, $tpl)
    {
        $layout = $view->getLayout();
        $context = $view->get('context');

        // match context and layout from view object
        if ($context === 'com_contact.contact' && $layout === 'default' && !$tpl) {

            // return type, query and parameters of the matching view
            return [
                'type' => $context,
                'params' => ['item' => $view->get('item')],
            ];
        }
    }
}
