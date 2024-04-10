<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\marks $model */

$name = \app\models\Student::findOne($model->stu_id)->name;

$this->title = Yii::t('app', 'Update Marks: {name}', [
    'name' => $name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Marks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->sno, 'url' => ['view', 'sno' => $model->sno]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="marks-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'id' => $model->stu_id
    ]) ?>

</div>
