<?php

namespace frontend\models\searches;

use frontend\models\Activity;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Order;

/**
 * OrderSearch represents the model behind the search form about `frontend\models\Order`.
 */
class OrderSearch extends Order
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'product_id', 'bargained_num', 'price', 'status'], 'integer'],
            [['order_number', 'open_id', 'created_at'], 'safe'],
        ];
    }

    public static function searchAttributes()
    {
        return [
            '订单编号' => 'order_number',
            '微信用户' => 'open_id',
            '砍价次数' => 'bargained_num'
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
        $activity_ids = Activity::find()->select('id')->where(['user_id' => Yii::$app->user->id])->column();
        $query = Order::find()->where(['act_id' => $activity_ids]);

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
            'product_id' => $this->product_id,
            'bargained_num' => $this->bargained_num,
            'price' => $this->price,
            'status' => $this->status,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'order_number', $this->order_number])
            ->andFilterWhere(['like', 'open_id', $this->open_id]);

        return $dataProvider;
    }
}
