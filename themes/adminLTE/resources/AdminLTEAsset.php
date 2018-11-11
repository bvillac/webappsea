<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\themes\adminLTE\resources;

use yii\web\AssetBundle;

/**
 * Configuration for `backend` client script files
 * @since 4.0
 */
class AdminLTEAsset extends AssetBundle
{
    public $sourcePath = '@themes/adminLTE/assets';
    public $baseUrl = '@web';
    public $css = [
        'css/AdminLTE.min.css', 
        'css/ionicons.min.css', 
        'css/skins/_all-skins.min.css',
        'css/styleLTE.css',
        'plugins/iCheck/square/blue.css',
        'plugins/datepicker/datepicker3.css',
        ];
    public $js = [
        'js/app.min.js',  
        'plugins/fastclick/fastclick.min.js',
        'plugins/iCheck/icheck.min.js',
        'plugins/browser-detect/browser-detect.js',
        'plugins/jsession-timeout/jSessionTimeOut.js',
        'plugins/date-format/date.format.js',
        'plugins/slimScroll/jquery.slimscroll.min.js',
        'plugins/datepicker/bootstrap-datepicker.js',
        ];
    public $jsOptions = ['position' => \yii\web\View::POS_END];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\web\JqueryAsset',
        'yii\jui\JuiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
