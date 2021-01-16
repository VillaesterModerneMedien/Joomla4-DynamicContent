<?php

namespace YOOtheme\Theme\Joomla;

use Joomla\CMS\Document\Document;
use Joomla\CMS\Document\HtmlDocument;
use YOOtheme\Config;

class CacheListener
{
    public static $keys = [
        'app.isBuilder',
        '~theme.page_layout',
    ];

    /**
     * Add to Joomla caching.
     *
     * @param Config   $config
     * @param Document $document
     */
    public static function loadTemplate(Config $config, Document $document)
    {
        if (!$config('joomla.config')->get('caching', 0) || !$document instanceof HtmlDocument) {
            return;
        }

        foreach (static::$keys as $key) {

            $value = $config($key);

            if (isset($value)) {
                $document->_custom[$key] = $value;
            }

        }
    }

    /**
     * Get from Joomla caching.
     *
     * @param Config   $config
     * @param Document $document
     */
    public static function afterDispatch(Config $config, Document $document)
    {
        if (!$config('joomla.config')->get('caching', 0) || !$document instanceof HtmlDocument) {
            return;
        }

        // Get keys from Joomla caching
        foreach (static::$keys as $key) {

            if (isset($document->_custom[$key])) {
                $config->set($key, $document->_custom[$key]);
                unset($document->_custom[$key]);
            }

        }
    }
}
