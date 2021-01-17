<?php
/**
 * @package    plg_system_studiogongcontact
 *
 * @author     Kicktemp GmbH <hello@kicktemp.com>
 * @copyright  Copyright © 2020 Kicktemp GmbH. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @link       https://kicktemp.com
 */

class ContactQueryType
{
    public static function config()
    {
        return [

            'fields' => [

                'contact' => [
                    'type' => 'ContactType',
                    'metadata' => [
                        'label' => 'Contact',
                        'view' => ['com_contact.contact'],
                        'group' => 'Page',
                    ],
                    'extensions' => [
                        'call' => __CLASS__ . '::contact',
                    ],
                ],

                'customContact' => [

                    'type' => 'ContactType',

                    'args' => [
                        'id' => [
                            'type' => 'String'
                        ],

                    ],

                    'metadata' => [

                        'label' => 'Contact',
                        'group' => 'Studio Gong',

                        'fields' => [
                            'id' => [
                                'label' => 'Select Manually',
                                'description' => "Pick a manually or use filter options to specify which  should be loaded dynamically.",
                                'type' => 'select-item',
                                'module' => 'contact',
                                'item_type' => 'ta',
                                'labels' => [
                                    'type' => 'Kontakt',
                                ],
                            ],
                        ],

                    ],

                    'extensions' => [
                        'call' => __CLASS__ . '::resolve',
                    ],

                ],

            ]

        ];
    }

    public static function contact($root)
    {
        if (isset($root['item'])) {
            return $root['item'];
        }
    }

    public static function resolve($root, array $args)
    {
        $args += ['id' => 0, 'limit' => 1];

        if (!empty($args['id'])) {
            $contacts = ContactTypeProvider::get($args['id']);
        } else {
            $contacts = ContactTypeProvider::query($args);
        }

        return $contacts;
    }
}
