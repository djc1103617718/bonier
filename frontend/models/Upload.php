<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\Category;

class Upload extends Model
{
    /**
     * @param $name
     * @param $url
     * @return bool|Media
     */
    public function saveProductImg($name, $url)
    {
        $model = new Media();
        $model->user_id = Yii::$app->user->id;
        $model->category = Category::CATEGORY_PRODUCT_IMG;
        $model->type = Media::TYPE_IMG;
        $model->name = $name;
        $model->url = $url;
        if (!$model->save()) {
            return false;
        }
        return true;
    }

    /**
     * @param $name
     * @param $url
     * @return bool|Media
     */
    public function saveAddressImg($name, $url)
    {
        $model = new Media();
        $model->user_id = Yii::$app->user->id;
        $model->category = Category::CATEGORY_ADDRESS_IMG;
        $model->type = Media::TYPE_IMG;
        $model->name = $name;
        $model->url = $url;
        if (!$model->save()) {
            return false;
        }
        return true;
    }

    /**
     * @param $name
     * @param $url
     * @return bool|Media
     */
    public function saveTopCarousel($name, $url)
    {
        $model = new Media();
        $model->user_id = Yii::$app->user->id;
        $model->category = Category::CATEGORY_TOP_CAROUSEL;
        $model->type = Media::TYPE_IMG;
        $model->url = $url;
        $model->name = $name;
        if (!$model->save()) {
            return false;
        }
        return true;
    }
}