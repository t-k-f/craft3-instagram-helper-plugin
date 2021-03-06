<?php
/**
 * Instagram API Helper plugin for Craft CMS 3.x
 *
 * A Helper for the Instagram API
 *
 * @link      https://t-k-f.ch
 * @copyright Copyright (c) 2017 Jan Thoma
 */

namespace tkf\instagramapihelper\controllers;

use tkf\instagramapihelper\InstagramApiHelper;

use Craft;
use craft\web\Controller;

/**
 * @author    Jan Thoma
 * @package   InstagramApiHelper
 * @since     1.0.0
 */
class MediaController extends Controller
{
    protected $allowAnonymous = true;
    private $apiUrl = 'https://graph.instagram.com';
    public $enableCsrfValidation = false;

    // Public Methods
    // =========================================================================

    public function actionIndex()
    {
        $userId = InstagramApiHelper::getInstance()->settings['instagramApiUserId'];
        $response = InstagramApiHelper::getInstance()->helpers->getResponse($this->apiUrl, $userId . '/media', ['fields']);

        return $this->asJson($response);
    }
}
