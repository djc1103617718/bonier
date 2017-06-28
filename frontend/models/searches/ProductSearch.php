<?php

namespace frontend\models\searches;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Product;

/**
 * ProductSearch represents the model behind the search form about `frontend\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'act_id', 'media_id', 'reserve_price', 'total', 'start_price', 'bargain_num', 'lave_num'], 'integer'],
            [['product_number', 'name', 'description', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    public static function searchAttributes()
    {
        return [
            '商品名称' => 'name',
            '商品编号' => 'product_number',
            '商品描叙' => 'description'
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $user_id = Yii::$app->user->id;
        $query = Product::find()->where(['user_id' => $user_id]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'act_id' => $this->act_id,
            'media_id' => $this->media_id,
            'reserve_price' => $this->reserve_price,
            'total' => $this->total,
            'start_price' => $this->start_price,
            'bargain_num' => $this->bargain_num,
            'lave_num' => $this->lave_num,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'product_number', $this->product_number])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
