<?php
/**
 * Instagram API Helper plugin for Craft CMS 3.x
 *
 * A Instagram API Helper
 *
 * @link      https://janthoma.ch
 * @copyright Copyright (c) 2017 Jan Thoma
 */

namespace tkfinstagramapihelper\instagramapihelper\controllers;

use tkfinstagramapihelper\instagramapihelper\InstagramApiHelper;

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
    protected $allowAnonymous = ['index', 'do-something'];

    // Public Methods
    // =========================================================================

    /**
     * @return mixed
     */
    public function actionIndex()
    {
        $result = 'Welcome to the DefaultController actionIndex() method';

        return $result;
    }

    /**
     * @return mixed
     */
    public function actionDoSomething()
    {
        $result = 'Welcome to the DefaultController actionDoSomething() method';

        return $result;
    }
}
