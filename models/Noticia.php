<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "noticias".
 *
 * @property integer $id_noticia
 * @property integer $id_usuario
 * @property string $titulo
 * @property string $cuerpo
 * @property string $meneos
 * @property string $url
 * @property string $created_at
 *
 * @property ComentariosNoticias[] $comentariosNoticias
 * @property User $idUsuario
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
            [['titulo', 'cuerpo', 'url'], 'required'],
            [['created_at'], 'safe'],
            [['titulo'], 'string', 'max' => 55],
            [['cuerpo'], 'string', 'max' => 500],
            [['url'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_noticia' => 'Id Noticia',
            'id_usuario' => 'Id Usuario',
            'titulo' => 'Titulo',
            'cuerpo' => 'Cuerpo',
            'meneos' => 'Meneos',
            'url' => 'Url',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComentariosNoticias()
    {
        return $this->hasMany(ComentariosNoticias::className(), ['id_noticia' => 'id_noticia'])->inverseOf('idNoticia');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuario()
    {
        return $this->hasOne(User::className(), ['id' => 'id_usuario'])->inverseOf('noticias');
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->id_usuario = Yii::$app->user->identity->id;
                $this->meneos = 0;
            }
            return true;
        } else {
            return false;
        }
    }
}
