<?php

use Joomla\CMS\Table\ContentType;
use YOOtheme\Builder\Source;
use YOOtheme\Config;
use YOOtheme\Metadata;
use YOOtheme\Url;

class SourceListener
{
    /**
     * @param Source $source
     */
    public static function initSource($source)
    {
        $source->objectType('ContactType', ContactType::config());
        $source->queryType(ContactQueryType::config());
    }

    public static function initCustomizer(Config $config, Metadata $metadata)
    {
        $config->add('customizer.contact', array(
            [
                'value' => 1,
                'text' => 'text',
            ],
        ));

        $config->add('customizer.templates', [

            'com_contact.contact' => [
                'label' => 'Contact'
            ],

        ]);

        $metadata->set('script:customizer.contact', ['src' => Url::to('plugins/system/ytcontact/contact.js'), 'defer' => true]);
    }
}
