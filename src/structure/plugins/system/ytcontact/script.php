<?php
/**
 * @package    plg_system_studiogongcontact
 *
 * @author     Kicktemp GmbH <hello@kicktemp.com>
 * @copyright  Copyright © 2020 Kicktemp GmbH. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @link       https://kicktemp.com
 */

defined('_JEXEC') or die;

/**
 * StudiogongContact script file.
 *
 * @package   plg_system_studiogongcontact
 * @since     1.0.0
 */

class plgSystemYtContactInstallerScript
{
    /**
     * Constructor
     *
     * @param   JAdapterInstance  $adapter  The object responsible for running this script
     */
    public function __construct(JAdapterInstance $adapter) {}

    /**
     * Called before any type of action
     *
     * @param   string  $route  Which action is happening (install|uninstall|discover_install|update)
     * @param   JAdapterInstance  $adapter  The object responsible for running this script
     *
     * @return  boolean  True on success
     */
    public function preflight($route, JAdapterInstance $adapter) {}

    /**
     * Called after any type of action
     *
     * @param   string  $route  Which action is happening (install|uninstall|discover_install|update)
     * @param   JAdapterInstance  $adapter  The object responsible for running this script
     *
     * @return  boolean  True on success
     */
    public function postflight($route, JAdapterInstance $adapter) {}

    /**
     * Called on installation
     *
     * @param   JAdapterInstance  $adapter  The object responsible for running this script
     *
     * @return  boolean  True on success
     */
    public function install(JAdapterInstance $adapter) {
        JFactory::getDBO()->setQuery("UPDATE #__extensions SET enabled = 1 WHERE type = 'plugin' AND folder = 'system' AND element = 'ytcontact'")->execute();
    }

    /**
     * Called on update
     *
     * @param   JAdapterInstance  $adapter  The object responsible for running this script
     *
     * @return  boolean  True on success
     */
    public function update(JAdapterInstance $adapter) {}

    /**
     * Called on uninstallation
     *
     * @param   JAdapterInstance  $adapter  The object responsible for running this script
     */
    public function uninstall(JAdapterInstance $adapter) {}
}
