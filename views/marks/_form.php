<?php

use app\components\SecurityHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\marks $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="marks-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=
        $form->field($model, 'stu_id')->textInput()->hiddenInput(["value" =>SecurityHelper::validateData($id) ])->label(false);
     ?>

    <?= $form->field($model, 'subject')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'marks')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
