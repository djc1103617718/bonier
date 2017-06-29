<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $shop_name
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $phone
 * @property string $deadline
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class User extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 10;
    const STATUS_DELETE = 0;

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'created_at',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_at',
                ],
                'value' => function() {
                    return date('Y-m-d H:i:s');
                },
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shop_name', 'username', 'password_hash', 'deadline'], 'required'],
            [['status'], 'integer'],
            [['created_at', 'updated_at'], 'string'],
            [['deadline'], 'safe'],
            ['phone', 'string', 'max' => 11],
            [['shop_name'], 'string', 'max' => 256],
            [['username'], 'string', 'max' => 50],
            [['password_hash'], 'string', 'max' => 80],
            [['password_reset_token', 'email', 'auth_key'], 'string', 'max' => 60],
            [['username'], 'unique'],
            ['referrals', 'string', 'max' => 64],
            [['email'], 'unique'],
            [['phone'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'shop_name' => Yii::t('app', '商店名称'),
            'username' => Yii::t('app', '用户名'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'email' => Yii::t('app', '邮箱'),
            'phone' => Yii::t('app', '手机号'),
            'deadline' => Yii::t('app', '平台截止时间'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'status' => Yii::t('app', '状态'),
            'referrals' => Yii::t('app', '推荐人'),
            'created_at' => Yii::t('app', '创建时间'),
            'updated_at' => Yii::t('app', '更新时间'),
        ];
    }
}
