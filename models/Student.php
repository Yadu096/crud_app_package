<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "student".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property int|null $mobile
 * @property string $course
 * @property string|null $city
 * @property string|null $state
 * @property string|null $dob
 * @property string $gender
 * @property string $category
 * @property string|null $Certificate_no
 * @property text|null $photo
 *
 * @property Marks[] $marks
 */
class Student extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    //create a public variable to store the file path

    public static function tableName()
    {
        return 'student';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required', 'on' => 'scenario1'],
            [['name', 'email', 'city', 'state'], 'trim'],
            [['email', 'course', 'city', 'state', 'gender', 'dob', 'photo'], 'required'],
            [['mobile'], 'integer'],
            [['dob'], 'safe'],
            [['name', 'course'], 'string', 'max' => 255],
            [['city', 'state', 'gender', 'category', 'photo'], 'string', 'max' => 120],
            [['photo'],'file','extensions'=>'jpg png jpeg'],
            [['email'], 'email']
        ];
    }
    //scenario
    public function scenarios(){
        $scenarios = parent :: scenarios();
        $scenarios['scenario1'] = ['name', 'email', 'city', 'state', 'gender', 'dob', 'course', 'mobile', 'category'];

        return $scenarios;
    }

    public static function getStudentNameById($stu_id){
        $model = Student::find()->select(['name'])-> where(['id' => $stu_id])-> one();
        if(!empty($model)){
            return $model->name;
        }else{
            return "Name not found";
        }
    }


/**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'email' => Yii::t('app', 'Email'),
            'mobile' => Yii::t('app', 'Mobile'),
            'course' => Yii::t('app', 'Course'),
            'city' => Yii::t('app', 'District'),
            'state' => Yii::t('app', 'State'),
            'dob' => Yii::t('app', 'Dob'),
            'gender' => Yii::t('app', 'Gender'),
            'category' => Yii::t('app', 'Category'),
            'Certificate_no' => Yii::t('app', 'Certificate No'),
            'photo' => Yii::t('app', 'File')
        ];
    }


    /**
     * Gets query for [[Marks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMarks()
    {
        return $this->hasMany(Marks::class, ['stu_id' => 'id']);
    }
}
