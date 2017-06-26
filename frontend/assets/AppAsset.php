<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'dialog/css/ui-dialog.css',
    ];
    public $js = [
        'js/dropdown.js',
        'dialog/js/dialog-plus-min.js',
        'js/jquery.cookie.js',
        'dialog/js/dialog-instance.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
