<?php

use app\models\student;
use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\LinkPager;

/** @var yii\web\View $this */
/** @var app\models\studentSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Students');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Student'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'email:email',
            'mobile',
            'course',
            'city',
            'state',
            //'dob',
            //'gender',
            //'category',
            [
                'attribute' => 'category',
                'filter' => $searchModel->getCategory(),
            ],
            [
                    'attribute' => 'gender',
                    'filter' => $searchModel->getGender(),
],
            [
                'class' => ActionColumn::className(),
                'template' => '{view}{update}',
                'urlCreator' => function ($action, student $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => app\components\SecurityHelper::hashData($model->id)]);
                 }
            ],
        ],
    ]); ?>



</div>
