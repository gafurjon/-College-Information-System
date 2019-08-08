<?php

namespace app\modules\bakaydgiri\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "teachers".
 *
 * @property integer $id_teacher
 * @property string $work
 * @property string $unvon
 * @property integer $persons_id
 * @property integer $id_kafedra
 * @property integer $teacher_stat_register
 *
 * @property Persons $persons
 */
class Teachers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'teachers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_teacher', 'id_kafedra', 'teacher_stat_register'], 'integer'],
            [['work'], 'string', 'max' => 255],
            [['unvon'], 'string', 'max' => 100],
            [['id_teacher'], 'exist', 'skipOnError' => true, 'targetClass' => Persons::className(), 'targetAttribute' => ['id_teacher' => 'id_persons']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_teacher' => 'Id Teacher',
            'work' => 'Work',
            'unvon' => 'Unvon',
            'persons_id' => 'Persons ID',
            'id_kafedra' => 'Id Kafedra',
            'teacher_stat_register' => 'Teacher Stat Register',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerson()
    {
        return $this->hasOne(Persons::className(), ['id_persons' => 'persons_id']);
    }

    public static function getMaxIDTeacher(){
        $query = new Query();
        $result = $query
            ->select('MAX(id_teacher) as ID')
            ->from([Teachers::tableName()])
            ->one();
        return $result;
    }

    public static function getMaxIDPersons(){
        $query = new Query();
        $result = $query
            ->select('MAX(id_persons) as ID')
            ->from([Persons::tableName()])
            ->one();
        return $result;
    }
}
