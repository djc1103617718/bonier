<?php

namespace backend\assets;

use yii\base\View;
use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class LoginAndSignUpAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/default.css',
        'css/public.css',
    ];
    public $js = [
        /*'js/jquery.1.7.2.js',
        'js/jquery.validate.js',*/
    ];
    public $jsOptions = [
        'position'=>\yii\web\View::POS_BEGIN
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
