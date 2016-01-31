<?php

namespace backend\modules\forums\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\forums\models\Forums;

/**
 * ForumsSearch represents the model behind the search form about `backend\modules\forums\models\Forums`.
 */
class ForumsSearch extends Forums
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'username'], 'integer'],
            [['text'], 'safe'],
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
        $query = Forums::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'username' => $this->username,
        ]);

        $query->andFilterWhere(['like', 'text', $this->text]);

        return $dataProvider;
    }
}
