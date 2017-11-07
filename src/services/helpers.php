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

    private function getRequest($path)
    {
        $cacheKey = md5($path);
        $cache = Craft::$app->cache->get($cacheKey);

        if($cache !== false)
        {
            return $cache;
        }

        $curl = curl_init($path);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $result = json_decode(curl_exec($curl));
        curl_close($curl);
        Craft::$app->cache->set($cacheKey, $result, 300);

        return $result;
    }

    // Public Methods
    // =========================================================================

    public function getAccessToken()
    {
        return '?access_token=' . InstagramApiHelper::getInstance()->settings['instagramApiToken'];
    }

    public function getPostParams ($params)
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

    public function getResponse ($base, $endpoint, $params)
    {
        $token = $this->getAccessToken();
        $post = $this->getPostParams($params);
        $path = $base . '/' . $endpoint . '/' . $token . $post;

        return $this->getRequest($path);
    }
}
