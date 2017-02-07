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
 * @property integer $id_categoria
 * @property string $created_at
 *
 * @property ComentariosNoticias[] $comentariosNoticias
 * @property User $idUsuario
 */
class Noticia extends \yii\db\ActiveRecord
{
    public $categorias;
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
            [['id_usuario', 'id_categoria'], 'integer'],
            [['titulo', 'cuerpo', 'url'], 'required'],
            [['meneos'], 'number'],
            [['created_at'], 'safe'],
            [['titulo'], 'string', 'max' => 55],
            [['cuerpo'], 'string', 'max' => 500],
            [['url'], 'string', 'max' => 200],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_usuario' => 'id']],
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
            'id_categoria' => 'Id Categoria',
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
    public function getIdUsuario()
    {
        return $this->hasOne(User::className(), ['id' => 'id_usuario'])->inverseOf('noticias');
    }
}
