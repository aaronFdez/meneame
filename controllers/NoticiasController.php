<?php
/**
 * @link https://iesdonana-meneame.herokuapp.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\controllers;

use Yii;
use app\models\Noticia;
use app\models\Categoria;
use app\models\NoticiaSearch;
use app\models\Meneo;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * NoticiasController gestiona las noticias (crea, modifica, elimina,
 * muestra y busca).
 *
 * @author Jose Luis Delgado <joludelgar@gmail.com>
 */
class NoticiasController extends Controller
{
    /**
     * Establece las reglas de acceso a las funciones de la aplicación.
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'meneos' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['create', 'update', 'view', 'meneos'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['view'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'meneos'],
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->isAdmin;
                        },
                    ],
                ],
            ],
        ];
    }

    /**
     * Lista todos los modelos de Noticia.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NoticiaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Muestra un modelo de Noticia.
     * @param integer $id el 'id' de la noticia.
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Crea un nuevo modelo de Noticia
     * Si la creación se realiza correctamente, el navegador será redirigido a la página 'view'.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Noticia();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_noticia]);
        } else {
            $categorias = Categoria::find()->select('nombre, id_categoria')->indexBy('id_categoria')->column();
            return $this->render('create', [
                'model' => $model,
                'categorias' => $categorias,
            ]);
        }
    }

    /**
     * Modifica un modelo de Noticia ya existente.
     * Si la modificación se realiza correctamente, el navegador será redirigido a la página 'view'.
     * @param integer $id el 'id' de la noticia.
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_noticia]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Elimina un modelo de Noticia ya existente.
     * Si la eliminación se realiza correctamente, el navegador será redirigido a la página 'index'.
     * @param integer $id el 'id' de la noticia.
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Busca un modelo de Noticia basandose en el valor de su clave primaria.
     * Si no se encuentra el modelo, se lanzará una excepción HTTP 404.
     * @param integer $id el 'id' de la noticia.
     * @return Noticia el modelo encontrado.
     * @throws NotFoundHttpException si el modelo no ha sido encontrado.
     */
    protected function findModel($id)
    {
        if (($model = Noticia::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionMeneos()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/site/login']);
        }

        $noticia = $this->findModel(Yii::$app->request->post('id'));

        $model = new Meneo;
        $model->id_noticia = $noticia->id_noticia;
        $model->id_usuario = Yii::$app->user->identity->id;

        if (!Meneo::findOne(['id_noticia' => $model->id_noticia, 'id_usuario' => $model->id_usuario])) {
            $model->save();
            return $noticia->numeroMeneos;
        } else {
            return $noticia->numeroMeneos;
        }
    }
}
