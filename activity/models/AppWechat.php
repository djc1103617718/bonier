<?php

namespace activity\models;

use Yii;
use yii\base\Model;

class AppWechat extends Model
{
    const ACCESS_TOKEN_API = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=%s&secret=%s&code=%s&grant_type=authorization_code';
    //const LOGIN_API = 'https://open.weixin.qq.com/connect/qrconnect?appid=%s&redirect_uri=%s&response_type=code&scope=%s&state=STATE';
    const USER_INFO_API = 'https://api.weixin.qq.com/sns/userinfo?access_token=%s&openid=%s&lang=zh_CN';
    const PUBLIC_CODE_URL = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=%s&redirect_uri=%s&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';
    public $app_id = 'wxeb82425d73c76b52';
    public $app_secret = '48db682f52979606393510d6761c49a4';
    public $host = 'www.bonier.site';

}