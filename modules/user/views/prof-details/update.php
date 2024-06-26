<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\user\models\ProfDetails $model */

$this->title = 'Update Prof Details: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Prof Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'name' => $model->name]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="prof-details-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
