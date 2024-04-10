<?php

use app\modules\user\models\ProfDetails;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\modules\user\models\ProfDetailsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Prof Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prof-details-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Prof Details', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'school',
            'specialisation',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, ProfDetails $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'name' => $model->name]);
                }
            ],
        ],
    ]); ?>


</div>
