<?php
/**
 * Instagram API Helper plugin for Craft CMS 3.x
 *
 * A Helper for the Instagram API
 *
 * @link      https://t-k-f.ch
 * @copyright Copyright (c) 2017 Jan Thoma
 */

namespace tkf\instagramapihelper\assetbundles\InstagramApiHelper;

use Craft;
use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

/**
 * @author    Jan Thoma
 * @package   InstagramApiHelper
 * @since     1.0.0
 */
class InstagramApiHelperAsset extends AssetBundle
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->sourcePath = "@tkf/instagramapihelper/assetbundles/instagramapihelper/dist";

        $this->depends = [
            CpAsset::class,
        ];

        $this->js = [
            'js/InstagramApiHelper.js',
        ];

        $this->css = [
            'css/InstagramApiHelper.css',
        ];

        parent::init();
    }
}
