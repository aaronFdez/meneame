<?php

namespace app\models;

use Yii;

/**
 * Este es el modelo de clase de la tabla "noticias"
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
     * tableName funcion estatica
     * @return tabla devuelve la tabla noticias
     */
    public static function tableName()
    {
        return 'noticias';
    }

    /**
     * [rules reglas de validacion del modelo]
     * @return array el array contiene que validacion tiene cada campo
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
     * attributeLabels asigna una cadena a cada atributo para mostrarse]
     * @return array a atributos se le asigna una cadena
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
     *Devuelve una tabla con los comentarios relacionados con
     * la noticia(id_noticia)
     * @return yii\db\ActiveQuery devuelve una tabla con los comentarios
     * relacionados con la noticia(id_noticia)
     */
    public function getComentariosNoticias()
    {
        return $this->hasMany(ComentariosNoticias::className(), ['id_noticia' => 'id_noticia'])->inverseOf('idNoticia');
    }

    /**
     * Devuelve el usuario usando id
     * @return yii\db\ActiveQuery objeto usuario o null
     */
    public function getUsuario()
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
