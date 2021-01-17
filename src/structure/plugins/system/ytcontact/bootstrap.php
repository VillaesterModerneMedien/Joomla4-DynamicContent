<?php
/**
 * @package    plg_system_studiogongcontact
 *
 * @author     Kicktemp GmbH <hello@kicktemp.com>
 * @copyright  Copyright © 2020 Kicktemp GmbH. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @link       https://kicktemp.com
 */

use YOOtheme\Builder;
use YOOtheme\Path;

include_once __DIR__ . '/src/ContactTypeProvider.php';
include_once __DIR__ . '/src/SourceController.php';
include_once __DIR__ . '/src/SourceListener.php';
include_once __DIR__ . '/src/TemplateListener.php';
include_once __DIR__ . '/src/Type/ContactQueryType.php';
include_once __DIR__ . '/src/Type/ContactType.php';

return [

    'routes' => [

        ['get', '/contact/contacts', [SourceController::class, 'contacts']],

    ],

    'events' => [
        'source.init' => [
            SourceListener::class => ['initSource', -20],
        ],

        'customizer.init' => [
            SourceListener::class => ['initCustomizer', -5],
        ],

        'builder.template' => [
            TemplateListener::class => 'matchTemplate',
        ],
    ]

];
