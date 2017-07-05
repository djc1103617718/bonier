<?php

namespace activity\models;

use Yii;
use yii\base\Model;

class AppWechat extends Model
{
    public $app_id = 'wxd1e5e5eb0b1ef6b4';
    public $app_secret = 'cfa6e3a96a6c2e95a78c4f3cea3c20b3';
    public $host = 'www.bonier.site';
    const LOGIN_API = 'https://open.weixin.qq.com/connect/qrconnect?appid=%s&redirect_uri=%s&response_type=code&scope=%s&state=STATE#wechat_redirect';

}