<?php

namespace app\models;

use dektrium\user\models\User as BaseUser;
use yii\helpers\Html;

class User extends BaseUser
{
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNoticias()
    {
        return $this->hasOne(Noticia::className(), ['id_usuario' => 'id'])->inverseOf('usuarios');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsername()
    {
        return Html::a($this->username, ['/user/profile/show', 'id' => $this->id], ['class' => 'profile-link']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAvatar()
    {
        $uploads = \Yii::getAlias('@uploads');
        $ruta = "$uploads/{$this->id}.png";
        return file_exists($ruta) ? "/$ruta" : "/$uploads/default.png";
    }
}
