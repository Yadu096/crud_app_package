<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "statemaster".
 *
 * @property string|null $state
 * @property string|null $district
 * @property string|null $state_code
 * @property string|null $country_id
 */
class Statemaster extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'statemaster';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['state', 'district'], 'string', 'max' => 120],
            [['state_code', 'country_id'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'state' => Yii::t('app', 'State Name'),
            'district' => Yii::t('app', 'District'),
            'state_code' => Yii::t('app', 'State Code'),
            'country_id' => Yii::t('app', 'Country ID'),
        ];
    }

    public static function getStatesList(){
        $state=self::find()->select('state')->all();

        return ArrayHelper::map($state,'state','state');
    }

    public static function getDistrictList($state){
        $district=self::find()->select('district')->where(['state'=>$state])->all();
        return ArrayHelper::map($district,'district','district');
    }
}
