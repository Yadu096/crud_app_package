<?php

namespace app\controllers;

use app\models\marks;
use app\models\marksSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MarksController implements the CRUD actions for marks model.
 */
class MarksController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all marks models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new marksSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single marks model.
     * @param int $sno Sno
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($sno)
    {
        return $this->render('view', [
            'model' => $this->findModel($sno),
        ]);
    }

    /**
     * Creates a new marks model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($id)
    {

        $model = new marks();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'sno' => $model->sno]);
            }
        } else {
            $model->loadDefaultValues();
        }

        //conditional rendering
        if ($id !== null){
            return $this->render('create', [
                'model' => $model,
                'id' => $id
            ]);
        }else{
            return $this->render('create1', [
                'model' => $model
            ]);
        }

    }

    /**
     * Updates an existing marks model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $sno Sno
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($sno)
    {
        $model = $this->findModel($sno);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->stu_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing marks model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $sno Sno
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($sno)
    {
        $this->findModel($sno)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the marks model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $sno Sno
     * @return marks the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($sno)
    {
        if (($model = marks::findOne(['sno' => $sno])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
