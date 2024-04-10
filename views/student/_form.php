<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use app\models\Statemaster;

/** @var yii\web\View $this */
/** @var app\models\student $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="student-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mobile')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'course')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'state')->dropDownList(StateMaster::getStatesList(), [
        'prompt' => 'Select',
        'onchange' => '
                            $.post( "' . Yii::$app->urlManager->createUrl('student/state-district?state=') . '"+$(this).val(), function( data ) {
                              $( "#student-city" ).html( data );
                            });
                        ']) ?>


    <?= $form->field($model, 'city')->dropDownList(StateMaster::getDistrictList($model->state), ['prompt' => 'Select']) ?>

    <div class="col-md-4">
        <?= $form->field($model, 'dob')->widget(DatePicker::class, [
            'options' => ['class' => 'form-control'],
            'dateFormat' => 'yyyy-MM-dd', // Format to save to the database
            'clientOptions' => [
                'changeMonth' => true,
                'changeYear' => true,
                'yearRange' => '1900:' . date('Y'), // Set the range of years, change 1900 to the earliest year you want to allow
                'showButtonPanel' => true,
                'showOn' => 'both',
                'buttonImageOnly' => false, // Set to false to display both icon and text on the button
// 'buttonText' => '<span class="glyphicon glyphicon-calendar"></span>', // HTML for the button text
            ],
        ])->label('Date of Birth <span class="glyphicon glyphicon-calendar"></span> <span class="glyphicon glyphicon-calendar"></span>
        <span style="color: #ee0909;font-size: large">&nbsp;*</span>') ?>
    </div>

    <?= $form->field($model, 'gender')->textInput(['maxlength' => true]) -> dropDownList(['Male' =>'Male', 'Female' => 'Female', 'Other' => 'Other']) ?>

    <?= $form->field($model, 'category')->textInput(['maxlength' => true])->dropDownList(['GEN'=>'GEN','OBC'=>'OBC','SC'=>'SC','ST'=>'ST'], [
        'prompt'=>"Select Category",
        'onchange' => new \yii\web\JsExpression('
    if ($(this).val() == "GEN") {
        $("#certificateNo").hide();
      $("#certificateNo").val(""); // Clear value when switching to GEN
   } else {
        $("#certificateNo").show();
    }
'),
    ]) ?>

    <div id="certificateNo" style="display: none;">  <?= $form->field($model, 'Certificate_no')->textInput(['maxlength' => true]) ?>
    </div>

    <?= $form->field($model, 'photo')->fileInput(); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
