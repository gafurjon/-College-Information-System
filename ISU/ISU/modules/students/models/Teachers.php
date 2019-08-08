<?php

namespace app\modules\students\models;

use Yii;

/**
 * This is the model class for table "teachers".
 *
 * @property integer $id_teacher
 * @property integer $user_id
 * @property integer $id_working
 * @property integer $persons_id
 * @property integer $teacher_stat_register
 *
 * @property Persons $persons
 * @property TeachersDay[] $teachersDays
 * @property Work $work
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
            [['user_id', 'id_working', 'persons_id', 'teacher_stat_register'], 'integer'],
            [['persons_id'], 'exist', 'skipOnError' => true, 'targetClass' => Persons::className(), 'targetAttribute' => ['persons_id' => 'id_persons']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_teacher' => 'Id Teacher',
            'user_id' => 'User ID',
            'id_working' => 'Id Working',
            'persons_id' => 'Persons ID',
            'teacher_stat_register' => 'Teacher Stat Register',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersons()
    {
        return $this->hasOne(Persons::className(), ['id_persons' => 'persons_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeachersDays()
    {
        return $this->hasMany(TeachersDay::className(), ['id_teacher' => 'id_teacher']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWork()
    {
        return $this->hasOne(Work::className(), ['id_working' => 'id_working']);
    }
}
