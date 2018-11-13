<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

class FontAwesomeAsset extends AssetBundle {

    public $sourcePath = '@bower/font-awesome/web-fonts-with-css';
    public $baseUrl = '@web';
    public $css = [
        'css/fontawesome-all.min.css',
        'css/brands.min.css',
        'css/regular.min.css',
        'css/solid.min.css',
        'css/v4-shims.min.css',
    ];
    public $js = [];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];

}
