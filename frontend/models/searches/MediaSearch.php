<?php

namespace frontend\models\searches;

use Yii;
use common\models\Category;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Media;

/**
 * MediaSearch represents the model behind the search form about `frontend\models\Media`.
 */
class MediaSearch extends Media
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'type'], 'integer'],
            [['category', 'url', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    public static function searchAttributes()
    {
        return [
            '类别' => 'category',
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
        $query = Media::find()->where(['user_id' => Yii::$app->user->id, 'type' => Media::TYPE_IMG]);

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
            'user_id' => $this->user_id,
            'type' => $this->type,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'category', $this->category])
            ->andFilterWhere(['like', 'url', $this->url]);

        return $dataProvider;
    }
}
