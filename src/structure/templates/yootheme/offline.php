<?php

namespace YOOtheme;

defined('_JEXEC') or die;

// prefer child theme's offline.php
if (Path::get(__FILE__) !== $file = Path::get('~theme/offline.php')) {
    return include $file;
}

require_once JPATH_ADMINISTRATOR . '/components/com_users/helpers/users.php';

$app = \JFactory::getApplication();
$twofactor = \UsersHelper::getTwoFactorMethods();
$view = app(View::Class);

?>
<!DOCTYPE HTML>
<html lang="<?= $this->language ?>" dir="<?= $this->direction ?>">
    <head>
        <meta charset="<?= $this->getCharset() ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <jdoc:include type="head" />
    </head>
    <body class="uk-flex uk-flex-middle" uk-height-viewport>

        <div class="tm-offline uk-container uk-container-small uk-text-center">

            <jdoc:include type="message" />

            <?php if ($app->get('offline_image') && file_exists($app->get('offline_image'))) : ?>
                <?= $view->image($app->get('offline_image'), ['uk-img' => true, 'alt' => htmlspecialchars($app->get('sitename'), ENT_COMPAT, 'UTF-8')]) ?>
            <?php endif ?>

            <h1><?= htmlspecialchars($app->get('sitename'), ENT_COMPAT, 'UTF-8') ?></h1>

            <?php if ($app->get('display_offline_message', 1) == 1 && str_replace(' ', '', $app->get('offline_message')) != '') : ?>

                <p><?= $app->get('offline_message') ?></p>

            <?php elseif ($app->get('display_offline_message', 1) == 2) : ?>

                <p><?= \JText::_('JOFFLINE_MESSAGE') ?></p>

            <?php endif ?>

            <form class="uk-panel uk-margin" action="<?= \JRoute::_('index.php', true) ?>" method="post">

                <div class="uk-margin">
                    <input class="uk-input" type="text" name="username" placeholder="<?= \JText::_('JGLOBAL_USERNAME') ?>">
                </div>

                <div class="uk-margin">
                    <input class="uk-input" type="password" name="password" placeholder="<?= \JText::_('JGLOBAL_PASSWORD') ?>">
                </div>

                <?php if (count($twofactor) > 1) : ?>
                    <div class="uk-margin">
                        <input class="uk-input" type="text" name="secretkey" tabindex="0" size="18" placeholder="<?= \JText::_('JGLOBAL_SECRETKEY') ?>" />
                    </div>
                <?php endif ?>

                <div class="uk-margin">
                    <button class="uk-button uk-button-primary uk-width-1-1" type="submit" name="Submit"><?= \JText::_('JLOGIN') ?></button>
                </div>

                <div class="uk-margin">
                    <label>
                        <input type="checkbox" name="remember" value="yes" placeholder="<?= \JText::_('JGLOBAL_REMEMBER_ME') ?>">
                        <?= \JText::_('JGLOBAL_REMEMBER_ME') ?>
                    </label>
                </div>

                <input type="hidden" name="option" value="com_users">
                <input type="hidden" name="task" value="user.login">
                <input type="hidden" name="return" value="<?= base64_encode(\JURI::base()) ?>">
                <?= \JHtml::_('form.token') ?>

            </form>

        </div>

    </body>
</html>
