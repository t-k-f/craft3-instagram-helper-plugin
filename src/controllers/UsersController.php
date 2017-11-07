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
class UsersController extends Controller
{
    protected $allowAnonymous = true;
    private $apiUrl = 'https://api.instagram.com/v1/users';
    public $enableCsrfValidation = false;

    // Public Methods
    // =========================================================================

    public function actionSelf()
    {
        $response = InstagramApiHelper::getInstance()->helpers->getResponse($this->apiUrl, 'self', []);

        return $this->asJson($response);
    }

    public function actionSelfRecent()
    {
        $response = InstagramApiHelper::getInstance()->helpers->getResponse($this->apiUrl, 'self/media/recent', ['count', 'max_id', 'min_id']);

        return $this->asJson($response);
    }

    public function actionSelfLiked()
    {
        $response = InstagramApiHelper::getInstance()->helpers->getResponse($this->apiUrl, 'self/media/liked', ['count', 'max_id', 'min_id']);

        return $this->asJson($response);
    }
}
