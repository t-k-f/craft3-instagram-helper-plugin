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

    protected $allowAnonymous = true;
    private $apiUrl = 'https://api.instagram.com/v1/users';
    public $enableCsrfValidation = false;

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
            Craft::$app->cache->set($cacheKey, $result, 300);

            return $result;
        }
    }

    private function response ($path)
    {
        $response = $this->request($path);

        return $this->asJson($response);
    }

    private function checkParams ($params)
    {
        $post = Craft::$app->getRequest()->getBodyParams();
        $queryString = '';

        foreach ($params as $param)
        {
            if(isset($post[$param]))
            {
                $queryString .= '&' . $param . '=' . $post[$param];
            }
        }

        return $queryString;
    }

    // Public Methods
    // =========================================================================

    public function actionSelf()
    {
        $path = $this->apiUrl . '/self/?access_token=' . $this->settings()['instagramApiToken'];

        return $this->response($path);
    }

    public function actionUser($userId)
    {
        $path = $this->apiUrl . '/' . $userId . '/?access_token=' . $this->settings()['instagramApiToken'];

        return $this->response($path);
    }

    public function actionSelfRecent()
    {
        $path = $this->apiUrl . '/self/media/recent/?access_token=' . $this->settings()['instagramApiToken'] . $this->checkParams(['count', 'max_id', 'min_id']);

        return $this->response($path);
    }

    public function actionUserRecent($userId)
    {
        $path = $this->apiUrl . '/' . $userId . '/media/recent/?access_token=' . $this->settings()['instagramApiToken'] . $this->checkParams(['count', 'max_id', 'min_id']);

        return $this->response($path);
    }

    public function actionSelfLiked()
    {
        $path = $this->apiUrl . '/self/media/liked/?access_token=' . $this->settings()['instagramApiToken'] . $this->checkParams(['count', 'max_like_id']);

        return $this->response($path);
    }

    public function actionSearch()
    {
        $path = $this->apiUrl . '/search?q=tkf&access_token=' . $this->settings()['instagramApiToken'];

        return $this->response($path);
    }
}
