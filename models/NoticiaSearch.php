<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Noticia;

/**
 * NoticiaSearch modelo para buscar noticas  `app\models\Noticia`.
 */
class NoticiaSearch extends Noticia
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        /**
         * [rules reglas de validacion del modelo]
         * @return array el array contiene que validacion tiene cada campo
         */
        return [
            [['id_noticia', 'id_usuario'], 'integer'],
            [['titulo', 'cuerpo', 'url', 'created_at'], 'safe'],
            [['meneos'], 'number'],
        ];
    }

    /**
     * Devuelve el escenario que tiene el modelo
     * @return variable estática con el escenario correspondiente
     */
    public function scenarios()
    {
        return Model::scenarios();
    }

    /**
     * Crea un objeto data provider tras la busqueda
     *
     * @param array $params con los parametros de valicacion
     *
     * @return ActiveDataProvider con el resultado de la busqueda
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
            return $dataProvider;
        }

        // condiciones del filtrado del grid
        $query->andFilterWhere([
            'id_noticia' => $this->id_noticia,
            'id_usuario' => $this->id_usuario,
            'meneos' => $this->meneos,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'titulo', $this->titulo])
            ->andFilterWhere(['like', 'cuerpo', $this->cuerpo])
            ->andFilterWhere(['like', 'url', $this->url]);

        return $dataProvider;
    }
}
