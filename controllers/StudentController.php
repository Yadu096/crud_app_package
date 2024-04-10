<?php

namespace app\controllers;

use Yii;
use app\components\SecurityHelper;
use app\models\student;
use app\models\studentSearch;
use app\models\Statemaster;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * StudentController implements the CRUD actions for student model.
 */
class StudentController extends Controller
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
     * Lists all student models.
     *
     * @return string
     */
    public function actionIndex()
    {
//        $query = Student::find();
        $searchModel = new studentSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

//        $pagination = new Pagination([
//           'defaultPageSize' => 5,
//            'totalCount' => $query->count()
//        ]);


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single student model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $new_id = SecurityHelper::validateData($id);
        return $this->render('view', [
            'model' => $this->findModel($new_id),
        ]);
    }

    /**
     * Creates a new student model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new student();
        $model->scenario = 'scenario1';



//        $data = var_dump($_POST);
//        print_r($data); die;

        if ($this->request->isPost) {
            //get an instance of the uploaded file


            if ($model->load($this->request->post())) {
                $imageName =$model->name.time();
                $model->photo = UploadedFile::getInstance($model, 'photo');
                $model->photo ->saveAs('uploads/'.$imageName.'.'.$model->photo->extension);

                //save the path in the db column
                $model->photo = 'uploads/'.$imageName.'.'.$model->photo->extension;
                //save the model
                $model->save();

                return $this->redirect(['view', 'id' => SecurityHelper::hashData($model->id)]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionStateDistrict($state)
    {
        $districts = Statemaster::getDistrictList($state);
        $content = '<option value="">Select</option>';
        if (!empty($districts)) {
            foreach ($districts as $district) {
                $content .= "<option value='" . $district . "'>" . $district . "</option>";
            }
        }

        return $this->renderPartial('state-district',   ['content'=>$content] );
    }

    /**
     * Updates an existing student model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $new_id = SecurityHelper::validateData($id);
        $model = $this->findModel($new_id);
        if ($this->request->isPost ) {

            if($model->load($this->request->post())){

                $imageName =$model->name.time();
                $model->photo = UploadedFile::getInstance($model, 'photo');
                $model->photo ->saveAs('uploads/'.$imageName.'.'.$model->photo->extension);

                //save the path in the db column
                $model->photo = 'uploads/'.$imageName.'.'.$model->photo->extension;
                //save the model
                $model->save();

                return $this->redirect(['view', 'id' => SecurityHelper::hashData($model->id)]);

            }

        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing student model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the student model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return student the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = student::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
