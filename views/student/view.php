<?php

use app\components\SecurityHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\student $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Students'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="student-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => SecurityHelper::hashData($model->id)], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Enter marks'), ['marks/create', 'id' => SecurityHelper::hashData($model->id)], ['class' => 'btn btn-success']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'email:email',
            'mobile',
            'course',
            'city',
            'state',
            'dob',
            'gender',
            'category',
        ],
    ]) ?>

</div>
