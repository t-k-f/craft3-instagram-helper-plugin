<?php
/**
 * Instagram API Helper plugin for Craft CMS 3.x
 *
 * A Helper for the Instagram API
 *
 * @link      https://t-k-f.ch
 * @copyright Copyright (c) 2017 Jan Thoma
 */

namespace tkf\instagramapihelper\models;

use tkf\instagramapihelper\InstagramApiHelper;

use Craft;
use craft\base\Model;

/**
 * @author    Jan Thoma
 * @package   InstagramApiHelper
 * @since     1.0.0
 */
class Settings extends Model
{
    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $instagramApiToken = null;
    public $instagramApiUserId = null;
    public $baseUri = '/api';

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['instagramApiToken', 'string'],
            ['instagramApiToken', 'default', 'value' => null],
            ['instagramApiUserId', 'string'],
            ['instagramApiUserId', 'default', 'value' => null],
            ['baseUri', 'string'],
            ['baseUri', 'default', 'value' => '/api']
        ];
    }
}
