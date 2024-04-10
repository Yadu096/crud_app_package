<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\user\models\ProfDetails $model */

$this->title = Yii::t('app', 'Create Prof Details');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Prof Details'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prof-details-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
