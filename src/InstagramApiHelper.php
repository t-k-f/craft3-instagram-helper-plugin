<?php
/**
 * Instagram API Helper plugin for Craft CMS 3.x
 *
 * A Helper for the Instagram API
 *
 * @link      https://t-k-f.ch
 * @copyright Copyright (c) 2017 Jan Thoma
 */

namespace tkf\instagramapihelper;

use tkf\instagramapihelper\models\Settings;

use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;
use craft\web\UrlManager;
use craft\events\RegisterUrlRulesEvent;

use yii\base\Event;

/**
 * Class InstagramApiHelper
 *
 * @author    Jan Thoma
 * @package   InstagramApiHelper
 * @since     1.0.0
 *
 */
class InstagramApiHelper extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * @var InstagramApiHelper
     */
    public static $plugin;

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        $this->setComponents([
            'helpers' => \tkf\instagramapihelper\services\helpers::class,
        ]);

        Event::on(
            UrlManager::class,
            UrlManager::EVENT_REGISTER_SITE_URL_RULES,
            function (RegisterUrlRulesEvent $event) {

                $baseUri = $this->getSettings()['baseUri'];

                // User endpoints
                // =========================================================================

                $event->rules[$baseUri . '/users/self.json'] = 'instagram-api-helper/users/self';
                $event->rules[$baseUri . '/users/self/media/recent.json'] = 'instagram-api-helper/users/self-recent';
                $event->rules[$baseUri . '/users/self/media/liked.json'] = 'instagram-api-helper/users/self-liked';
            }
        );

        Event::on(
            Plugins::class,
            Plugins::EVENT_AFTER_INSTALL_PLUGIN,
            function (PluginEvent $event) {
                if ($event->plugin === $this) {
                }
            }
        );

        Craft::info(
            Craft::t(
                'instagram-api-helper',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }

    // Protected Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    protected function createSettingsModel()
    {
        return new Settings();
    }

    /**
     * @inheritdoc
     */
    protected function settingsHtml(): string
    {
        return Craft::$app->view->renderTemplate(
            'instagram-api-helper/settings',
            [
                'settings' => $this->getSettings()
            ]
        );
    }
}
