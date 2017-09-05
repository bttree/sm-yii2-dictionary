<?php

namespace bttree\smydictionary\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * DictionaryGallery
 */
class SearchDictionaryItem extends DictionaryItem
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'dictionary_id', 'status'], 'integer'],
            [['name', 'slug', 'value'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
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
        $query = DictionaryItem::find();

        $dataProvider = new ActiveDataProvider([
                                                   'query' => $query,
                                               ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
                                   'id'            => $this->id,
                                   'dictionary_id' => $this->dictionary_id,
                                   'status'        => $this->status,
                               ]);

        $query->andFilterWhere(['like', 'name', $this->name])
              ->andFilterWhere(['like', 'slug', $this->slug])
              ->andFilterWhere(['like', 'value', $this->value]);

        return $dataProvider;
    }
}
