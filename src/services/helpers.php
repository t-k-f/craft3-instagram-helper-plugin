<?php
/**
 * Instagram API Helper plugin for Craft CMS 3.x
 *
 * A Helper for the Instagram API
 *
 * @link      https://t-k-f.ch
 * @copyright Copyright (c) 2017 Jan Thoma
 */

namespace tkf\instagramapihelper\services;

use tkf\instagramapihelper\InstagramApiHelper;

use Craft;
use yii\base\Component;

class Helpers extends Component
{
    // Private Methods
    // =========================================================================

    private function getRequest($path, $token)
    {
        $cacheKey = md5($path);
        $cache = Craft::$app->cache->get($cacheKey);

        if($cache !== false)
        {
            return $cache;
        }

        $headers = [
            'Authorization: Bearer ' . $token
        ];

        $curl = curl_init($path);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $result = json_decode(curl_exec($curl));
        curl_close($curl);
        Craft::$app->cache->set($cacheKey, $result, 30);

        return $result;
    }

    // Public Methods
    // =========================================================================

    public function getAccessToken()
    {
        return InstagramApiHelper::getInstance()->settings['instagramApiToken'];
    }

    public function getUserId()
    {
        return InstagramApiHelper::getInstance()->settings['instagramApiUserId'];
    }

    public function getPostParams ($params)
    {
        $post = Craft::$app->getRequest()->getBodyParams();
        $queryString = '';

        foreach ($params as $param)
        {
            $foo = (strlen($queryString) == 0) ? '?' : '&';

            if(isset($post[$param]))
            {
                $queryString .= $foo . $param . '=' . $post[$param];
            }
        }

        return $queryString;
    }

    public function getResponse ($base, $endpoint, $params)
    {
        $token = $this->getAccessToken();
        $post = $this->getPostParams($params);
        $path = $base . '/' . $endpoint . $post;

        return $this->getRequest($path, $token);
    }
}
