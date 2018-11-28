<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\themes\store\resources;
use Yii;
use yii\web\AssetBundle;

/**
 * Configuration for `backend` client script files
 * @since 4.0
 */
class StoreAsset extends AssetBundle
{
    public function init() {
        parent::init();
    }

    public $sourcePath = '@themes/store/assets';
    public $baseUrl = '@web';
    public $css = [
        'css/bootstrap.min.css',
        'css/font-awesome.min.css',
        'css/prettyPhoto.css',
        'css/price-range.css',
        'css/animate.css',
        'css/main.css',
        'css/responsive.css', 
        //'css/ionicons.min.css', 
        //'css/skins/_all-skins.min.css',
        //'css/styleLTE.css',
        'plugins/iCheck/square/blue.css',
        'plugins/colorpicker/bootstrap-colorpicker.min.css',
        'plugins/datepicker/datepicker3.css',
        ];
    public $js = [
        //'js/jquery.js', 
        'js/bootstrap.min.js', 
        'js/jquery.scrollUp.min.js', 
        'js/price-range.js', 
        'js/jquery.prettyPhoto.js', 
        'js/main.js',
        //'js/app.min.js',  
        'plugins/fastclick/fastclick.min.js',
        'plugins/iCheck/icheck.min.js',
        'plugins/colorpicker/bootstrap-colorpicker.min.js',
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
