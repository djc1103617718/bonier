<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "wechat".
 *
 * @property integer $id
 * @property string $open_id
 * @property string $username
 * @property string $nickname
 * @property string $avatar
 * @property string $unionid
 * @property string $sex
 * @property string $province
 * @property string $city
 * @property string $country
 * @property string $access_token
 * @property string $refresh_token
 * @property string $created_at
 * @property string $expires_in
 */
class Wechat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wechat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['open_id'], 'required'],
            [['created_at'], 'safe'],
            [['open_id', 'username', 'nickname', 'unionid', 'province', 'city', 'country'], 'string', 'max' => 128],
            [['avatar', 'access_token', 'refresh_token'], 'string', 'max' => 256],
            [['sex'], 'string', 'max' => 12],
            [['expires_in'], 'string', 'max' => 24],
            [['open_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'open_id' => Yii::t('app', 'Open ID'),
            'username' => Yii::t('app', '账号'),
            'nickname' => Yii::t('app', '昵称'),
            'avatar' => Yii::t('app', '头像'),
            'unionid' => Yii::t('app', 'Unionid'),
            'sex' => Yii::t('app', '性别'),
            'province' => Yii::t('app', '省'),
            'city' => Yii::t('app', '市'),
            'country' => Yii::t('app', '国家'),
            'access_token' => Yii::t('app', '口令'),
            'refresh_token' => Yii::t('app', '刷新口令'),
            'created_at' => Yii::t('app', '创建时间'),
        ];
    }
}
