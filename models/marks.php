<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "marks".
 *
 * @property int $sno
 * @property int|null $stu_id
 * @property string|null $subject
 * @property int|null $marks
 *
 * @property Student $stu
 */
class marks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'marks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['stu_id','subject', 'marks'], 'required'],
            [['stu_id', 'marks'], 'integer'],
            [['marks'], 'integer', 'max' =>100, 'min' =>0],
            [['subject'], 'string'],
            [['stu_id'], 'exist', 'skipOnError' => true, 'targetClass' => Student::class, 'targetAttribute' => ['stu_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'sno' => Yii::t('app', 'Sno'),
            'stu_id' => Yii::t('app', 'Stu ID'),
            'subject' => Yii::t('app', 'Subject'),
            'marks' => Yii::t('app', 'Marks'),
        ];
    }

    /**
     * Gets query for [[Stu]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStu()
    {
        return $this->hasOne(Student::class, ['id' => 'stu_id']);
    }
}
