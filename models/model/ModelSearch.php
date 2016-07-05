<?php
namespace pistol88\autocatalog\models\model;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use pistol88\autocatalog\models\Model as ModelModel;

class ModelSearch extends ModelModel
{
    public function rules()
    {
        return [
            [['id', 'category_id', 'mark_id'], 'integer'],
            [['name', 'text', 'code'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return ModelModel::scenarios();
    }

    public function search($params)
    {
        $query = ModelModel::find();
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => new \yii\data\Sort([
                'attributes' => [
                    'name',
                    'id',
                ],
            ])
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
			'mark_id' => $this->mark_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'text', $this->text])
            ->andFilterWhere(['like', 'code', $this->code])
			->andFilterWhere(['like', 'category_id', $this->category_id]);

        return $dataProvider;
    }
}
