<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "noticias".
 *
 * @property integer $id_noticias
 * @property string $titulo
 * @property string $cuerpo
 * @property string $meneos
 * @property string $created_at
 *
 * @property ComeNoti[] $comeNotis
 */
class Noticia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'noticias';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['titulo', 'cuerpo', 'meneos'], 'required'],
            [['meneos'], 'number'],
            [['created_at'], 'safe'],
            [['titulo'], 'string', 'max' => 55],
            [['cuerpo'], 'string', 'max' => 500],
            [['titulo'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            //'id_noticias' => 'Id Noticias',
            'titulo' => 'Título',
            'cuerpo' => 'Cuerpo',
            'meneos' => 'Meneos',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComeNotis()
    {
        return $this->hasMany(ComeNoti::className(), ['id_noticias' => 'id_noticias'])->inverseOf('idNoticias');
    }
}
