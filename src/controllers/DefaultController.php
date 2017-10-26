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
class DefaultController extends Controller
{

    // Protected Properties
    // =========================================================================

    /**
     * @var    bool|array Allows anonymous access to this controller's actions.
     *         The actions must be in 'kebab-case'
     * @access protected
     */
    protected $allowAnonymous = true;

    // Public Methods
    // =========================================================================

    /**
     * @return mixed
     */
    public function actionSelf()
    {
        $result = 'Welcome to the DefaultController self method';

        return $result;
    }
}
