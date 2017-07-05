<?php

namespace activity\models;

use Yii;
use yii\base\Model;

class AppWechat extends Model
{
    const ACCESS_TOKEN_API = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=%s&secret=$s&code=%s&grant_type=authorization_code';
    const LOGIN_API = 'https://open.weixin.qq.com/connect/qrconnect?appid=%s&redirect_uri=%s&response_type=code&scope=%s&state=STATE#wechat_redirect';

    public $app_id = 'wxd1e5e5eb0b1ef6b4';
    public $app_secret = '93afbc2ec5642232713f8b7bcf5b8b12';
    public $host = 'www.bonier.site';

}