<?php

namespace app\modules\user\models;

use Yii;

/**
 * This is the model class for table "prof_details".
 *
 * @property string|null $name
 * @property string|null $school
 * @property string|null $specialisation
 */
class ProfDetails extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'prof_details';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'school', 'specialisation'], 'string', 'max' => 120],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('app', 'Name'),
            'school' => Yii::t('app', 'School'),
            'specialisation' => Yii::t('app', 'Specialisation'),
        ];
    }
}
