<?php

use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Router\Route;


class ContactType
{
    public static function config()
    {
        return [

            'fields' => [

                'name' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Name',
                        'filters' => ['limit'],
                    ],
                ],
                'alies' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Alias',
                        'filters' => ['limit'],
                    ],
                ],
                'con_position' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Position',
                        'filters' => ['limit'],
                    ],
                ],
                'address' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Adresse (Strasse)',
                        'filters' => ['limit'],
                    ],
                ],
                'suburb' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Stadt',
                        'filters' => ['limit'],
                    ],
                ],
                'state' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Staat',
                        'filters' => ['limit'],
                    ],
                ],
                'country' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Land',
                        'filters' => ['limit'],
                    ],
                ],
                'postcode' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Postleitzahl',
                        'filters' => ['limit'],
                    ],
                ],
                'telephone' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Telefon',
                        'filters' => ['limit'],
                    ],
                ],
                'fax' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Fax',
                        'filters' => ['limit'],
                    ],
                ],
                'mobile' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Mobil',
                        'filters' => ['limit'],
                    ],
                ],
                'webpage' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Webseite',
                        'filters' => ['limit'],
                    ],
                ],
                'misc' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Misc',
                        'filters' => ['limit'],
                    ],
                ],
                'image' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Bild',
                        'filters' => ['limit'],
                    ],
                ],
                'email_to' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Email',
                        'filters' => ['limit'],
                    ],
                ],
                'default_con' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Default Con (?)',
                        'filters' => ['limit'],
                    ],
                ],
                'published' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Published',
                        'filters' => ['limit'],
                    ],
                ],

                'sortname1' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Sortierung 1',
                        'filters' => ['limit'],
                    ],
                ],
                'sortname2' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Sortierung 2',
                        'filters' => ['limit'],
                    ],
                ],
                'sortname3' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Sortierung 3',
                        'filters' => ['limit'],
                    ],
                ],
                'created' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Created Date',
                        'filters' => ['limit'],
                    ],
                ],
                'modified' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Modified Date',
                        'filters' => ['limit'],
                    ],
                ],

            ],

            'metadata' => [
                'type' => true,
                'label' => 'Contact'
            ]

        ];
    }

    public static function vcard($contact)
    {
        if (!class_exists('StudioGongHelperRoute')) {
            require_once JPATH_ROOT . '/components/com_studiogong/helpers/route.php';
        }

        return Route::_(StudioGongHelperRoute::getContactVcard($contact->id));
    }

    public static function content($contact)
    {
        $html = array();
        $html[] = '<ul class="uk-list uk-list-divider">';

        if (isset($contact->telefon) && $contact->telefon !== '')
        {
            $html[] = '<li class="el-item">
            <div class="uk-grid-small uk-child-width-expand uk-flex-nowrap uk-flex-top uk-grid" uk-grid>
                <div class="uk-width-auto uk-first-column"><span class="el-image uk-icon" uk-icon="icon: receiver;"></span>
                </div>
                <div>
                    <div class="el-content uk-panel"><a href="tel:' . preg_replace("/[^0-9|+]/", "", $contact->telefon) . '" title="' . JText::_('COM_STUDIOGONG_CONTACT_PHONE_TITLE') . '">' . $contact->telefon . '</a></div>
                </div>
            </div>
        </li>';
        }

        if (isset($contact->mobil) && $contact->mobil !== '')
        {
            $html[] = '<li class="el-item">
            <div class="uk-grid-small uk-child-width-expand uk-flex-nowrap uk-flex-top uk-grid" uk-grid>
                <div class="uk-width-auto uk-first-column"><span class="el-image uk-icon" uk-icon="icon: phone;"></span>
                </div>
                <div>
                    <div class="el-content uk-panel"><a href="tel:' . preg_replace("/[^0-9|+]/", "", $contact->mobil) . '" title="' . JText::_('COM_STUDIOGONG_CONTACT_PHONE_TITLE') . '">' . $contact->mobil . '</a></div>
                </div>
            </div>
        </li>';
        }

        if (isset($contact->fax) && $contact->fax !== '')
        {
            $html[] = '<li class="el-item">
            <div class="uk-grid-small uk-child-width-expand uk-flex-nowrap uk-flex-top uk-grid" uk-grid>
                <div class="uk-width-auto uk-first-column"><span class="el-image uk-icon" uk-icon="icon: print;"></span>
                </div>
                <div>
                    <div class="el-content uk-panel">' . $contact->fax . '</div>
                </div>
            </div>
        </li>';
        }

        if (isset($contact->email) && $contact->email !== '')
        {
            $email = ComponentHelper::getParams('com_studiogong')->get('show_email', false) ? $contact->email : JText::_('COM_STUDIOGONG_CONTACT_EMAIL');
            $html[] = '<li class="el-item">
            <div class="uk-grid-small uk-child-width-expand uk-flex-nowrap uk-flex-top uk-grid" uk-grid>
                <div class="uk-width-auto uk-first-column"><span class="el-image uk-icon" uk-icon="icon: mail;"></span>
                </div>
                <div>
                    <div class="el-content uk-panel"><a href="mailto:' . $contact->email . '" title="' . JText::_('COM_STUDIOGONG_CONTACT_EMAIL_TITLE') . '">' . $email . '</a></div>
                </div>
            </div>
        </li>';
        }

        $socialprofiles = array('xing','linkedin','facebook','twitter','outlook');

        $profiles = [];

        foreach ($socialprofiles as $socialprofile)
        {
            if (isset($contact->$socialprofile) && $contact->$socialprofile !== '')
            {
                $profiles[] = '<a href="' . $contact->$socialprofile . '" title="' . JText::_('COM_STUDIOGONG_CONTACT_SOCIALPROFILE_TITLE') . '" target="_blank"><span uk-icon="icon: ' . $socialprofile . '"></span></a>';
            }
        }
        if ($profiles)
        {
            $html[] = '<li class="el-item">
                <div class="uk-grid-small uk-child-width-expand uk-flex-nowrap uk-flex-top uk-grid" uk-grid>
                    <div class="uk-width-auto uk-first-column"><span class="el-image uk-icon" uk-icon="icon: social;"></span>
                    </div>
                    <div>
                        <div class="el-content uk-panel">' . implode(' ', $profiles    ) .'</div>
                    </div>
                </div>
            </li>';
        }

        $html[] = '</ul>';

        return implode(" ", $html);
    }
}
