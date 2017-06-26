<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\Category;

class Upload extends Model
{
    public $url;
    public $file;

    public function rules()
    {
        return [
            ['file', 'safe'],
            ['url', 'string', 'max' => 256]
        ];
    }

    public function attributeLabels()
    {
        return [
            'file' => Yii::t('app', '选择上传的文件'),
        ];
    }

    /**
     * @return bool|Media
     */
    public function saveProductImg()
    {
        $model = new Media();
        $model->user_id = Yii::$app->user->id;
        $model->category = Category::CATEGORY_PRODUCT_IMG;
        $model->type = Media::TYPE_IMG;
        $model->url = $this->url;
        if (!$model->save()) {
            return false;
        }
        return $model;
    }

    /**
     * @return bool|Media
     */
    public function saveAddressImg()
    {
        $model = new Media();
        $model->user_id = Yii::$app->user->id;
        $model->category = Category::CATEGORY_ADDRESS_IMG;
        $model->type = Media::TYPE_IMG;
        $model->url = $this->url;
        if (!$model->save()) {
            return false;
        }
        return $model;
    }

    /**
     * @return bool|Media
     */
    public function saveTopCarousel()
    {
        $model = new Media();
        $model->user_id = Yii::$app->user->id;
        $model->category = Category::CATEGORY_TOP_CAROUSEL;
        $model->type = Media::TYPE_IMG;
        $model->url = $this->url;
        if (!$model->save()) {
            return false;
        }
        return $model;
    }
}