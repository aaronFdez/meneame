<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Noticia;

/**
 * NoticiaSearch represents the model behind the search form about `app\models\Noticia`.
 */
class NoticiaSearch extends Noticia
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_noticia', 'id_usuario', 'id_categoria'], 'integer'],
            [['titulo', 'cuerpo', 'url', 'created_at'], 'safe'],
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
        $query = Noticia::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ]
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_noticia' => $this->id_noticia,
            'id_usuario' => $this->id_usuario,
            'id_categoria' => $this->id_categoria,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'titulo', $this->titulo])
            ->andFilterWhere(['like', 'cuerpo', $this->cuerpo])
            ->andFilterWhere(['like', 'url', $this->url]);

        return $dataProvider;
    }
}
