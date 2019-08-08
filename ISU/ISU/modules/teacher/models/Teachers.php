<?php

namespace app\modules\teacher\models;

use app\modules\Teacher\Teacher;
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
            [['user_id', 'id_working', 'teacher_stat_register'], 'integer'],
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

    public static function getID($id){
        $result = static::find()->select('id_teacher')->asArray()->where('persons_id='.$id)->column();
        if(isset($result[0])){
            return $result[0];
        }

    }

    public static function getIdkafedra($id){
        $result = static::find()->select('id_kafedra')->asArray()->where('id_teacher='.$id)->column();
        if(isset($result[0])){
            return $result[0];
        }

    }


    public function getKafedra()
    {
        return $this->hasMany(Kafedra::className(), ['id_kafedra' => 'id_kafedra']);
    }
}
