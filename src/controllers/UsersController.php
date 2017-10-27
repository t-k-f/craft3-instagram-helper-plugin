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

    // Protected Properties
    // =========================================================================

    /**
     * @var    bool|array Allows anonymous access to this controller's actions.
     *         The actions must be in 'kebab-case'
     * @access protected
     */
    protected $allowAnonymous = true;
    private $apiUrl = 'https://api.instagram.com/v1/users';

    // Private Methods
    // =========================================================================

    private function settings()
    {
        return \tkf\instagramapihelper\InstagramApiHelper::getInstance()->settings;
    }

    private function request($path)
    {
        $cacheKey = md5($path);
        $cache = Craft::$app->cache->get($cacheKey);

        if($cache !== false)
        {
            return $cache;
        }
        else
        {
            $curl = curl_init($path);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $result = json_decode(curl_exec($curl));
            curl_close($curl);
            Craft::$app->cache->set($cacheKey, $result, 60);

            return $result;
        }
    }

    // Public Methods
    // =========================================================================

    /**
     * @return mixed
     */
    public function actionSelf()
    {
        $path = $this->apiUrl . '/self/?access_token=' . $this->settings()['instagramApiToken'];
        $response = $this->request($path);

        return $this->asJson($response);
    }

    public function actionSelfRecent()
    {
        $path = $this->apiUrl . '/self/media/recent/?access_token=' . $this->settings()['instagramApiToken'];
        $response = $this->request($path);

        return $this->asJson($response);
    }

    public function actionUser($userId)
    {
        $path = $this->apiUrl . '/' . $userId . '/?access_token=' . $this->settings()['instagramApiToken'];
        $response = $this->request($path);

        return $this->asJson($response);
    }

    public function actionUserRecent($userId)
    {
        $path = $this->apiUrl . '/' . $userId . '/media/recent/?access_token=' . $this->settings()['instagramApiToken'];
        $response = $this->request($path);

        return $this->asJson($response);
    }

    public function actionSelfLiked()
    {
        $path = $this->apiUrl . '/self/media/liked/?access_token=' . $this->settings()['instagramApiToken'];
        $response = $this->request($path);

        return $this->asJson($response);
    }

    public function actionSearch()
    {
        $path = $this->apiUrl . '/search?q=tkf&access_token=' . $this->settings()['instagramApiToken'];
        $response = $this->request($path);

        return $this->asJson($response);
    }
}
