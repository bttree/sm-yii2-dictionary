<?php

namespace bttree\smydictionary\controllers;

use bttree\smywidgets\actions\GetModelSlugAction;
use Yii;
use bttree\smydictionary\models\DictionaryItem;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DictionaryItemController implements the CRUD actions for DictionaryItem model.
 */
class DictionaryItemController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [
                            'create',
                            'update',
                            'delete',
                            'get-model-slug',
                        ],
                        'allow'   => true,
                        'roles'   => ['smydictionary.edit'],
                    ],
                    [
                        'actions' => ['index'],
                        'allow'   => true,
                        'roles'   => ['smydictionary.view'],
                    ],
                ],
            ],
            'verbs'  => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * @return array
     */
    public function actions()
    {
        return [
            'get-model-slug' => [
                'class'     => GetModelSlugAction::className(),
                'modelName' => DictionaryItem::className()
            ],
        ];
    }

    /**
     * Lists all DictionaryItem models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
                                                   'query' => DictionaryItem::find(),
                                               ]);

        return $this->render('index',
                             [
                                 'dataProvider' => $dataProvider,
                             ]);
    }

    /**
     * Creates a new DictionaryItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DictionaryItem();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('create',
                                 [
                                     'model' => $model,
                                 ]);
        }
    }

    /**
     * Updates an existing DictionaryItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update',
                                 [
                                     'model' => $model,
                                 ]);
        }
    }

    /**
     * Deletes an existing DictionaryItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the DictionaryItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DictionaryItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DictionaryItem::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
