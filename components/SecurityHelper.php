<?php

namespace app\components;

use Yii;
use yii\base\Model;

class SecurityHelper extends \yii\base\Model
{
    public static function hashData($id){
        //this function encrypts the id
        //a key is required here
        if(!empty($id)){
            return Yii::$app->security->hashData($id, Yii::$app->params['secretKey']);
        }else{
            die;
        }
    }

    public static function validateData($id){
        //this function encrypts the id
        //a key is required here
        if(!empty($id)){
            return Yii::$app->security->validateData($id, Yii::$app->params['secretKey']);
        }else{
            die;
        }
    }
}