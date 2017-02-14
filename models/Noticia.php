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
 * @property string $url
 * @property integer $id_categoria
 * @property string $created_at
 *
 * @property ComentariosNoticias[] $comentariosNoticias
 * @property Meneos[] $meneos
 * @property User $idUsuario
 */
class Noticia extends \yii\db\ActiveRecord
{
    public $categorias;
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
            [['id_usuario', 'id_categoria'], 'integer'],
            [['titulo', 'cuerpo', 'url', 'id_categoria'], 'required'],
            [['created_at'], 'safe'],
            [['titulo'], 'string', 'max' => 55],
            [['cuerpo'], 'string', 'max' => 500],
            [['url'], 'string', 'max' => 200],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_usuario' => 'id']],
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
            'url' => 'Url',
            'id_categoria' => 'Id Categoria',
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
    public function getMeneos()
    {
        return $this->hasMany(Meneo::className(), ['id_noticia' => 'id_noticia'])->inverseOf('noticia');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNumeroMeneos()
    {
        return $this->hasMany(Meneo::className(), ['id_noticia' => 'id_noticia'])->count();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(User::className(), ['id' => 'id_usuario'])->inverseOf('noticias');
    }

    public function getCategoria()
    {
        return $this->hasOne(Categoria::className(), ['id_categoria' => 'id_categoria'])->inverseOf('noticias');
    }
    /**
     * Esta funcion se ejecuta antes guardar la noticia
     * @param  [type] $insert [description]
     * @return [type]         [description]
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->id_usuario = Yii::$app->user->identity->id;
            }
            return true;
        } else {
            return false;
        }
    }
}
