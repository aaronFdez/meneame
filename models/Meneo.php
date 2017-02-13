<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "meneos".
 *
 * @property integer $id_meneo
 * @property integer $id_usuario
 * @property integer $id_noticia
 *
 * @property Noticias $idNoticia
 * @property User $idUsuario
 */
class Meneo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'meneos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_usuario', 'id_noticia'], 'integer'],
            [['id_noticia'], 'exist', 'skipOnError' => true, 'targetClass' => Noticia::className(), 'targetAttribute' => ['id_noticia' => 'id_noticia']],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_usuario' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_meneo' => 'Id Meneo',
            'id_usuario' => 'Id Usuario',
            'id_noticia' => 'Id Noticia',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNoticia()
    {
        return $this->hasOne(Noticia::className(), ['id_noticia' => 'id_noticia'])->inverseOf('meneos');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(User::className(), ['id' => 'id_usuario'])->inverseOf('meneos');
    }
}
