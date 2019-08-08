<?php

namespace app\modules\admin\models;

use \yii\db\ActiveRecord;


class Teachers extends ActiveRecord
{
    public static function tableName()
    {
        return 'teachers';
    }


    public function getPerson()
    {
        return $this->hasMany(Persons::className(), ['id_persons' => 'persons_id']);
    }

    public function getTeacher()
    {
        return $this->hasMany(TeachersDay::className(), ['id_teacher' => 'id_teacher']);
    }

    public function getLsTeacher()
    {
        return $this->hasOne(LessonsTable::className(), ['id_teacher' => 'id_teacher'] );
    }

    public function getKafedra()
    {
        return $this->hasOne(Kafedra::className(), ['id_kafedra' => 'id_kafedra'] );
    }







}
