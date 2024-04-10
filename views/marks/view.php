<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Student;

/** @var yii\web\View $this */
/** @var app\models\marks $model */


$name = \app\models\Student::findOne($model->stu_id);

$this->title = $name -> name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Marks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="marks-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'sno' => $model->sno], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'sno',
            'stu_id',
            'subject',
            'marks',
        ],
    ]) ?>

</div>
